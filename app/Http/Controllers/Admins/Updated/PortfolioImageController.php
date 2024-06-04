<?php

namespace App\Http\Controllers\Admins\Updated;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\BreadCrumbs;
use Illuminate\Support\Facades\DB;
use App\Models\Admins\Pagesettings\Portfolio;
use App\Models\Admins\Pagesettings\PortfolioImage;
use App\Library\AuthUser;
use App\Http\Requests\Updated\PortfolioImageRequest;
use App\Http\Requests\Updated\PortfolioImageUpdateRequest;


class PortfolioImageController extends Controller
{
    use AuthUser,BreadCrumbs;
    public function index()
    {

        $data['title'] = 'PortfolioImage';
        $data['menu'] = 'portfolio';
        $data['subMenu'] = 'PortfolioImage';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        $data['project']= Portfolio::get();
        return view('admin.pagesettings.Portfolio-images.index',$data);
    }
    public function store(PortfolioImageRequest $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $PortfolioImage = new PortfolioImage();
            $PortfolioImage->image = $request->image;
            $PortfolioImage->portfolio_id = $request->portfolio_id_add;
            $PortfolioImage->active_status = ($request->has('active_status_add')) ? true : false;
            $PortfolioImage->created_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
            $PortfolioImage->save();

            

            DB::commit();
            $data['status'] = true;
            $data['title'] = 'PortfolioImage Management';
            $data['message'] = 'PortfolioImage added successfully';
        } catch (\Exception $e) {
            DB::rollback();
            $data['status'] = false;
            $data['title'] = 'PortfolioImage Management';
            $data['message'] = 'Something went wrong. please try again';
            $data['error'] = $e->getMessage();
        }

        return $data;
    }

    public function edit($id)
    {
        
        $PortfolioImage = PortfolioImage::get()
        
        ->where('id', decrypt($id))->first();
        
        
        return $PortfolioImage;

    }
    



    public function fetchPortfolioImageList(Request $request)
    {
        // dd($request->all());
        $columns = array(
            0 => 'id',
            1 => 'project',
            2 => 'active_status',
            3 => 'created_at',
            
        );
        $data['team'] = array();
        $totalData = PortfolioImage::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $dat = array();
        $datas = array();

        $searchKey = $request->input('search.value');
            $PortfolioImageLists =  PortfolioImage::FilterByGlobalSearch($searchKey);
            $totalData = $PortfolioImageLists->count();
            $PortfolioImages = $PortfolioImageLists->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = $totalData;
    
    if(!empty($PortfolioImages)){
        $PortfolioImageData = array();
        foreach($PortfolioImages as $index => $PortfolioImage){
            $nestedData = array();
            $nestedData['id'] = $index + 1;
            $nestedData['PortfolioImageId'] = encrypt($PortfolioImage->id);
            $nestedData['project'] = $PortfolioImage->portfolio->title;
            $nestedData['active_status'] = $PortfolioImage->active_status;
            $nestedData['created_at'] = $PortfolioImage->created_at->toDateTimeString();
            $nestedData['edit_permission'] = true;
            $nestedData['delete_permission'] = true;
            $nestedData['is_editable'] = true;
            $PortfolioImageData[] = $nestedData;
        }

        $tableContent = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $PortfolioImageData,
        );

        return $tableContent;
    }
    

    }

    public function update(PortfolioImageUpdateRequest $request, $id)
    {
        // dd($request->all());
        try {
            if ($request->ajax()) {
                $PortfolioImage = PortfolioImage::find(decrypt($id));
                // dd($category);
                $PortfolioImage->image = $request->image;
                $PortfolioImage->portfolio_id = $request->portfolio_id;
                $PortfolioImage->active_status = ($request->has('active_status')) ? true : false;
                $PortfolioImage->updated_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $PortfolioImage->save();

                $data['status'] = true;
                $data['title'] = 'PortfolioImage';
                $data['message'] = 'PortfolioImage Updated Successfully.';
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'PortfolioImage';
            $data['message'] = 'Something went wrong. please try again';
           $data['message'] = $e->getMessage();
        }

        return $data;
    }

    public function destroy(Request $request, $id)
    {
        try {
            if ($request->ajax()) {
                $PortfolioImage = PortfolioImage::findOrFail(decrypt($id));
                    $PortfolioImage->deleted_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                    $PortfolioImage->save();
                    if($PortfolioImage->delete()){
                        $data['id']= $id;
                        $data['status']=true;
                        $data['msg']= $PortfolioImage->display_name.' is successfully deleted.';
                    }
                
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'PortfolioImage';
            $data['message'] = 'Something went wrong. please try again';
        //    $data['error'] = $e->getMessage();
        }

        return $data;
    }
}
