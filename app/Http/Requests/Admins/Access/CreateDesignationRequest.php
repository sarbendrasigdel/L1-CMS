<?php

namespace App\Http\Requests\Admins\Access;

use Illuminate\Foundation\Http\FormRequest;

class CreateDesignationRequest extends FormRequest
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
            'designation_name' => 'required|unique:designations,name',
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
