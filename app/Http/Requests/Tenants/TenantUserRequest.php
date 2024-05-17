<?php

namespace App\Http\Requests\Tenants;

use App\Rules\Tenants\CheckSuperAdmin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class TenantUserRequest extends FormRequest
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
            'status' => ['required', 'boolean'],
            'roles' => ['array', 'required', 'min:1', new CheckSuperAdmin],
        ];
    }

    // Add some value before checking request
    protected function prepareForValidation()
    {
        if (!$this->get('status')) {
            $this->merge([
                'status' => true,
            ]);
        }
    }

    public function attributes(): array
    {
        return [
            'name' => __('permission.form.name'),
            'email.unique' => __('tenantuser.message.error_email_unique'),
        ];
    }
}
