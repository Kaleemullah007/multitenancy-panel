<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            'message' => 'required',
            'sender_id' => 'required|numeric',
            'receiver_id' => 'required|numeric'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'receiver_id' => $this->segment(2),
            'sender_id' => auth()->id(),
        ]);
    }

    public function messages(): array
    {
        return [
            'message' => __('contact.message.error_message')
        ];
    }
}
