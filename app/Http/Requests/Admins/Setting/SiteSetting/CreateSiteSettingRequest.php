<?php

namespace App\Http\Requests\Admins\Setting\SiteSetting;

use Illuminate\Foundation\Http\FormRequest;

class CreateSiteSettingRequest extends FormRequest
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
        return [
            'company_name' => 'required',
            'company_email' => 'required',
            'company_location' => 'required',
            'contact_number' => 'required',
            'copyright' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'company_name' => 'Company Name is required',
            'company_email' => 'Email is required',
            'company_location' => 'Location is required',
            'contact_number' => 'Contact Number is required',
            'copyright' => 'Copyright is required',
        ];
    }
}
