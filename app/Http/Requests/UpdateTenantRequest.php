<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateTenantRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tenants,email,' . $this->tenant->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed', Password::defaults()],
            'domain_name' => ['required', 'string', 'unique:tenants,name,' . $this->tenant->id],
            'photo' => 'nullable|file|image|mimes:jpeg,jpg,png|max:2048',
            'status' => 'required|boolean'
        ];
    }
    protected function prepareForValidation()
    {
        if (!$this->get('status')) {
            $this->merge([
                'status' => false,
            ]);
        } else {
            $this->merge([
                'status' => true,
            ]);
        }
    }
    public function messages(): array
    {
        return [
            'name' => __('tenant.message.error_name'),
            'email' => __('tenant.message.error_email'),
            'password' => __('tenant.message.error_password'),
            'domain_name' => __('tenant.message.error_domain'),
            'photo' => __('tenant.message.error_profile_photo')
        ];
    }
}
