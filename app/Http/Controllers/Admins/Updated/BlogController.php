<?php

namespace App\Http\Controllers\Admins\Updated;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\AuthUser;
use App\Http\Requests\Updated\BlogRequest;
use App\Http\Requests\Updated\BlogUpdateRequest;
use App\Library\BreadCrumbs;
use Illuminate\Support\Facades\DB;
use App\Models\Admins\Pagesettings\Blog;
use App\Models\Admins\Pagesettings\category;

class BlogController extends Controller
{
    use AuthUser,BreadCrumbs;
    public function index()
    {

        $data['title'] = 'Blog';
        $data['menu'] = 'otherpages';
        $data['subMenu'] = 'Blog';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        $data['category']= category::get();
        return view('admin.pagesettings.blog.index',$data);
    }
    public function store(BlogRequest $request)
        {
            // dd($request->all());
            try {
                DB::beginTransaction();
                $Blog = new Blog();
                $Blog->title = $request->title;
                $Blog->image = $request->image;
                $Blog->description = $request->description;
                $Blog->category_id = $request->category_id_add;
                $Blog->active_status = ($request->has('active_status_add')) ? true : false;
                $Blog->created_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $Blog->save();
    
                
    
                DB::commit();
                $data['status'] = true;
                $data['title'] = 'Blog Management';
                $data['message'] = 'Blog added successfully';
            } catch (\Exception $e) {
                DB::rollback();
                $data['status'] = false;
                $data['title'] = 'Blog Management';
                $data['message'] = 'Something went wrong. please try again';
                $data['error'] = $e->getMessage();
            }
    
            return $data;
        }
    
        public function edit($id)
        {
            
            $Blog = Blog::get()
            
            ->where('id', decrypt($id))->first();
            
            
            return $Blog;
    
        }
    
    
    
        public function fetchBlogList(Request $request)
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
            $totalData = Blog::count();
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
    
            $dat = array();
            $datas = array();
    
            $searchKey = $request->input('search.value');
                $BlogLists =  Blog::FilterByGlobalSearch($searchKey);
                $totalData = $BlogLists->count();
                $Blogs = $BlogLists->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                $totalFiltered = $totalData;
        
        if(!empty($Blogs)){
            $BlogData = array();
            foreach($Blogs as $index => $Blog){
                $nestedData = array();
                $nestedData['id'] = $index + 1;
                $nestedData['BlogId'] = encrypt($Blog->id);
                $nestedData['title'] = $Blog->title;
                $nestedData['description'] = $Blog->description;
                $nestedData['category'] = $Blog->category->name;
                $nestedData['active_status'] = $Blog->active_status;
                $nestedData['created_at'] = $Blog->created_at->toDateTimeString();
                $nestedData['edit_permission'] = true;
                $nestedData['delete_permission'] = true;
                $nestedData['is_editable'] = true;
                $BlogData[] = $nestedData;
            }

            $tableContent = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $BlogData,
            );
    
            return $tableContent;
        }
        
    
        }
    
        public function update(BlogUpdateRequest $request, $id)
        {
    
            try {
                if ($request->ajax()) {
                    $Blog = Blog::find(decrypt($id));
                    // dd($category);
                    $Blog->title = $request->title;
                    $Blog->image = $request->image;
                    $Blog->description = $request->description;
                    $Blog->category_id = $request->category_id;
                    $Blog->active_status = ($request->has('active_status')) ? true : false;
                    $Blog->updated_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                    $Blog->save();
    
                    $data['status'] = true;
                    $data['title'] = 'Blog';
                    $data['message'] = 'Blog Updated Successfully.';
                }
            } catch (\Exception $e) {
                $data['status'] = false;
                $data['title'] = 'Blog';
                $data['message'] = 'Something went wrong. please try again';
               $data['message'] = $e->getMessage();
            }
    
            return $data;
        }
    
        public function destroy(Request $request, $id)
        {
            try {
                if ($request->ajax()) {
                    $Blog = Blog::findOrFail(decrypt($id));
                        $Blog->deleted_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                        $Blog->save();
                        if($Blog->delete()){
                            $data['id']= $id;
                            $data['status']=true;
                            $data['msg']= $Blog->display_name.' is successfully deleted.';
                        }
                    
                }
            } catch (\Exception $e) {
                $data['status'] = false;
                $data['title'] = 'Blog';
                $data['message'] = 'Something went wrong. please try again';
            //    $data['error'] = $e->getMessage();
            }
    
            return $data;
        }
}
