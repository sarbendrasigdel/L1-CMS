<?php

namespace App\Http\Controllers\Admins\Updated;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\AuthUser;
use App\Http\Requests\Updated\PriceRequest;
use App\Http\Requests\Updated\PriceUpdateRequest;
use App\Library\BreadCrumbs;
use Illuminate\Support\Facades\DB;
use App\Models\Admins\Pagesettings\Price;
use App\Models\Admins\Pagesettings\category;

class PriceController extends Controller
{
    use AuthUser,BreadCrumbs;
    public function index()
    {

        $data['title'] = 'Price';
        $data['menu'] = 'Service';
        $data['subMenu'] = 'Price Plans';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        return view('admin.pagesettings.Price.index',$data);
    }
    public function store(PriceRequest $request)
        {
            // dd($request->all());
            try {
                DB::beginTransaction();
                $Price = new Price();
                $Price->title = $request->title;
                $Price->price = $request->price;
                $Price->description = $request->description;
                $Price->active_status = ($request->has('active_status_add')) ? true : false;
                $Price->created_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $Price->save();
    
                
    
                DB::commit();
                $data['status'] = true;
                $data['title'] = 'Price Management';
                $data['message'] = 'Price added successfully';
            } catch (\Exception $e) {
                DB::rollback();
                $data['status'] = false;
                $data['title'] = 'Price Management';
                $data['message'] = 'Something went wrong. please try again';
                $data['error'] = $e->getMessage();
            }
    
            return $data;
        }
    
        public function edit($id)
        {
            
            $Price = Price::get()
            
            ->where('id', decrypt($id))->first();
            
            
            return $Price;
    
        }
    
    
    
        public function fetchPriceList(Request $request)
        {
            // dd($request->all());
            $columns = array(
                0 => 'id',
                1 => 'title',
                2 => 'price',
                3 => 'description',
                4 => 'active_status',
                5 => 'created_at',
                
            );
            $data['team'] = array();
            $totalData = Price::count();
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
    
            $dat = array();
            $datas = array();
    
            $searchKey = $request->input('search.value');
                $PriceLists =  Price::FilterByGlobalSearch($searchKey);
                $totalData = $PriceLists->count();
                $Prices = $PriceLists->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                $totalFiltered = $totalData;
        
        if(!empty($Prices)){
            $PriceData = array();
            foreach($Prices as $index => $Price){
                $nestedData = array();
                $nestedData['id'] = $index + 1;
                $nestedData['PriceId'] = encrypt($Price->id);
                $nestedData['title'] = $Price->title;
                $nestedData['description'] = $Price->description;
                $nestedData['price'] = $Price->price;
                $nestedData['active_status'] = $Price->active_status;
                $nestedData['created_at'] = $Price->created_at->toDateTimeString();
                $nestedData['edit_permission'] = true;
                $nestedData['delete_permission'] = true;
                $nestedData['is_editable'] = true;
                $PriceData[] = $nestedData;
            }

            $tableContent = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $PriceData,
            );
    
            return $tableContent;
        }
        
    
        }
    
        public function update(PriceUpdateRequest $request, $id)
        {
    
            try {
                if ($request->ajax()) {
                    $Price = Price::find(decrypt($id));
                    // dd($category);
                    $Price->title = $request->title;
                    $Price->price = $request->price;
                    $Price->description = $request->description;
                    $Price->active_status = ($request->has('active_status')) ? true : false;
                    $Price->updated_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                    $Price->save();
    
                    $data['status'] = true;
                    $data['title'] = 'Price';
                    $data['message'] = 'Price Updated Successfully.';
                }
            } catch (\Exception $e) {
                $data['status'] = false;
                $data['title'] = 'Price';
                $data['message'] = 'Something went wrong. please try again';
               $data['message'] = $e->getMessage();
            }
    
            return $data;
        }
    
        public function destroy(Request $request, $id)
        {
            try {
                if ($request->ajax()) {
                    $Price = Price::findOrFail(decrypt($id));
                        $Price->deleted_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                        $Price->save();
                        if($Price->delete()){
                            $data['id']= $id;
                            $data['status']=true;
                            $data['msg']= $Price->display_name.' is successfully deleted.';
                        }
                    
                }
            } catch (\Exception $e) {
                $data['status'] = false;
                $data['title'] = 'Price';
                $data['message'] = 'Something went wrong. please try again';
            //    $data['error'] = $e->getMessage();
            }
    
            return $data;
        }
}
