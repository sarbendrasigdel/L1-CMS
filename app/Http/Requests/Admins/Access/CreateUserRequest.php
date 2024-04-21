<?php

namespace App\Http\Requests\Admins\Access;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'username' => 'required|unique:admin_users,username',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'full_name' => 'required',
            'designation' => 'required',
            'role' => 'required',
            'phone' => 'required',
            'permissions' => 'required',
            'email' => 'required|email',
        ];
    }

    public function messages(){
        return [
            'username.required' => 'Username is required',
            'username.unique' => 'Username must be unique.',
            'password.required' => 'Password is required',
            'confirm_password.required' => 'Confirm Password is required',
            'full_name.required' => 'Full Name is required',
            'permissions.required' => 'Please select at least one permission.',
        ];
    }
}
