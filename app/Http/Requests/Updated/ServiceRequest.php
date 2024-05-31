<?php

namespace App\Http\Requests\Updated;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'title' =>'required',
            'description' => 'required',
            'category_id_add' => 'required'
        ];
    }

    public function message()
    {
        return[
            'title.required' => 'The title is required.',
            'description.required'=> 'The description is required.',
            'category_id_add.required'=> 'Please Select a Category.'
        ];
    }
}
