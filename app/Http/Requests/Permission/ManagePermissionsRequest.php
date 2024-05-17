<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class ManagePermissionsRequest extends FormRequest
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
            'roles' => ['array', 'required', 'min:1'],
            'permissions' => ['array', 'required', 'min:1']
        ];
    }


    //  show message in respective selected lang
    public function messages(): array
    {
        return [
            'roles' => __('tenantuser.message.error_roles'),
            'permissions' => __('tenantuser.message.error_permissions'),
        ];
    }
    public function attributes(): array
    {
        return [
            'roles' => __('tenantuser.form.roles'),
            'permissions' => __('tenantuser.form.permissions'),
        ];
    }
}
