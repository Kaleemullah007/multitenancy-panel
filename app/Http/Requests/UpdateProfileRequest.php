<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'private_key' => 'nullable|string|min:10',
            'public_key' => 'nullable|string|min:10',
            'secret_key' => 'nullable|string|min:10',
            't_private_key' => 'nullable|string|min:10',
            't_public_key' => 'nullable|string|min:10',
            't_secret_key' => 'nullable|string|min:10',
            'is_prod' => 'required|boolean',
            'user_id' => 'required|numeric',
            'status' => 'required|boolean',
            'currency' => 'required|string',
            'photo' => 'nullable|file|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    // Add some value before check request
    public function prepareForValidation()
    {
        if (!$this->get('is_prod')) {
            $this->merge([
                'is_prod' => false,
                't_private_key' => $this->get('private_key'),
                't_public_key' => $this->get('public_key'),
                't_secret_key' => $this->get('secret_key'),
                'private_key' => null,
                'public_key' => null,
                'secret_key' => null,
            ]);
        } else {
            $this->merge([
                'is_prod' => true,
                't_private_key' => null,
                't_public_key' => null,
                't_secret_key' => null,
            ]);
        }

        $this->merge([
            'user_id' => auth()->id(),
            'status' => 1
        ]);
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
