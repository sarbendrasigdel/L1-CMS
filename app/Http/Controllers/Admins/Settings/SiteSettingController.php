<?php

namespace App\Http\Controllers\Admins\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Setting\SiteSetting\CreateSiteSettingRequest;
use App\Library\AuthUser;
use App\Library\BreadCrumbs;
use App\Models\Admins\Settings\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteSettingController extends Controller
{
    use AuthUser, BreadCrumbs;

    public function index(){
        $data['title'] ='Site Information';
        $data['menu'] ='Setting';
        $data['subMenu'] ='Site Information';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        $data['siteSettings'] = SiteSetting::first();
        return view('admin.setting.site-settings.index', $data);
    }

    public function store(CreateSiteSettingRequest $request){
        try {
            if ($request->ajax()){
                $siteSetting = SiteSetting::first();
                if (!$siteSetting){
                    $siteSetting = new SiteSetting();
                }
                $siteSetting->company_name = $request->company_name;
                $siteSetting->company_logo = $request->company_logo;
                $siteSetting->company_email = $request->company_email;
                $siteSetting->company_location = $request->company_location;
                $siteSetting->contact_number = $request->contact_number;
                $siteSetting->copyright = $request->copyright;
                $siteSetting->facebook = $request->facebook;
                $siteSetting->instagram = $request->instagram;
                $siteSetting->twitter = $request->twitter;
                $siteSetting->linkedin = $request->linkedin;
                $siteSetting->youtube = $request->youtube;
                $siteSetting->meta_title = $request->meta_title;
                $siteSetting->meta_description = $request->backinputone;
                $siteSetting->active_status = ($request->has('active_status')) ? true : false;
                $siteSetting->save();
            }

            $data['status']     = true;
            $data['title']      = 'Site Information';
            $data['message']    = 'Site Information saved successfully';

        }catch (\Exception $e){
            $data['status']     = false;
            $data['title']      = 'Site Information';
            $data['message']    = 'Something went wrong. please try again';
//            $data['error']      = $e->getMessage();
        }
        return $data;
    }
}
