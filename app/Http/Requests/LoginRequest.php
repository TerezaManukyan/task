<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => ['required', Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The field is required',
            'email.*' => 'The field is invalid',
            'password.required' => 'The field is required',
            'password.*' => 'The field is invalid',
        ];
    }
}
