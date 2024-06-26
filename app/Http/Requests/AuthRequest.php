<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'min:8|required',
            'remember' => 'nullable'
        ];
    }


    public function attributes(): array
    {
        return [
            'email' => __('auth.title_email'),
            'password' => __('auth.title_password'),
        ];
    }


    //  show message in respective selected lang
    public function messages(): array
    {
        return [
            'email' => __('auth.invalid_email'),
            'password' => __('auth.invalid_password'),
        ];
    }
}