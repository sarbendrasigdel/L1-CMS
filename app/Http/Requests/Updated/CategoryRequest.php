<?php

namespace App\Http\Requests\Updated;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'=>'required|string|unique:categories,name',
            'description' => 'required',
            'featured_add' => 'boolean'
        ];
    }

    public function messages()
    {
        return[
            'name.required'=> 'Please provide category name',
            'name.unique' => 'Category already exists',
            'name.string'=> 'The name can only contain alphabets',
            'description.required'=> 'Please provide description',
            'featured_add.boolean'=> 'Invalid Operation'
        ];
    }
}
