<?php

namespace App\Http\Controllers\Admins\Access;

use App\Exports\Admins\Access\AdminUserExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Access\CreateUserRequest;
use App\Http\Requests\Admins\Access\EditUserRequest;
use App\Library\AdminUserInfoLog;
use App\Library\AuthUser;
use App\Library\BreadCrumbs;
use App\Library\SyncPermission;
use App\Models\Admins\Access\Permission;
use App\Models\Admins\Access\Role;
use App\Models\Admins\AdminUser;
use App\Models\Admins\UserDesignation;
use App\Models\Admins\AdminUserInfo;
use Illuminate\Http\Request;
use App\Models\Admins\Designation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Excel;
use Image;
use File;

class AdminUserController extends Controller
{
    use AuthUser, BreadCrumbs, AdminUserInfoLog, SyncPermission;


    public function index()
    {
        $data['title'] = 'User Management';
        $data['menu'] = 'users';
        $data['subMenu'] = 'users';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        $data['designations'] = Designation::where('active_status', true)->orderBy('id', 'asc')->get();
        $data['roles'] = Role::where(['active_status' => true, 'guard_name' => 'admin-user'])->orderBy('id', 'asc')->get();


        return view('admin.access.users.index', $data);
    }


    public function store(CreateUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = new AdminUser();
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->active_status = ($request->has('active_status')) ? true : false;
            $user->save();

            if (!empty($user)) {
                $user->syncPermissions($request->permissions);
                $userInfo = new AdminUserInfo();
                $userInfo->admin_user_id = $user->id;
                $userInfo->full_name = $request->full_name;
                $userInfo->email = $request->email;
                $userInfo->phone_number = $request->phone;
                $userInfo->address = $request->address;
                $userInfo->user_created_by_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $userInfo->save();

                if (!empty($userInfo)) {
                    $this->addPermissionsLog($userInfo, $request->permissions);
                    $userDesignation = new UserDesignation();
                    $userDesignation->admin_users_info_id = $userInfo->id;
                    $userDesignation->designation_id = $request->designation;
                    $userDesignation->save();
                }
            }

            DB::commit();
            $data['status'] = true;
            $data['title'] = 'User Management';
            $data['message'] = 'User added successfully';
        } catch (\Exception $e) {
            DB::rollback();
            $data['status'] = false;
            $data['title'] = 'User Management';
            $data['message'] = 'Something went wrong. please try again';
            $data['error'] = $e->getMessage();
        }

        return $data;
    }


    public function edit($id)
    {
        $data['user'] = AdminUserInfo::with('userPermissions', 'adminUser', 'adminUser.permissions', 'adminUserCreatedBy', 'latestDesignation.designation', 'adminUserUpdatedBy')->with(['latestDesignation' => function ($query) {
            $query->latest();
        }])->where('id', decrypt($id))->first();

        $assignedPermissions = $data['user']->userPermissions()->pluck('id')->toArray();
        $morePermissions = Permission::whereNotIn('id', $assignedPermissions)->where('guard_name', $this->getLoggedInUserGuard())->get();
        $data['permissions'] = [];
        foreach ($data['user']->userPermissions as $key => $permission) {
            $data['permissions'][$permission->key_name][] = $permission;
        }

        $data['morePermissions'] = [];
        foreach ($morePermissions as $key => $perm) {
            $data['morePermissions'][$perm->key_name][] = $perm;
        }

        return $data;
    }


    public function update(EditUserRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = AdminUser::with('permissions', 'latestAdminUserInfo', 'latestAdminUserInfo.latestDesignation')->where('id', $id)->first();
            $user->active_status = ($request->has('active_status')) ? true : false;
            if ($request->has('new_password')) {
                $user->password = bcrypt($request->new_password);
            }
            $user->save();
            $previousUserInfoId = $user->latestAdminUserInfo->id;
            if (!empty($user)) {
                if ($this->compareUserDetailsWithNewData($request->all(), $user)) {
                    $userInfo = new AdminUserInfo();
                } else {
                    $userInfo = $user->latestAdminUserInfo;
                }
                $userInfo->admin_user_id = $user->id;
                $userInfo->full_name = $request->full_name;
                $userInfo->email = $request->email;
                $userInfo->phone_number = $request->phone;
                $userInfo->address = $request->address;
                $userInfo->user_created_by_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $userInfo->save();

                if (!empty($userInfo)) {
                    if ($this->compareUserDetailsWithNewData($request->all(), $user)) {
                        $this->addPermissionsLog($userInfo, $request->permissions);
                    }
                    $user->syncPermissions($request->permissions);
                    $userDesignation = new UserDesignation();
                    $userDesignation->admin_users_info_id = $userInfo->id;
                    $userDesignation->designation_id = $request->designation;
                    $userDesignation->save();
                }
            }

            DB::commit();
            $data['status'] = true;
            $data['title'] = 'User Management';
            $data['message'] = 'User updated successfully';
        } catch (\Exception $e) {
            DB::rollback();
            $data['status'] = false;
            $data['title'] = 'User Management';
            $data['message'] = 'Something went wrong. please try again';
            $data['error'] = $e->getMessage();
        }

        return $data;
    }


    public function destroy(Request $request, $id)
    {
        try {
            if ($request->ajax()) {
                $adminUserInfo = AdminUserInfo::find(decrypt($id));
                $adminUser = AdminUser::with('adminUserInfoDetails')->where('id', $adminUserInfo->admin_user_id)->first();
                if ($request->log) {
                    if (count($adminUser->adminUserInfoDetails) <= 1) {
                        $adminUser->delete();
                    }
                }
                $adminUserInfo->user_deleted_by_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $adminUserInfo->save();

                if ($adminUserInfo->delete()) {
                    $data['id'] = $id;
                    $data['status'] = true;
                    $data['msg'] = $adminUserInfo->full_name . ' is successfully deleted.';
                }
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'User Management';
            $data['message'] = 'Something went wrong. please try again';
            $data['error'] = $e->getMessage();
        }

        return $data;
    }

    public function export(Request $request)
    {
        $currentDate = Carbon::now()->toDateTimeString();
        $fileName = $currentDate . 'admin-users.xlsx';
        $file = Excel::download(new AdminUserExport($request), $fileName);

        return $file;
    }

    public function getPermissionAndSupervisor($roleId)
    {
        $role = Role::find($roleId);
        $permissions = $role->getAllPermissions();
        $data['permissions'] = [];
        foreach ($permissions as $key => $permission) {
            $data['permissions'][$permission->key_name][] = $permission;
        }
        $rolePermissionIds = $role->permissions()->pluck('id')->toArray();
        $morePermissions = Permission::select('id', 'display_name', 'key_name')
            ->whereNotIn('id', $rolePermissionIds)
            ->where('guard_name', $this->getLoggedInUserGuard())->get();
        $data['morePermissions'] = [];
        foreach ($morePermissions as $key => $perm) {
            $data['morePermissions'][$perm->key_name][] = $perm;
        }

        return $data;
    }

    public function fetchAdminUsers(Request $request)
    {
        $columns = array(

            0 => 'id',

            1 => 'full_name',

            2 => 'username',

            3 => 'email',

            4 => 'designation',

            5 => 'phone_number',

            6 => 'address',

            7 => 'active_status',

            8 => 'user_created_by_users_info_id',

            9 => 'created_at',

            10 => 'id',

        );

        $limit = $request->input('length');

        $start = $request->input('start');

        $order = $columns[$request->input('order.0.column')];

        $dir = $request->input('order.0.dir');


        $dat = array();

        $datas = array();

        if (empty($request->input('search.value'))) {

            for ($i = 1; $i < count($request->columns); $i++) {

                if (isset($request->columns[$i]['search']['value'])) {

                    $dat[$request->columns[$i]['data']] = $request->columns[$i]['search']['value'];

                }

                $datas = $dat;

            }

            if (!empty($datas)) {

                if ($request->log) {

                    $userLists = AdminUser::select('*')->with('adminUserInfoDetails', 'adminUserInfoDetails.adminUserCreatedBy', 'adminUserInfoDetails.designation', 'adminUserInfoDetails.designation.designation');

                } else {

                    $userLists = AdminUser::with('latestAdminUserInfo', 'latestAdminUserInfo.adminUserCreatedBy', 'latestAdminUserInfo.latestDesignation', 'latestAdminUserInfo.latestDesignation.designation');

                }

                $userListss = $userLists->FilterSuperAdmin()

                    // ->FilterByUsersInHierarchy()

                    ->FilteredByFullName((isset($datas['full_name']) && $datas['full_name'] != "") ? $datas['full_name'] : '', $request->log)
                    ->FilteredByUsername((isset($datas['username']) && $datas['username'] != "") ? $datas['username'] : '', $request->log)
                    ->FilteredByEmail((isset($datas['email']) && $datas['email'] != "") ? $datas['email'] : '', $request->log)
                    ->FilteredByDesignation((isset($datas['designation']) && $datas['designation'] != "") ? $datas['designation'] : '', $request->log)
                    ->FilteredByPhoneNumber((isset($datas['phone_number']) && $datas['phone_number'] != "") ? $datas['phone_number'] : '', $request->log)
                    ->FilteredByAddress((isset($datas['address']) && $datas['address'] != "") ? $datas['address'] : '', $request->log)
                    ->FilteredByActiveStatus((isset($datas['active_status']) && $datas['active_status'] != "") ? $datas['active_status'] : '')
                    ->FilteredByCreatedDate((isset($datas['created_at']) && $datas['created_at'] != "") ? $datas['created_at'] : '', $request->date, $request->log)
                    ->FilteredByCreatedBy((isset($datas['user_created_by_users_info_id']) && $datas['user_created_by_users_info_id'] != "") ? $datas['user_created_by_users_info_id'] : '', $request->log)
                    ->FilterByDateRange((isset($datas['created_at']) && $datas['created_at'] != "") ? $datas['created_at'] : '', $request->date, $request->log);

                $totalUsersCount = $userLists->count();

                $users = $userListss->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

                if ($request->log) {

                    $totalUsersLists = $this->getAdminUsersData($users);

                } else {

                    $totalUsersLists = $this->latestAdminUserData($users);

                }
                $totalFiltered = $totalUsersCount;

            } else {

                $userLists = AdminUser::with('latestAdminUserInfo', 'latestAdminUserInfo.adminUserCreatedBy', 'latestAdminUserInfo.latestDesignation', 'latestAdminUserInfo.latestDesignation.designation')
                    ->FilterSuperAdmin();
                // ->FilterByUsersInHierarchy();
                $totalUsersCount = $userLists->count();
                $users = $userLists->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

                $totalUsersLists = $this->latestAdminUserData($users);

                $totalFiltered = $totalUsersCount;

            }

        } else {

            $searchKey = $request->input('search.value');

            $userLists = AdminUser::with('latestAdminUserInfo', 'latestAdminUserInfo.adminUserCreatedBy', 'latestAdminUserInfo.designation', 'latestAdminUserInfo.designation.designation')
                ->FilterSuperAdmin()/*->FilterByUsersInHierarchy()*/ ->FilterByGlobalSearch($searchKey);
            $totalUsersCount = $userLists->count();
            $users = $userLists->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();


            $totalUsersLists = $this->latestAdminUserData($users);
            $totalFiltered = $totalUsersCount;

        }


        $tableContent = array(

            "draw" => intval($request->input('draw')),

            "recordsTotal" => $totalUsersCount,

            "recordsFiltered" => $totalFiltered,

            "data" => $totalUsersLists['data'],

        );


        return $tableContent;
    }

    protected function latestAdminUserData($users)
    {
        if (!empty($users)) {
            $userData = array();
            foreach ($users as $index => $user) {
                if (!empty($user->latestAdminUserInfo)) {
                    if (!empty($user->latestAdminUserInfo->latestDesignation)) {
                        $nestedData = array();
                        $nestedData['id'] = $index + 1;
                        $nestedData['log'] = 0;
                        $nestedData['userId'] = encrypt($user->latestAdminUserInfo->id);
                        $nestedData['full_name'] = $user->latestAdminUserInfo->full_name;
                        $nestedData['username'] = $user->username;
                        $nestedData['email'] = $user->latestAdminUserInfo->email;
                        $nestedData['designation'] = $user->latestAdminUserInfo->latestDesignation->designation->name;
                        $nestedData['phone_number'] = $user->latestAdminUserInfo->phone_number;
                        $nestedData['address'] = $user->latestAdminUserInfo->address;
                        $nestedData['active_status'] = $user->active_status;
                        $nestedData['user_created_by_users_info_id'] = $user->latestAdminUserInfo->adminUserCreatedBy->full_name;
                        $nestedData['created_at'] = $user->latestAdminUserInfo->created_at->toDateTimeString();
                        $nestedData['edit_permission'] = $this->checkPermission('view.user');
                        $nestedData['delete_permission'] = $this->checkPermission('delete.user');
                        $nestedData['switch_user_portal'] = $this->checkPermission('switch.user.portal');
                        $nestedData['is_auth_user'] = ($user->id == Auth::guard('admin-user')->user()->id) ? true : false;
                        $userData[] = $nestedData;
                    }
                }
            }

            $tableContent = array(
                "recordsTotal" => intval(count($userData)),
                "recordsFiltered" => intval(count($userData)),
                "data" => $userData,
            );

            return $tableContent;
        }
    }

    protected function getAdminUsersData($users)
    {
        $a = 0;
        if (!empty($users)) {
            $userData = array();
            foreach ($users as $index => $user) {
                foreach ($user->adminUserInfoDetails as $userDetail) {
                    $nestedData = array();
                    $nestedData['id'] = $a + 1;
                    $nestedData['userId'] = encrypt($userDetail->id);
                    $nestedData['full_name'] = $userDetail->full_name;
                    $nestedData['username'] = $user->username;
                    $nestedData['log'] = 1;
                    $nestedData['edit_permission'] = $this->checkPermission('view.user');
                    $nestedData['delete_permission'] = $this->checkPermission('delete.user');
                    $nestedData['switch_user_portal'] = $this->checkPermission('switch.user.portal');
                    $nestedData['is_auth_user'] = ($user->id == Auth::guard('admin-user')->user()->id) ? true : false;
                    $nestedData['active_status'] = $user->active_status;
                    $nestedData['email'] = $userDetail->email;
                    $nestedData['designation'] = $userDetail->designation->designation->name;
                    $nestedData['phone_number'] = $userDetail->phone_number;
                    $nestedData['address'] = $userDetail->address;
                    $nestedData['user_created_by_users_info_id'] = $userDetail->adminUserCreatedBy->full_name;
                    $nestedData['created_at'] = $userDetail->created_at->toDateTimeString();
                    $userData[] = $nestedData;

                    $a++;
                }
            }
            $tableContent = array(
                "recordsTotal" => intval(count($userData)),
                "recordsFiltered" => intval(count($userData)),
                "data" => $userData,
            );

            return $tableContent;
        }
    }

}
