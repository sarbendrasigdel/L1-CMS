<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'=> 'required|string',
            'email'=> 'required|email',
            'description'=> 'required',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Please enter your name',
            'name.string'=>'Invalid Name!!',
            'email.required'=>'Please enter your email',
            'email.email'=> 'Invalid Email',
            'description.required'=>'please enter some message'
        ];
    }
}
