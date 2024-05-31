<?php

namespace App\Http\Controllers\Admins\Updated;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Pagesettings\category;
use Illuminate\Support\Facades\DB;
use App\Library\AuthUser;
use App\Library\BreadCrumbs;
use App\Http\Requests\Updated\CategoryRequest;
use App\Http\Requests\Updated\CategoryUpdateRequest;
class CategoryController extends Controller
{
    use AuthUser,BreadCrumbs;
    public function index()
    {
        $data['title'] = 'Team';
        $data['menu'] = 'pagesetting';
        $data['subMenu'] = 'Category';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        return view('admin.pagesettings.category.index',$data);
    }

    public function store(CategoryRequest $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $Category = new Category();
            $Category->name = $request->name;
            $Category->description = $request->description;
            $Category->featured = $request->has('featured_add') ? '1' : '0'; 
            $Category->active_status = ($request->has('active_status_add')) ? true : false;
            $Category->created_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
            $Category->save();

            

            DB::commit();
            $data['status'] = true;
            $data['title'] = 'Category Management';
            $data['message'] = 'Category added successfully';
        } catch (\Exception $e) {
            DB::rollback();
            $data['status'] = false;
            $data['title'] = 'Category Management';
            $data['message'] = 'Something went wrong. please try again';
            $data['error'] = $e->getMessage();
        }

        return $data;
    }

    public function edit($id)
    {
        $category = category::get()
                        ->where('id', decrypt($id))->first();

        return $category;

    }



    public function fetchCategoryList(Request $request)
    {
        // dd($request->all());
        $columns = array(
            0 => 'id',
            1 => 'category_name',
            2 => 'description',
            3 => 'active_status',
            4 => 'created_at',
            5 => 'id',
        );
        $data['team'] = array();
        $totalData = Category::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $dat = array();
        $datas = array();

        $searchKey = $request->input('search.value');
            $categoryLists =  Category::FilterByGlobalSearch($searchKey);
            $totalData = $categoryLists->count();
            $categories = $categoryLists->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = $totalData;
    
    if(!empty($categories)){
        $categoryData = array();
        foreach($categories as $index => $category){
            $nestedData = array();
            $nestedData['id'] = $index + 1;
            $nestedData['categoryId'] = encrypt($category->id);
            $nestedData['name'] = $category->name;
            $nestedData['description'] = $category->description;
            $nestedData['active_status'] = $category->active_status;
            $nestedData['created_at'] = $category->created_at->toDateTimeString();
            $nestedData['edit_permission'] = true;
            $nestedData['delete_permission'] = true;
            $nestedData['is_editable'] = $category->is_editable;
            $categoryData[] = $nestedData;
        }
        $tableContent = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $categoryData,
        );

        return $tableContent;
    }
    

    }

    public function update(CategoryUpdateRequest $request, $id)
    {

        try {
            if ($request->ajax()) {
                $category = Category::find(decrypt($id));
                // dd($category);
                $category->name = $request->name;
                $category->description = $request->description;
                $category->featured = $request->has('featured') ? '1' : '0' ; 
                $category->active_status = ($request->has('active_status')) ? true : false;
                $category->updated_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $category->save();

                $data['status'] = true;
                $data['title'] = 'Category';
                $data['message'] = 'Category Updated Successfully.';
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Category';
            $data['message'] = 'Something went wrong. please try again';
           $data['message'] = $e->getMessage();
        }

        return $data;
    }

    public function destroy(Request $request, $id)
    {
        try {
            if ($request->ajax()) {
                $category = Category::findOrFail(decrypt($id));
                

                    $category->deleted_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                    $category->save();
                    if($category->delete()){
                        $data['id']= $id;
                        $data['status']=true;
                        $data['msg']= $category->display_name.' is successfully deleted.';
                    }
                
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Category';
            $data['message'] = 'Something went wrong. please try again';
//            $data['message'] = $e->getMessage();
        }

        return $data;
    }

}
