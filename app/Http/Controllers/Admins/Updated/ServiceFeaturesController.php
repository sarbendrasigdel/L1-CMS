<?php

namespace App\Http\Controllers\Admins\Updated;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\AuthUser;
use App\Library\BreadCrumbs;
use Illuminate\Support\Facades\DB;
use App\Models\Admins\Pagesettings\Service;
use App\Models\Admins\Pagesettings\ServiceFeatures;
use App\Http\Requests\Updated\ServiceFeatureRequest;
use App\Http\Requests\Updated\ServiceFeatureUpdateRequest;
class ServiceFeaturesController extends Controller
{
    
    use AuthUser,BreadCrumbs;
    public function index()
    {

        $data['title'] = 'Service';
        $data['menu'] = 'submenu';
        $data['subMenu'] = 'pagesettings';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        $data['service']= Service::get();
        return view('admin.pagesettings.service-features.index',$data);
    }

    public function store(ServiceFeatureRequest $request)
    {
        try {
            DB::beginTransaction();
            $service_feature = new ServiceFeatures();
            $service_feature->name = $request->name;
            $service_feature->description = $request->description;
            $service_feature->service_id = $request->service_id_add;
            $service_feature->active_status = ($request->has('active_status_add')) ? true : false;
            $service_feature->created_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
            $service_feature->save();

            

            DB::commit();
            $data['status'] = true;
            $data['title'] = 'Service Feature Management';
            $data['message'] = 'Service Feature added successfully';
        } catch (\Exception $e) {
            DB::rollback();
            $data['status'] = false;
            $data['title'] = 'Service Feature Management';
            $data['message'] = 'Something went wrong. please try again';
            $data['error'] = $e->getMessage();
        }

        return $data;
    }

    public function edit($id)
    {
        
        $service_feature = ServiceFeatures::get()
        
        ->where('id', decrypt($id))->first();
        
        
        return $service_feature;

    }



    public function fetchServiceFeatureList(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'description',
            3 => 'service',
            4 => 'active_status',
            5 => 'created_at',
            6 => 'id',
        );
        $data['team'] = array();
        $totalData = ServiceFeatures::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $dat = array();
        $datas = array();

        $searchKey = $request->input('search.value');
            $serviceFeatureLists =  ServiceFeatures::FilterByGlobalSearch($searchKey);
            $totalData = $serviceFeatureLists->count();
            $service_features = $serviceFeatureLists->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = $totalData;
    
    if(!empty($service_features)){
        $serviceFeatureData = array();
        foreach($service_features as $index => $features){
            $nestedData = array();
            $nestedData['id'] = $index + 1;
            $nestedData['serviceFeatureId'] = encrypt($features->id);
            $nestedData['name'] = $features->name;
            $nestedData['description'] = $features->description;
            $nestedData['category'] = $features->service->title;
            $nestedData['active_status'] = $features->active_status;
            $nestedData['created_at'] = $features->created_at->toDateTimeString();
            $nestedData['edit_permission'] = true;
            $nestedData['delete_permission'] = true;
            $nestedData['is_editable'] = true;
            $serviceFeatureData[] = $nestedData;
        }
        $tableContent = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $serviceFeatureData,
        );

        return $tableContent;
    }
    

    }

    public function update(ServiceFeatureUpdateRequest $request, $id)
    {

        try {
            if ($request->ajax()) {
                $service = ServiceFeatures::find(decrypt($id));
                // dd($category);
                $service->name = $request->name;
                $service->description = $request->description;
                $service->service_id = $request->service_id;
                $service->active_status = ($request->has('active_status')) ? true : false;
                $service->updated_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $service->save();

                $data['status'] = true;
                $data['title'] = 'Service Features';
                $data['message'] = 'Service Features Updated Successfully.';
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Service Features';
            $data['message'] = 'Something went wrong. please try again';
           $data['message'] = $e->getMessage();
        }

        return $data;
    }

    public function destroy(Request $request, $id)
    {
        
        try {
            if ($request->ajax()) {
                $feature = ServiceFeatures::findOrFail(decrypt($id));
                

                    $feature->deleted_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                    $feature->save();
                    if($feature->delete()){
                        $data['id']= $id;
                        $data['status']=true;
                        $data['msg']= $feature->display_name.' is successfully deleted.';
                    }
                
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'ServiceFeatures';
            $data['message'] = 'Something went wrong. please try again';
//            $data['message'] = $e->getMessage();
        }

        return $data;
    }
}
