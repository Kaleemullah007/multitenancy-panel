<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTenantProfileRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:6|confirmed',
            'photo' => 'nullable|file|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }
    //  show message in respective selected lang
    public function messages(): array
    {
        return [
            'name' => __('user.message.error_name'),
            'email' => __('user.message.error_email'),
            'password' => __('user.message.error_password'),
            'password_confirmation' => __('user.message.error_password_confirm'),
            'photo' => __('user.message.error_profile_photo')
        ];
    }
}
