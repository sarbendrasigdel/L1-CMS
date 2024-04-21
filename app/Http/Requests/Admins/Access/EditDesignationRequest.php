<?php

namespace App\Http\Requests\Admins\Access;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditDesignationRequest extends FormRequest
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
        $id = decrypt(request('designation'));
        return [
            'designation_name' => ['required',
                Rule::unique('designations', 'name')->ignore($id, 'id'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'designation_name.required' => 'Designation Name is Required.',
            'designation_name.unique' => 'Designation Name Already Taken.',
        ];
    }
}
