<?php

namespace App\Http\Requests\Admins\Setting\SeoSetting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class SeoSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $message =[
            'meta_title' => 'required',
            'meta_description' => 'required',
        ];

        if (Route::currentRouteName() == 'admin.storeSeoSetting'){
            $message+= [
                'page_name' => 'required|unique:seo_settings,page_name',
            ];
        }else{
            $id = decrypt(request('editFormId'));
            $message+= [
                'page_name' => ['required',
                    Rule::unique('seo_settings', 'page_name')->ignore($id, 'id'),
                ],
            ];
        }
        return $message;

    }

    public function messages()
    {
        return [
            'page_name.required' => 'This field is required',
            'meta_title.required' => 'This field is required',
            'meta_description.required' => 'This field is required',
            'page_name.unique' => 'Page Name already exists'
        ];
    }
}
