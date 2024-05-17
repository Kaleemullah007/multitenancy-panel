<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
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
            'name' => 'required|max:255|unique:permissions,name,' . $this->permission->id
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('permission.form.name'),
        ];
    }

    //  show message in respective selected lang
    public function messages(): array
    {
        return [
            'name' => __('permission.message.error_name'),
            'name.unique' => __('permission.message.error_name_unique'),
        ];
    }
}
