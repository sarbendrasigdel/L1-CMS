<?php

namespace App\Http\Controllers\Admins\Updated;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Pagesettings\Testimonial;
use App\Http\Requests\Updated\TestimonialRequest;
use App\Http\Requests\Updated\TestimonialUpdaterequest;
use Illuminate\Support\Facades\DB;
use App\Models\Admins\AdminUserInfo;
use App\Library\AuthUser;
use App\Library\BreadCrumbs;

class TestimonialController extends Controller
{
    use AuthUser,BreadCrumbs;
    public function index()
    {
        $data['title'] = 'Team';
        $data['menu'] = 'homepage';
        $data['subMenu'] = 'Testimonials';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        return view('admin.pagesettings.testimonials.index',$data);
    }

    public function edit($id)
    {
        $Testimonial = Testimonial::get()
                        ->where('id', decrypt($id))->first();

        return $Testimonial;
    }

    public function store(TestimonialRequest $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $Testimonial = new Testimonial();
            $Testimonial->name = $request->name;
            $Testimonial->image = $request->image;
            $Testimonial->company = $request->company;
            $Testimonial->description = $request->description;  
            $Testimonial->active_status = ($request->has('active_status_add')) ? true : false;
            $Testimonial->created_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
            $Testimonial->save();
            DB::commit();
            $data['status'] = true;
            $data['title'] = 'Testimonial Management';
            $data['message'] = 'Testimonial added successfully';
        } catch (\Exception $e) {
            DB::rollback();
            $data['status'] = false;
            $data['title'] = 'Testimonial Management';
            $data['message'] = 'Something went wrong. please try again';
            $data['error'] = $e->getMessage();
        }

        return $data;
    }

    public function update(TestimonialUpdateRequest $request, $id)
    {
        // dd($request->all());
        try {
            if ($request->ajax()) {
                $Testimonial = Testimonial::find(decrypt($id));
                $Testimonial->name = $request->name;
                $Testimonial->image = $request->image;
                $Testimonial->company = $request->company;
                $Testimonial->description = $request->description; 
                $Testimonial->active_status = ($request->has('active_status')) ? true : false;
                $Testimonial->updated_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $Testimonial->save();

                $data['status'] = true;
                $data['title'] = 'Testimonial';
                $data['message'] = 'Testimonial Updated Successfully.';
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Testimonial';
            $data['message'] = 'Something went wrong. please try again';
           $data['message'] = $e->getMessage();
        }

        return $data;
    }

    public function fetchTestimonialList(Request $request)
    {
        // dd($request->all());
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'company',
            3 => 'active_status',
            4 => 'created_at',
            5 => 'id',
        );
        $data['Testimonial'] = array();
        $totalData = Testimonial::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $dat = array();
        $datas = array();

        $searchKey = $request->input('search.value');
            $TestimonialLists =  Testimonial::FilterByGlobalSearch($searchKey);
            $totalData = $TestimonialLists->count();
            $Testimonials = $TestimonialLists->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = $totalData;
    
    if(!empty($Testimonials)){
        $TestimonialData = array();
        foreach($Testimonials as $index => $Testimonial){
            $nestedData = array();
            $nestedData['id'] = $index + 1;
            $nestedData['TestimonialId'] = encrypt($Testimonial->id);
            $nestedData['name'] = $Testimonial->name;
            $nestedData['company'] = $Testimonial->company;
            $nestedData['active_status'] = $Testimonial->active_status;
            $nestedData['created_at'] = $Testimonial->created_at->toDateTimeString();
            $nestedData['edit_permission'] = true;
            $nestedData['delete_permission'] = true;
            $nestedData['is_editable'] = true;
            $TestimonialData[] = $nestedData;
        }
        $tableContent = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $TestimonialData,
        );

        return $tableContent;
    }
    

    }
    public function destroy(Request $request, $id)
    {
        try {
            if ($request->ajax()) {
                $Testimonial = Testimonial::findOrFail(decrypt($id));
                

                    // $Testimonial->deleted_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                    $Testimonial->save();
                    if($Testimonial->delete()){
                        $data['id']= $id;
                        $data['status']=true;
                        $data['msg']= $Testimonial->display_name.' is successfully deleted.';
                    }
                
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Testimonial';
            $data['message'] = 'Something went wrong. please try again';
//            $data['message'] = $e->getMessage();
        }

        return $data;
    }
    
}
