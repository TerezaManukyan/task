<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordResetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required', Password::defaults()],
            'password_confirmation' => ['required_with:password|same:password', Password::defaults()]
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'The field is required',
            'password.*' => 'The field is invalid',
            'password_confirmation.required' => 'The field is required',
            'password_confirmation.*' => 'The field is invalid',
        ];
    }
}
