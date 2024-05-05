<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:plans,name,' . $this->plan->id],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'validity_month' => ['required', 'numeric'],
            'status' => ['required', 'boolean']
        ];
    }

    public function messages(): array
    {
        return [
            'name' => __('plan.message.error_name'),
            'name.unique' => __('plan.message.error_name_unique'),
            'description' => __('plan.message.error_description'),
            'price' => __('plan.message.error_price'),
            'validity_month' => __('plan.message.error_validity_month')
        ];
    }
    protected function prepareForValidation()
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
}