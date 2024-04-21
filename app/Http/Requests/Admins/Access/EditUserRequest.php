<?php

namespace App\Http\Requests\Admins\Access;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditUserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if($request->has('new_password')){
            return [
                'new_password' => 'required',
                'confirm_password' => 'required|same:new_password',
                'full_name' => 'required',
                'designation' => 'required',
                'phone' => 'required',
                'permissions' => 'required',
                'email' => 'required',
            ];
        }else{
            return [
                'full_name' => 'required',
                'designation' => 'required',
                'phone' => 'required',
                'permissions' => 'required',
                'email' => 'required',
            ];
        }
    }

    public function messages(){
        return [
            'password.required' => 'Password is required',
            'confirm_password.required' => 'Confirm Password is required',
            'full_name.required' => 'Full Name is required',
            'permissions.required' => 'Please select at least one permission.',
        ];
    }
}
