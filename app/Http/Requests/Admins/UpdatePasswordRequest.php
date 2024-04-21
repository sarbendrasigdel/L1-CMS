<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages(){
        return[
            'old_password.required' =>'Sorry !Old  Password is missing.',
            'password.required' =>'Sorry ! Password is missing.',
            'password.confirmed' =>'Sorry ! Password do not match.',
            'password_confirmation.required' =>'Sorry ! Confirm Password is missing.',
        ];
    }
}
