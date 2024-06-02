<?php

namespace App\Http\Requests\Updated;

use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
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
            'heading' =>'required',
            'description'=> 'required',
            'discover_img'=>'required',
            'discover_text'=>'required',
            'quote' => 'required',
            'service_img'=>'required'
        ];
    }

    public function messages()
    {
        return[
            'heading.required' => 'The heading is required',
            'description.required' => 'The description is required',
            'discover_img.required' => 'please upload an image',
            'discover_text' => 'The description is required',
            'quote.required'=> 'please enter few words by the founder',
            'service_img.required'=> 'Please upload an image'

        ];
    }
}
