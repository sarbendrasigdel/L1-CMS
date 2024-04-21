<?php

namespace App\Http\Controllers\Admins\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Setting\SeoSetting\SeoSettingRequest;
use App\Library\AuthUser;
use App\Library\BreadCrumbs;
use App\Models\Admins\Settings\SeoSetting;
use Illuminate\Http\Request;

class SeoSettingController extends Controller
{
    use AuthUser, BreadCrumbs;

    public function index()
    {
        $data['title'] = 'Seo Setting';
        $data['menu'] = 'Setting';
        $data['subMenu'] = 'Seo Setting';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        return view('admin.setting.seo-setting.index', $data);
    }

    public function store(SeoSettingRequest $request)
    {
        try {
            if ($request->ajax()) {
                $seoSettings = new SeoSetting();
                $seoSettings->page_name = $request->page_name;
                $seoSettings->meta_title = $request->meta_title;
                $seoSettings->meta_description = $request->meta_description;
                $seoSettings->active_status = ($request->has('active_status')) ? true : false;
                $seoSettings->created_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $seoSettings->save();
                $data['status'] = true;
                $data['title'] = 'Seo Setting ';
                $data['message'] = 'Seo Setting  Added Successfully.';
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Seo Setting ';
            $data['message'] = 'Something went wrong. please try again';
//            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    public function edit($id)
    {
        $seoSettings = SeoSetting::with('adminUserInfo', 'updatedByAdminUserInfo')
            ->where('id', decrypt($id))->first();
        return $seoSettings;
    }

    public function update(SeoSettingRequest $request, $id)
    {
        try {
            if ($request->ajax()) {
                $seoSettings = SeoSetting::find(decrypt($id));
                $seoSettings->page_name = $request->page_name;
                $seoSettings->meta_title = $request->meta_title;
                $seoSettings->meta_description = $request->meta_description;
                $seoSettings->active_status = ($request->has('active_status')) ? true : false;
                $seoSettings->updated_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $seoSettings->save();
                $data['status'] = true;
                $data['title'] = 'Seo Setting ';
                $data['message'] = 'Seo Setting  Updated Successfully.';
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'Seo Setting ';
            $data['message'] = 'Something went wrong. please try again';
//            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    public function destroy(Request $request, $id)
    {
        try {
            if ($request->ajax()) {
                $seoSettings = SeoSetting::findOrFail(decrypt($id));
                $seoSettings->deleted_by_admin_users_info_id = $this->getLoggedInUser()->latestAdminUserInfo->id;
                $seoSettings->save();
                $seoSettings->delete();
                $data['status'] = true;
                $data['title'] = 'Seo Setting ';
                $data['msg'] = 'Seo Setting  deleted successfully';
            }
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['title'] = 'SeoSetting ';
            $data['message'] = 'Something went wrong. please try again';
        }

        return $data;
    }

    public function fetchSeoSetting(Request $request)
    {
        //Log::info($request->all());
        $columns = array(
            0 => 'id',
            1 => 'page_name',
            2 => 'created_by',
            3 => 'created_at',
            4 => 'active_status',
            5 => 'id',
        );
        $data['medias'] = array();
        $totalData = SeoSetting::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $dat = array();
        $datas = array();
        if (empty($request->input('search.value'))) {
            for ($i = 1; $i < count($request->columns); $i++) {
                if (isset($request->columns[$i]['search']['value']) && $request->columns[$i]['search']['value'] != "") {
                    $dat[$request->columns[$i]['data']] = $request->columns[$i]['search']['value'];
                }
                $datas = $dat;
                if (!empty($datas)) {
                    $seoSettingsLists = SeoSetting::select('*')
                        ->FilteredByName((isset($datas['name']) && $datas['name'] != "") ? $datas['name'] : '')
                        ->FilteredByActiveStatus((isset($datas['active_status']) && $datas['active_status'] != "") ? $datas['active_status'] : '')
                        ->FilteredByCreatedDate((isset($datas['created_at']) && $datas['created_at'] != "") ? $datas['created_at'] : '')
                        ->FilteredByCreatedBy((isset($datas['created_by']) && $datas['created_by'] != "") ? $datas['created_by'] : '');
                    $totalData = $seoSettingsLists->count();
                    $seoSettings = $seoSettingsLists->offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir)
                        ->get();
                    $totalFiltered = $totalData;
                } else {
                    $seoSettings = SeoSetting::offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir)
                        ->get();
                    $totalFiltered = $totalData;
                }
            }
        } else {
            $searchKey = $request->input('search.value');
            $seoSettingsLists = SeoSetting::FilterByGlobalSearch($searchKey);
            $totalData = $seoSettingsLists->count();
            $seoSettings = $seoSettingsLists->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $totalData;
        }

        if (!empty($seoSettings)) {
            $seoSettingsData = array();
            foreach ($seoSettings as $index => $seoSetting) {
                $nestedData = array();
                $nestedData['id'] = $index + 1;
                $nestedData['globalDataId'] = encrypt($seoSetting->id);
                $nestedData['page_name'] = ucwords(str_replace('-',' ',$seoSetting->page_name));
                $nestedData['created_by'] = isset($seoSetting->adminUserInfo->full_name) ? $seoSetting->adminUserInfo->full_name : 'N/A';
                $nestedData['created_at'] = $seoSetting->created_at->toDateTimeString();
                $nestedData['active_status'] = $seoSetting->active_status;
                $nestedData['edit_permission'] = $this->checkPermission('view.seoSetting');
                $nestedData['delete_permission'] = $this->checkPermission('delete.seoSetting');
                $seoSettingsData[] = $nestedData;
            }
            $tableContent = array(
                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $seoSettingsData,
            );
            return $tableContent;
        }
    }

}
