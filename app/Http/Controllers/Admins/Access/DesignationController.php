<?php

namespace App\Http\Controllers\Admins\Access;

use App\Exports\Admins\Access\DesignationExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Access\CreateDesignationRequest;
use App\Http\Requests\Admins\Access\EditDesignationRequest;
use App\Library\AuthUser;
use App\Library\BreadCrumbs;
use App\Models\Admins\AdminUserInfo;
use App\Models\Admins\UserDesignation;
use Illuminate\Http\Request;
use App\Models\Admins\Designation;
use Carbon\Carbon;
use Excel;

class DesignationController extends Controller
{
    use AuthUser,BreadCrumbs;

    public function index()
    {
        $data['title'] = 'Designations';
        $data['menu'] = 'users';
        $data['subMenu'] = 'designations';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);

        return view('admin.access.designations.index', $data);
    }


    public function store(CreateDesignationRequest $request)
    {
        try {
            if ($request->ajax()) {
                $designation = new Designation();
                $designation->name = $request->designation_name;
                $designation->active_status = ($request->has('active_status')) ? true : false;
                $designation->created_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $designation->save();

                $data['status'] = true;
                $data['title'] = 'Designations';
                $data['message'] = 'Designation Added Successfully.';
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Designations';
            $data['message'] = 'Something went wrong. please try again';
//            $data['message'] = $e->getMessage();
        }

        return $data;
    }


    public function edit($id)
    {
        $designation = Designation::with('adminUserInfo', 'updatedByAdminUserInfo')
                        ->where('id', decrypt($id))->first();

        return $designation;
    }


    public function update(EditDesignationRequest $request, $id)
    {
        try {
            if ($request->ajax()) {
                $designation = Designation::find(decrypt($id));
                $designation->name = $request->designation_name;
                $designation->active_status = ($request->has('active_status')) ? true : false;
                $designation->updated_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $designation->save();

                $data['status'] = true;
                $data['title'] = 'Designations';
                $data['message'] = 'Designation Updated Successfully.';
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Designations';
            $data['message'] = 'Something went wrong. please try again';
//            $data['message'] = $e->getMessage();
        }

        return $data;
    }


    public function destroy(Request $request, $id)
    {
        try {
            if ($request->ajax()) {
                $designation = Designation::findOrFail(decrypt($id));
                $checkDesignationUsed = UserDesignation::where('designation_id', $designation->id)->count();
                if($checkDesignationUsed > 0){
                    $data['status']=false;
                    $data['msg']= $designation->display_name.' is already in use. cannot deleted !';
                }else{

                    $designation->deleted_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                    $designation->save();
                    if($designation->delete()){
                        $data['id']= $id;
                        $data['status']=true;
                        $data['msg']= $designation->display_name.' is successfully deleted.';
                    }
                }
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Designations';
            $data['message'] = 'Something went wrong. please try again';
//            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    public function export(Request $request)
    {
        $currentDate = Carbon::now()->toDateTimeString();
        $fileName = $currentDate.'Designations.xlsx';
        $file =  Excel::download(new DesignationExport($request), $fileName);

        return $file;
    }

    public function fetchDesignationLists(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'created_by_admin_users_info_id',
            3 => 'created_at',
            4 => 'active_status',
            5 => 'id',
        );
        $data['designations'] = array();
        $totalData = Designation::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $dat = array();
        $datas = array();
        if(empty($request->input('search.value'))){
            for ($i = 1; $i < count($request->columns); $i++) {
                if (isset($request->columns[$i]['search']['value']) && $request->columns[$i]['search']['value'] != "") {
                    $dat[$request->columns[$i]['data']] = $request->columns[$i]['search']['value'];
                }
                $datas = $dat;
                if (!empty($datas)) {
                    $designationLists = Designation::select('*')
                        ->FilteredByName((isset($datas['name']) && $datas['name'] != "") ? $datas['name'] : '')
                        ->FilteredByActiveStatus((isset($datas['active_status']) && $datas['active_status'] != "") ? $datas['active_status'] : '')
                        ->FilteredByCreatedDate((isset($datas['created_at']) && $datas['created_at'] != "") ? $datas['created_at'] : '')
                        ->FilteredByCreatedBy((isset($datas['created_by_admin_users_info_id']) && $datas['created_by_admin_users_info_id'] != "") ? $datas['created_by_admin_users_info_id'] : '');
                    $totalData = $designationLists->count();
                    $designations = $designationLists->offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir)
                        ->get();
                    $totalFiltered = $totalData;
                } else {
                    $designations = Designation::offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir)
                        ->get();
                    $totalFiltered = $totalData;
                }
            }
        }else{
            $searchKey = $request->input('search.value');
            $designationLists =  Designation::FilterByGlobalSearch($searchKey);
            $totalData = $designationLists->count();
            $designations = $designationLists->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = $totalData;
        }

        if(!empty($designations)){
            $designationData = array();
            foreach($designations as $index => $designation){
                $nestedData = array();
                $nestedData['id'] = $index + 1;
                $nestedData['designationId'] = encrypt($designation->id);
                $nestedData['name'] = $designation->name;
                $nestedData['created_by_admin_users_info_id'] = $designation->adminUserInfo->full_name;
                $nestedData['created_at'] = $designation->created_at->toDateTimeString();
                $nestedData['active_status'] = $designation->active_status;
                $nestedData['edit_permission'] = $this->checkPermission('view.user.designation');
                $nestedData['delete_permission'] = $this->checkPermission('delete.user.designation');
                $nestedData['is_editable'] = $designation->is_editable;
                $designationData[] = $nestedData;
            }
            $tableContent = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $designationData,
            );

            return $tableContent;
        }
    }
}
