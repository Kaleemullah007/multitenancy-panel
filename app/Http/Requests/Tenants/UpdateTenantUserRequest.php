<?php

namespace App\Http\Requests\Tenants;

use App\Rules\Tenants\CheckSuperAdmin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateTenantUserRequest extends FormRequest
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
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'password' => ['nullable', 'string', 'min:8', 'confirmed', Password::defaults()],
            'roles' => ['array', 'required', 'min:1', new CheckSuperAdmin],
        ];
    }
    //  show message in respective selected lang
    public function messages(): array
    {
        return [
            'name' => __('tenant.message.error_name'),
            'email' => __('tenant.message.error_email'),
            'password' => __('tenant.message.error_password'),
            'email.unique' => __('tenantuser.message.error_email_unique'),

        ];
    }
}
