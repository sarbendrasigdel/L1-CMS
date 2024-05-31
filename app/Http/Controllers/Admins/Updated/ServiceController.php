<?php

namespace App\Http\Controllers\Admins\Updated;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\AuthUser;
use App\Library\BreadCrumbs;
use Illuminate\Support\Facades\DB;
use App\Models\Admins\Pagesettings\Service;
use App\Models\Admins\Pagesettings\category;
use App\Http\Requests\Updated\ServiceRequest;
use App\Http\Requests\Updated\ServiceUpdateRequest;
class ServiceController extends Controller
{
    
        use AuthUser,BreadCrumbs;
        public function index()
        {

            $data['title'] = 'Service';
            $data['menu'] = 'submenu';
            $data['subMenu'] = 'pagesettings';
            $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
            $data['category']= category::get();
            return view('admin.pagesettings.services.index',$data);
        }
    
        public function store(ServiceRequest $request)
        {
            try {
                DB::beginTransaction();
                $service = new Service();
                $service->title = $request->title;
                $service->description = $request->description;
                $service->category_id = $request->category_id_add;
                $service->active_status = ($request->has('active_status_add')) ? true : false;
                $service->created_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $service->save();
    
                
    
                DB::commit();
                $data['status'] = true;
                $data['title'] = 'Service Management';
                $data['message'] = 'Service added successfully';
            } catch (\Exception $e) {
                DB::rollback();
                $data['status'] = false;
                $data['title'] = 'Service Management';
                $data['message'] = 'Something went wrong. please try again';
                $data['error'] = $e->getMessage();
            }
    
            return $data;
        }
    
        public function edit($id)
        {
            
            $service = Service::get()
            
            ->where('id', decrypt($id))->first();
            
            
            return $service;
    
        }
    
    
    
        public function fetchServiceList(Request $request)
        {
            // dd($request->all());
            $columns = array(
                0 => 'id',
                1 => 'title',
                2 => 'description',
                3 => 'category',
                4 => 'active_status',
                5 => 'created_at',
                6 => 'id',
            );
            $data['team'] = array();
            $totalData = Service::count();
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
    
            $dat = array();
            $datas = array();
    
            $searchKey = $request->input('search.value');
                $serviceLists =  Service::FilterByGlobalSearch($searchKey);
                $totalData = $serviceLists->count();
                $services = $serviceLists->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                $totalFiltered = $totalData;
        
        if(!empty($services)){
            $serviceData = array();
            foreach($services as $index => $service){
                $nestedData = array();
                $nestedData['id'] = $index + 1;
                $nestedData['serviceId'] = encrypt($service->id);
                $nestedData['title'] = $service->title;
                $nestedData['description'] = $service->description;
                $nestedData['category'] = $service->category->name;
                $nestedData['active_status'] = $service->active_status;
                $nestedData['created_at'] = $service->created_at->toDateTimeString();
                $nestedData['edit_permission'] = true;
                $nestedData['delete_permission'] = true;
                $nestedData['is_editable'] = true;
                $serviceData[] = $nestedData;
            }

            $tableContent = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $serviceData,
            );
    
            return $tableContent;
        }
        
    
        }
    
        public function update(ServiceUpdateRequest $request, $id)
        {
    
            try {
                if ($request->ajax()) {
                    $service = Service::find(decrypt($id));
                    // dd($category);
                    $service->title = $request->title;
                    $service->description = $request->description;
                    $service->category_id = $request->category_id;
                    $service->active_status = ($request->has('active_status')) ? true : false;
                    $service->updated_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                    $service->save();
    
                    $data['status'] = true;
                    $data['title'] = 'Service';
                    $data['message'] = 'Service Updated Successfully.';
                }
            } catch (\Exception $e) {
                $data['status'] = false;
                $data['title'] = 'Service';
                $data['message'] = 'Something went wrong. please try again';
               $data['message'] = $e->getMessage();
            }
    
            return $data;
        }
    
        public function destroy(Request $request, $id)
        {
            try {
                if ($request->ajax()) {
                    $service = Service::findOrFail(decrypt($id));
                        $service->deleted_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                        $service->save();
                        if($service->delete()){
                            $data['id']= $id;
                            $data['status']=true;
                            $data['msg']= $service->display_name.' is successfully deleted.';
                        }
                    
                }
            } catch (\Exception $e) {
                $data['status'] = false;
                $data['title'] = 'Service';
                $data['message'] = 'Something went wrong. please try again';
            //    $data['error'] = $e->getMessage();
            }
    
            return $data;
        }
    
}
