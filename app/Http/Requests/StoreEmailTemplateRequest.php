<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmailTemplateRequest extends FormRequest
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
            'title' => 'required|max:255|unique:email_templates,title',
            'subject' => 'required|max:255',
            'body' => 'required|max:255',
            'template_type' => 'required|boolean',
            'status' => 'required|boolean'
        ];
    }

    // Add some value before checking request
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
        if (!$this->get('template_type')) {
            $this->merge([
                'template_type' => false,
            ]);
        } else {
            $this->merge([
                'template_type' => true,
            ]);
        }
    }

    //  show message in respective selected lang
    public function messages(): array
    {
        return [
            'title' => __('emailtemplate.message.error_title'),
            'title.unique' => __('emailtemplate.message.error_title_unique'),
            'subject' => __('emailtemplate.message.error_subject'),
            'title' => __('emailtemplate.message.error_body'),
            'template_type' => __('emailtemplate.message.error_template_type'),
            'status' => __('emailtemplate.message.error_status'),

        ];
    }
}
