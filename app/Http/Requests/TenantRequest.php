<?php

namespace App\Http\Requests;

use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class TenantRequest extends FormRequest
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
            'plan_id' => ['required', 'numeric'],
            'plan_name' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'validaty' => ['required', 'numeric'],
            'plan_price' => ['required', 'numeric'],
            'status' => ['required', 'boolean'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Password::defaults()],
            'domain_name' => ['required', 'string', 'unique:domains,domain'],
            'photo' => 'required|file|image|mimes:jpeg,jpg,png|max:2048',

        ];
    }

    protected function prepareForValidation()
    {

        $plan = Plan::where('id', $this->get('plan_id'))->first();


        if (!$this->get('status')) {



            $this->merge([
                'status' => false,
                'start_date' => date('Y-m-d'),
                'end_date' => Carbon::now()->addMonths($plan->validity_month)->format('Y-m-d'),
                'validaty' => $plan->validity_month,
                'plan_name' => $plan->name,
                'plan_price' => $plan->price,
            ]);
        } else {
            $this->merge([
                'status' => true,
                'start_date' => date('Y-m-d'),
                'end_date' => Carbon::now()->addMonths($plan->validity_month),
                'validaty' => $plan->validity_month,
                'plan_name' => $plan->name,
                'plan_price' => $plan->price,
            ]);
        }
    }


    public function messages(): array
    {
        return [
            'name' => __('tenant.message.error_name'),
            'email' => __('tenant.message.error_email'),
            'password' => __('tenant.message.error_password'),
            'domain_name' => __('tenant.message.error_domain_name'),
            'photo' => __('tenant.message.error_profile_photo'),
        ];
    }
}