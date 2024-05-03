<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class TenantRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Password::defaults()],
            'domain_name' => ['required', 'string', 'unique:domains,domain'],
            'photo' => 'required|file|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'name' => __('tenant.message.error_name'),
            'email' => __('tenant.message.error_email'),
            'password' => __('tenant.message.error_password'),
            'domain_name' => __('tenant.message.error_domain_name'),
            'photo' => __('tenant.message.error_profile_photo'),
        ];
    }
}