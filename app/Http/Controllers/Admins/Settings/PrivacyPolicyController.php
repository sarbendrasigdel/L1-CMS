<?php

namespace App\Http\Controllers\Admins\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Setting\TermsAndCondition\CreateTermsAndConditionRequest;
use App\Library\BreadCrumbs;
use App\Models\Admins\Settings\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrivacyPolicyController extends Controller
{
    use BreadCrumbs;

    public function index()
    {
        $data['title'] = 'Privacy Policy';
        $data['menu'] = 'Setting';
        $data['subMenu'] = 'Privacy Policy';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        $data['privacyPolicy'] = TermsAndCondition::where('type', 'privacy_policy')->first();
        return view('admin.setting.terms-and-condition.privacy-policy.index', $data);
    }

    public function store(CreateTermsAndConditionRequest $request)
    {
        try {
            DB::beginTransaction();
            if ($request->ajax()) {
                $privacyPolicy = TermsAndCondition::where('type', 'privacy_policy')->first();
                if (!$privacyPolicy) {
                    $privacyPolicy = new TermsAndCondition();
                }
                $privacyPolicy->type = 'privacy_policy';
                $privacyPolicy->title = $request->title;
                $privacyPolicy->description = $request->backinputone;
                $privacyPolicy->active_status = ($request->has('active_status')) ? true : false;
                $privacyPolicy->save();
            }
            DB::commit();
            $data['status'] = true;
            $data['title'] = 'Privacy Policy';
            $data['message'] = 'Privacy Policy added successfully';
        } catch (\Exception $e) {
            DB::rollBack();
            $data['status'] = false;
            $data['title'] = 'Privacy Policy';
            $data['message'] = 'Something went wrong. please try again';
            $data['error'] = $e->getMessage();
        }
        return $data;
    }
}
