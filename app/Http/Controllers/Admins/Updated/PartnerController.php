<?php

namespace App\Http\Controllers\Admins\Updated;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\BreadCrumbs;
use Illuminate\Support\Facades\DB;
use App\Library\AuthUser;
use App\Models\Admins\Pagesettings\Partner;
use App\Http\Requests\Updated\PartnerRequest;
use App\Http\Requests\Updated\PartnerUpdateRequest;


class PartnerController extends Controller
{
    use AuthUser,BreadCrumbs;
    public function index()
    {

        $data['title'] = 'Partner';
        $data['menu'] = 'homepage';
        $data['subMenu'] = 'Partner';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        return view('admin.pagesettings.Partners.index',$data);
    }
    public function store(PartnerRequest $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $Partner = new Partner();
            $Partner->name = $request->name;
            $Partner->image = $request->image;
            $Partner->active_status = ($request->has('active_status_add')) ? true : false;
            $Partner->created_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
            $Partner->save();
            DB::commit();
            $data['status'] = true;
            $data['title'] = 'Partner Management';
            $data['message'] = 'Partner added successfully';
        } catch (\Exception $e) {
            DB::rollback();
            $data['status'] = false;
            $data['title'] = 'Partner Management';
            $data['message'] = 'Something went wrong. please try again';
            $data['error'] = $e->getMessage();
        }

        return $data;
    }

    public function edit($id)
    {
        
        $Partner = Partner::get()
        
        ->where('id', decrypt($id))->first();
        
        
        return $Partner;

    }
    



    public function fetchPartnerList(Request $request)
    {
        // dd($request->all());
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'active_status',
            3 => 'created_at',
            
        );
        $data['team'] = array();
        $totalData = Partner::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $dat = array();
        $datas = array();

        $searchKey = $request->input('search.value');
            $PartnerLists =  Partner::FilterByGlobalSearch($searchKey);
            $totalData = $PartnerLists->count();
            $Partners = $PartnerLists->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = $totalData;
    
    if(!empty($Partners)){
        $PartnerData = array();
        foreach($Partners as $index => $Partner){
            $nestedData = array();
            $nestedData['id'] = $index + 1;
            $nestedData['PartnerId'] = encrypt($Partner->id);
            $nestedData['name'] = $Partner->name;
            $nestedData['active_status'] = $Partner->active_status;
            $nestedData['created_at'] = $Partner->created_at->toDateTimeString();
            $nestedData['edit_permission'] = true;
            $nestedData['delete_permission'] = true;
            $nestedData['is_editable'] = true;
            $PartnerData[] = $nestedData;
        }

        $tableContent = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $PartnerData,
        );

        return $tableContent;
    }
    

    }

    public function update(PartnerUpdateRequest $request, $id)
    {
        // dd($request->all());
        try {
            if ($request->ajax()) {
                $Partner = Partner::find(decrypt($id));
                // dd($category);
                $Partner->name = $request->name;
                $Partner->image = $request->image;
                $Partner->active_status = ($request->has('active_status')) ? true : false;
                $Partner->updated_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $Partner->save();

                $data['status'] = true;
                $data['title'] = 'Partner';
                $data['message'] = 'Partner Updated Successfully.';
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Partner';
            $data['message'] = 'Something went wrong. please try again';
           $data['message'] = $e->getMessage();
        }

        return $data;
    }

    public function destroy(Request $request, $id)
    {
        try {
            if ($request->ajax()) {
                $Partner = Partner::findOrFail(decrypt($id));
                    $Partner->deleted_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                    $Partner->save();
                    if($Partner->delete()){
                        $data['id']= $id;
                        $data['status']=true;
                        $data['msg']= $Partner->display_name.' is successfully deleted.';
                    }
                
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Partner';
            $data['message'] = 'Something went wrong. please try again';
        //    $data['error'] = $e->getMessage();
        }

        return $data;
    }
}
