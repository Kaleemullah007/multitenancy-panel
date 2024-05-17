<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlaceholderRequest extends FormRequest
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
            'name' => 'required|max:255',
            'key_name' => 'required|max:255|unique:placeholders,key_name,' . $this->placeholder->id,
            'status' => 'required|boolean'
        ];
    }
    // Add some values before checking request
    public function prepareForValidation()
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

    //  show message in respective selected lang
    public function messages(): array
    {
        return [
            'name' => __('placeholder.message.error_name'),
            'key_name.unique' => __('placeholder.message.error_key_name'),
            'key_name.unique' => __('placeholder.message.error_name_unique'),
        ];
    }
}