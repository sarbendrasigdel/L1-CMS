<?php

namespace App\Http\Controllers\Admins\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Setting\TermsAndCondition\CreateTermsAndConditionRequest;
use App\Library\BreadCrumbs;
use App\Models\Admins\Settings\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermsAndConditionController extends Controller
{
    use BreadCrumbs;

    public function index()
    {
        $data['title'] = 'Terms And Condition';
        $data['menu'] = 'Setting';
        $data['subMenu'] = 'Terms And Condition';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        $data['termsAndCondition'] = TermsAndCondition::where('type', 'terms_and_condition')->first();
        return view('admin.setting.terms-and-condition.terms-and-condition.index', $data);
    }

    public function store(CreateTermsAndConditionRequest $request)
    {
        try {
            DB::beginTransaction();
            if ($request->ajax()) {
                $termsAndCondition = TermsAndCondition::where('type', 'terms_and_condition')->first();
                if (!$termsAndCondition) {
                    $termsAndCondition = new TermsAndCondition();
                }
                $termsAndCondition->type = 'terms_and_condition';
                $termsAndCondition->title = $request->title;
                $termsAndCondition->description = $request->backinputone;
                $termsAndCondition->active_status = ($request->has('active_status')) ? true : false;
                $termsAndCondition->save();
            }
            DB::commit();
            $data['status'] = true;
            $data['title'] = 'Terms And Condition';
            $data['message'] = 'Terms And Condition added successfully';
        } catch (\Exception $e) {
            DB::rollBack();
            $data['status'] = false;
            $data['title'] = 'Terms And Condition';
            $data['message'] = 'Something went wrong. please try again';
            $data['error'] = $e->getMessage();
        }
        return $data;
    }
}


