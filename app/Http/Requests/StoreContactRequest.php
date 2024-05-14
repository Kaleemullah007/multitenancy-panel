<?php

namespace App\Http\Requests;

use App\Rules\CheckCaptache;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required',
            'captache' => ['required', new CheckCaptache]
        ];
    }
    public function messages(): array
    {
        return [
            'name' => __('contact.message.error_name'),
            'email' => __('contact.message.error_email'),
            'subject' => __('contact.message.error_subject'),
            'message' => __('contact.message.error_message'),
            'captache.required' => __('contact.message.error_captache')


        ];
    }
    public function modifyInput(array $data)
    {
        unset($data['captache']);

        // Make sure to return it.
        return $data;
    }
}
