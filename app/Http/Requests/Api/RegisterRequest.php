<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => ['required', Password::defaults()],
            'password_confirmation' => ['required_with:password|same:password', Password::defaults()]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The field is required',
            'name.*' => 'The field is invalid',
            'last_name.required' => 'The field is required',
            'last_name.*' => 'The field is invalid',
            'email.required' => 'The field is required',
            'email.*' => 'The field is invalid',
            'password.required' => 'The field is required',
            'password.*' => 'The field is invalid',
            'password_confirmation.required' => 'The field is required',
            'password_confirmation.*' => 'The field is invalid',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['error' => $validator->errors()], 422));
    }
}
