<?php

namespace App\Http\Controllers\Admins\Updated;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\AuthUser;
use App\Library\BreadCrumbs;
use App\Http\Requests\Updated\HomeRequest;
use App\Models\Home;
class HomepageController extends Controller
{
    use AuthUser,BreadCrumbs;
    public function index()
    {
        $data['title'] = 'Team';
        $data['menu'] = 'pagesetting';
        $data['subMenu'] = 'HomePage';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        $data['home'] = Home::first();
        return view('admin.pagesettings.home.index',$data);
    }


    public function store(HomeRequest $request){
        try {
            if ($request->ajax()){
                $home = Home::first();
                if (!$home){
                    $home = new Home();
                }
                $home->heading = $request->heading;
                $home->description = $request->description;
                $home->discover_img = $request->discover_img;
                $home->discover_text = $request->discover_text;
                $home->quote = $request->quote;
                $home->service_img = $request->service_img;
                // $home->active_status = ($request->has('active_status')) ? true : false;
                $home->save();
            }

            $data['status']     = true;
            $data['title']      = 'Homepage Information';
            $data['message']    = 'Homepage Information saved successfully';

        }catch (\Exception $e){
            $data['status']     = false;
            $data['title']      = 'Homepage Information';
            $data['message']    = 'Something went wrong. please try again';
//            $data['error']      = $e->getMessage();
        }
        return $data;
    }


}
