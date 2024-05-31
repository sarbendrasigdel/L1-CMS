<?php

namespace App\Http\Requests\Updated;

use Illuminate\Foundation\Http\FormRequest;

class ServiceFeatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|unique:service_features,name',
            'service_id_add'=> 'required',
            'description'=>'required',
            
        ];
    }

    public function messages()
    {
        return[
            'name.required'=>'The feature name is required.',
            'name.unique'=>'Feature already exists',
            'service_id_add.required'=>'please select a  Service',
            'description.required'=> 'The description is required.'
        ];
    }
}
