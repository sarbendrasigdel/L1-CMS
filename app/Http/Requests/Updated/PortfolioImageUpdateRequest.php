<?php

namespace App\Http\Requests\Updated;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioImageUpdateRequest extends FormRequest
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
            'image'=>'required',
            'portfolio_id'=>'required'
        ];
    }

    public function messages()
    {
        return[
            'image.required'=>'please insert an image',
            'portfolio_id.required'=>'please selce a project.'
        ];
    }
}