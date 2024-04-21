<?php

namespace App\Http\Controllers\Admins\Access;

use App\Exports\Admins\Access\RolesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Access\CreateRoleRequest;
use App\Http\Requests\Admins\Access\EditRoleRequest;
use Illuminate\Http\Request;
use App\Library\AuthUser;
use App\Library\BreadCrumbs;
use App\Models\Admins\Access\Permission;
use App\Models\Admins\Access\Role;
use Illuminate\Support\Facades\DB;
use Excel;
use Carbon\Carbon;

class RoleController extends Controller
{
    use AuthUser, BreadCrumbs;

    public function index()
    {
        $data['title'] = 'Role Management';
        $data['menu'] = 'users';
        $data['subMenu'] = 'roles';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        $data['permissions'] = Permission::grouped($this->getLoggedInUserGuard());

        return view('admin.access.roles.index', $data);
    }


    public function store(CreateRoleRequest $request)
    {
        try {
            if ($request->ajax()) {
                DB::beginTransaction();
                $role = new Role();
                $role->name = $request->role_name;
                $role->display_name = $request->display_name;
                $role->guard_name = $this->getLoggedInUserGuard();
                $role->active_status = ($request->has('active_status')) ? true : false;
                $role->created_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $role->save();

                if (!empty($role)) {
                    $role->syncPermissions($request->permissions);
                }

                $data['status'] = true;
                $data['title'] = 'Role Management';
                $data['message'] = 'Role Added Successfully.';
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollback();
            $data['status'] = false;
            $data['title'] = 'Role Management';
            $data['message'] = 'Something went wrong. please try again';
//            $data['message'] = $e->getMessage();
        }

        return $data;
    }


    public function edit($id)
    {
        $role = Role::with('permissions', 'adminUserInfo', 'updatedByAdminUserInfo')->where('id', decrypt($id))->first();

        return $role;
    }


    public function update(EditRoleRequest $request, $id)
    {
        try {
            if ($request->ajax()) {
                DB::beginTransaction();
                $role = Role::find(decrypt($id));
                $role->name = $request->role_name;
                $role->display_name = $request->display_name;
                $role->active_status = ($request->has('active_status')) ? true : false;
                $role->updated_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $role->save();

                if (!empty($role)) {
                    $role->syncPermissions($request->permissions);
                }

                $data['status'] = true;
                $data['title'] = 'Role Management';
                $data['message'] = 'Role Updated Successfully.';
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollback();
            $data['status'] = false;
            $data['title'] = 'Role Management';
//            $data['message'] = 'Something went wrong. please try again';
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    public function destroy(Request $request, $id)
    {

        try {
            if ($request->ajax()) {
                $role = Role::findOrFail(decrypt($id));
                $role->deleted_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $role->save();
                if ($role->delete()) {
                    $data['id'] = $id;
                    $data['status'] = true;
                    $data['msg'] = $role->display_name . ' is successfully deleted.';
                }
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Role Management';
            $data['message'] = 'Something went wrong. please try again';
//            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    public function export(Request $request)
    {
        $currentDate = Carbon::now()->toDateTimeString();
        $fileName = $currentDate . '-Roles.xlsx';
        $file = Excel::download(new RolesExport($request), $fileName);

        return $file;
    }

    public function fetchRolesLists(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'display_name',
            3 => 'created_by_admin_users_info_id',
            4 => 'created_at',
            5 => 'active_status',
            6 => 'id',
        );
        $data['roles'] = array();
        $totalData = Role::FilteredByGuardName($this->getLoggedInUserGuard())->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $dat = array();
        $datas = array();
        if (empty($request->input('search.value'))) {
            for ($i = 1; $i < count($request->columns); $i++) {
                if (isset($request->columns[$i]['search']['value']) && $request->columns[$i]['search']['value'] != "") {
                    $dat[$request->columns[$i]['data']] = $request->columns[$i]['search']['value'];
                }
                $datas = $dat;
                if (!empty($datas)) {
                    $roleLists = Role::select('*')->with('permissions')->where('guard_name', 'admin-user')
                        ->FilteredByGuardName($this->getLoggedInUserGuard())
                        ->FilteredByName((isset($datas['name']) && $datas['name'] != "") ? $datas['name'] : '')
                        ->FilteredByDisplayName((isset($datas['display_name']) && $datas['display_name'] != "") ? $datas['display_name'] : '')
                        ->FilteredByActiveStatus((isset($datas['active_status']) && $datas['active_status'] != "") ? $datas['active_status'] : '')
                        ->FilteredByCreatedDate((isset($datas['created_at']) && $datas['created_at'] != "") ? $datas['created_at'] : '')
                        ->FilteredByCreatedBy((isset($datas['created_by_admin_users_info_id']) && $datas['created_by_admin_users_info_id'] != "") ? $datas['created_by_admin_users_info_id'] : '');
                    $totalData = $roleLists->count();
                    $roles = $roleLists->offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir)
                        ->get();
                    $totalFiltered = $totalData;
                } else {
                    $roles = Role::with('permissions')->FilteredByGuardName($this->getLoggedInUserGuard())
                        ->where('guard_name', 'admin-user')
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir)
                        ->get();
                    $totalFiltered = $totalData;
                }
            }
        } else {
            $searchKey = $request->input('search.value');
            $roleLists = Role::with('permissions')->FilteredByGuardName($this->getLoggedInUserGuard())
                ->where('guard_name', 'admin-user')
                ->FilterByGlobalSearch($searchKey);
            $totalData = $roleLists->count();
            $roles = $roleLists->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $totalData;
        }

        if (!empty($roles)) {
            $roleData = array();
            foreach ($roles as $index => $role) {
                $nestedData = array();
                $nestedData['id'] = $index + 1;
                $nestedData['roleId'] = encrypt($role->id);
                $nestedData['name'] = $role->name;
                $nestedData['display_name'] = $role->display_name;
                $nestedData['created_by_admin_users_info_id'] = $role->adminUserInfo->full_name;
                $nestedData['created_at'] = $role->created_at->toDateTimeString();
                $nestedData['active_status'] = $role->active_status;
                $nestedData['edit_permission'] = $this->checkPermission('view.user.role');
                $nestedData['delete_permission'] = $this->checkPermission('delete.user.role');
                $roleData[] = $nestedData;
            }
            $tableContent = array(
                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $roleData,
            );

            return $tableContent;
        }
    }
}
