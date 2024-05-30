<?php

namespace App\Http\Requests\Updated;

use Illuminate\Foundation\Http\FormRequest;

class TeamUpdateRequest extends FormRequest
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
            'id' => 'required',
            'name' =>'required|string',
            'image' =>'required',
            'position' => 'required',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'github' => 'nullable|url',
            'featured' => 'boolean'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name can only contain alphabets.',
            'image.required' => 'please upload an image.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
            'position.required' => 'The position field is required.',
            'facebook.url' => 'The Facebook field must be a valid URL.',
            'instagram.url' => 'The Instagram field must be a valid URL.',
            'twitter.url' => 'The Twitter field must be a valid URL.',
            'github.url' => 'The GitHub field must be a valid URL.',
            'featured.boolean'=> 'Invalid Operation'
        ];
    }
}
