<?php

namespace App\Http\Requests\Updated;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialUpdateRequest extends FormRequest
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
            'name'=>'required|string',
            'image'=>'required',
            'company'=>'required',
            'description'=>'required'
        ];
    }
    public function messages()
    {
       return [
            'name.required'=>'The name is required',
            'name.string'=>'The name can only contain alphabets',
            'image.required'=>'please upload an image',
            'company.required'=>'The company name is required',
            'description.required'=>'The description is required',
       ];
    }
}
