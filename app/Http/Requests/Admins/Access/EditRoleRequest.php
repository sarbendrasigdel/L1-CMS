<?php

namespace App\Http\Requests\Admins\Access;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class EditRoleRequest extends FormRequest
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
        $id = decrypt(request('role'));
        return [
            'role_name' => ['required',
                Rule::unique('roles', 'name')->ignore($id, 'id'),
            ],
            'display_name' => ['required',
                Rule::unique('roles', 'display_name')->ignore($id, 'id'),
            ],
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
