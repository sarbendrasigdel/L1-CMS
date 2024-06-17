<?php

namespace App\Http\Requests\Updated;

use Illuminate\Foundation\Http\FormRequest;

class PriceUpdateRequest extends FormRequest
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
            'title'=> 'required',
            'price'=> 'required|integer',
            'description'=> 'required',
        ];
    }
    public function messages()
    {
        return[
            'title.required'=>'The title is required.',
            'price.required'=>'The price is required.',
            'price.integer'=>'The price must be a number.',
            'description.required'=>'The description is required.',
            'category_id_add.required'=>'The category is required.',
        ];
    }
}
