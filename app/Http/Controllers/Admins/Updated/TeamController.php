<?php

namespace App\Http\Controllers\Admins\Updated;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\Pagesettings\Team;
use Illuminate\Support\Facades\DB;
use App\Models\Admins\AdminUserInfo;
use App\Library\AuthUser;
use App\Library\BreadCrumbs;
use App\Http\Requests\Updated\TeamRequest;
use App\Http\Requests\Updated\TeamUpdateRequest;

class TeamController extends Controller
{
    use AuthUser,BreadCrumbs;
    public function index()
    {
        $data['title'] = 'Team';
        $data['menu'] = 'pagesetting';
        $data['subMenu'] = 'Team';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        return view('admin.pagesettings.team.index',$data);
    }

    public function frontendIndex()
    {
        return view('Frontend.team');
    }
    public function edit($id)
    {
        $team = Team::get()
                        ->where('id', decrypt($id))->first();

        return $team;
    }

    public function store(TeamRequest $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $team = new Team();
            $team->name = $request->name;
            $team->image = $request->image;
            $team->position = $request->position;
            $team->facebook = $request->facebook;
            $team->instagram = $request->instagram;
            $team->twitter = $request->twitter;
            $team->github = $request->github;
            $team->featured = ($request->has('featured_add')) ? 1 : 0 ;    
            $team->active_status = ($request->has('active_status_add')) ? true : false;
            $team->created_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
            $team->save();

            // if (!empty($user)) {
            //     $user->syncPermissions($request->permissions);
            //     $userInfo = new Team();
            //     $userInfo->admin_user_id = $user->id;
            //     $userInfo->full_name = $request->full_name;
            //     $userInfo->email = $request->email;
            //     $userInfo->phone_number = $request->phone;
            //     $userInfo->address = $request->address;
            //     $userInfo->user_created_by_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
            //     $userInfo->save();

            //     if (!empty($userInfo)) {
            //         $this->addPermissionsLog($userInfo, $request->permissions);
            //         $userDesignation = new UserDesignation();
            //         $userDesignation->admin_users_info_id = $userInfo->id;
            //         $userDesignation->designation_id = $request->designation;
            //         $userDesignation->save();
            //     }
            // }

            DB::commit();
            $data['status'] = true;
            $data['title'] = 'Team Management';
            $data['message'] = 'Team added successfully';
        } catch (\Exception $e) {
            DB::rollback();
            $data['status'] = false;
            $data['title'] = 'Team Management';
            $data['message'] = 'Something went wrong. please try again';
            $data['error'] = $e->getMessage();
        }

        return $data;
    }

    public function update(TeamUpdateRequest $request, $id)
    {
        dd($request->all());
        try {
            if ($request->ajax()) {
                $team = Team::find(decrypt($id));
                $team->name = $request->name;
                $team->image = $request->image;
                $team->position = $request->position;
                $team->facebook = $request->facebook;
                $team->instagram = $request->instagram;
                $team->twitter = $request->twitter;
                $team->github = $request->github;
                $team->featured = ($request->has('featured')) ? 1 : 0 ; 
                $team->active_status = ($request->has('active_status')) ? true : false;
                $team->updated_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $team->save();

                $data['status'] = true;
                $data['title'] = 'Team';
                $data['message'] = 'Team Updated Successfully.';
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Team';
            $data['message'] = 'Something went wrong. please try again';
           $data['message'] = $e->getMessage();
        }

        return $data;
    }

    public function fetchTeamList(Request $request)
    {
        // dd($request->all());
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'position',
            3 => 'active_status',
            4 => 'created_at',
            5 => 'id',
        );
        $data['team'] = array();
        $totalData = Team::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $dat = array();
        $datas = array();

        $searchKey = $request->input('search.value');
            $teamLists =  Team::FilterByGlobalSearch($searchKey);
            $totalData = $teamLists->count();
            $teams = $teamLists->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = $totalData;
    
    if(!empty($teams)){
        $teamData = array();
        foreach($teams as $index => $team){
            $nestedData = array();
            $nestedData['id'] = $index + 1;
            $nestedData['teamId'] = encrypt($team->id);
            $nestedData['name'] = $team->name;
            $nestedData['position'] = $team->position;
            $nestedData['active_status'] = $team->active_status;
            $nestedData['created_at'] = $team->created_at->toDateTimeString();
            $nestedData['edit_permission'] = true;
            $nestedData['delete_permission'] = true;
            $nestedData['is_editable'] = true;
            $teamData[] = $nestedData;
        }
        $tableContent = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $teamData,
        );

        return $tableContent;
    }
    

    }
    public function destroy(Request $request, $id)
    {
        try {
            if ($request->ajax()) {
                $team = Team::findOrFail(decrypt($id));
                

                    // $team->deleted_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                    $team->save();
                    if($team->delete()){
                        $data['id']= $id;
                        $data['status']=true;
                        $data['msg']= $team->display_name.' is successfully deleted.';
                    }
                
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Team';
            $data['message'] = 'Something went wrong. please try again';
//            $data['message'] = $e->getMessage();
        }

        return $data;
    }
}
