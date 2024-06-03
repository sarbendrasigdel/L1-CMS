<?php

namespace App\Http\Requests\Updated;

use Illuminate\Foundation\Http\FormRequest;

class portfolioRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:portfolios,title',
            'client' => 'required|string|max:255',
            'image' => 'required',
            'description' => 'required|string',
            'category_id_add' => 'required',
            'date' => 'required|date'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.unique' => 'The title already exists',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'client.required' => 'The client name field is required.',
            'client.string' => 'The client name must be a string.',
            'client.max' => 'The client name may not be greater than 255 characters.',
            'image.required' => 'The image field is required.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'category_id_add.required' => 'The category field is required.',
            'date.required' => 'The date field is required.',
            'date.date' => 'The date is not a valid date format.',
        ];
    }
}
