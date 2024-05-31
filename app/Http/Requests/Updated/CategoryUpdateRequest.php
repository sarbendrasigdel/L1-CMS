<?php

namespace App\Http\Requests\Updated;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'description' => 'required',
            'featured_add' => 'boolean'
                ];
    }
    public function messages()
    {
        return[
            'name.required'=> 'Please provide category name',
            'name.string'=> 'The name can only contain alphabets',
            'description.required'=> 'Please provide description',
            'featured_add.boolean'=> 'Invalid Operation'
        ];
    }
}
