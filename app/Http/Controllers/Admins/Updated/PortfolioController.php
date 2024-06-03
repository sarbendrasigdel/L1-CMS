<?php

namespace App\Http\Controllers\Admins\Updated;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\BreadCrumbs;
use Illuminate\Support\Facades\DB;
use App\Models\Admins\Pagesettings\portfolio;
use App\Models\Admins\Pagesettings\category;
use App\Library\AuthUser;
use App\Http\Requests\Updated\portfolioUpdateRequest;
use App\Http\Requests\Updated\portfolioRequest;

class PortfolioController extends Controller
{
    use AuthUser,BreadCrumbs;
    public function index()
    {

        $data['title'] = 'portfolio';
        $data['menu'] = 'pagesetting';
        $data['subMenu'] = 'Porfolio';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        $data['category']= category::get();
        return view('admin.pagesettings.portfolio.index',$data);
    }

    public function store(portfolioRequest $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $portfolio = new Portfolio();
            $portfolio->title = $request->title;
            $portfolio->client = $request->client;
            $portfolio->image = $request->image;
            $portfolio->description = $request->description;
            $portfolio->category_id = $request->category_id_add;
            $portfolio->date = $request->date;
            $portfolio->active_status = ($request->has('active_status_add')) ? true : false;
            $portfolio->created_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
            $portfolio->save();

            

            DB::commit();
            $data['status'] = true;
            $data['title'] = 'portfolio Management';
            $data['message'] = 'portfolio added successfully';
        } catch (\Exception $e) {
            DB::rollback();
            $data['status'] = false;
            $data['title'] = 'portfolio Management';
            $data['message'] = 'Something went wrong. please try again';
            $data['error'] = $e->getMessage();
        }

        return $data;
    }

    public function edit($id)
    {
        
        $portfolio = Portfolio::get()
        
        ->where('id', decrypt($id))->first();
        
        
        return $portfolio;

    }



    public function fetchportfolioList(Request $request)
    {
        // dd($request->all());
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'category',
            3 => 'active_status',
            4 => 'created_at',
            
        );
        $data['team'] = array();
        $totalData = portfolio::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $dat = array();
        $datas = array();

        $searchKey = $request->input('search.value');
            $portfolioLists =  portfolio::FilterByGlobalSearch($searchKey);
            $totalData = $portfolioLists->count();
            $portfolios = $portfolioLists->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = $totalData;
    
    if(!empty($portfolios)){
        $portfolioData = array();
        foreach($portfolios as $index => $portfolio){
            $nestedData = array();
            $nestedData['id'] = $index + 1;
            $nestedData['portfolioId'] = encrypt($portfolio->id);
            $nestedData['title'] = $portfolio->title;
            $nestedData['description'] = $portfolio->description;
            $nestedData['category'] = $portfolio->category->name;
            $nestedData['active_status'] = $portfolio->active_status;
            $nestedData['created_at'] = $portfolio->created_at->toDateTimeString();
            $nestedData['edit_permission'] = true;
            $nestedData['delete_permission'] = true;
            $nestedData['is_editable'] = true;
            $portfolioData[] = $nestedData;
        }

        $tableContent = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $portfolioData,
        );

        return $tableContent;
    }
    

    }

    public function update(portfolioUpdateRequest $request, $id)
    {
        // dd($request->all());
        try {
            if ($request->ajax()) {
                $portfolio = portfolio::find(decrypt($id));
                // dd($category);
                $portfolio->title = $request->title;
                $portfolio->client = $request->client;
                $portfolio->image = $request->image;
                // $portfolio->description = $request->description;
                $portfolio->category_id = $request->category_id;
                $portfolio->date = $request->date;
                $portfolio->active_status = ($request->has('active_status')) ? true : false;
                $portfolio->updated_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $portfolio->save();

                $data['status'] = true;
                $data['title'] = 'portfolio';
                $data['message'] = 'portfolio Updated Successfully.';
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'portfolio';
            $data['message'] = 'Something went wrong. please try again';
           $data['message'] = $e->getMessage();
        }

        return $data;
    }

    public function destroy(Request $request, $id)
    {
        try {
            if ($request->ajax()) {
                $portfolio = portfolio::findOrFail(decrypt($id));
                    $portfolio->deleted_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                    $portfolio->save();
                    if($portfolio->delete()){
                        $data['id']= $id;
                        $data['status']=true;
                        $data['msg']= $portfolio->display_name.' is successfully deleted.';
                    }
                
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'portfolio';
            $data['message'] = 'Something went wrong. please try again';
        //    $data['error'] = $e->getMessage();
        }

        return $data;
    }
}
