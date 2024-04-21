<?php

namespace App\Http\Requests\Admins\Access;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'role_name' => 'required|unique:roles,name',
            'display_name' => 'required|unique:roles,display_name',
            'permissions' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'role_name.required' => 'Role Name is Required.',
            'role_name.unique' => 'Role Name Already Taken.',
            'display_name.required' => 'Display Name is Required.',
            'display_name.unique' => 'Display Name Already Taken.',
            'permissions.required' => 'Select At least One Permission .',
        ];
    }
}
