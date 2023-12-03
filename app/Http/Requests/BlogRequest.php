<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:65000',
            'image' => 'required|image|mimes:jpg,png,svg,pdf',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The field is required',
            'name.*' => 'The field is invalid',
            'description.required' => 'The field is required',
            'description.*' => 'The field is invalid',
            'image.required' => 'The field is required',
            'image.*' => 'The field is invalid',
        ];
    }
}
