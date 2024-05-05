<?php

namespace App\Http\Requests;

use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateTenantRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tenants,email,' . $this->tenant->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed', Password::defaults()],
            'domain_name' => ['required', 'string', 'unique:tenants,name,' . $this->tenant->id],
            'photo' => 'nullable|file|image|mimes:jpeg,jpg,png|max:2048',
            'plan_id' => ['required', 'numeric'],
            'plan_name' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'validaty' => ['required', 'numeric'],
            'plan_price' => ['required', 'numeric'],
            'status' => ['required', 'boolean'],
        ];
    }
    protected function prepareForValidation()
    {

        $plan = Plan::where('id', $this->get('plan_id'))->first();

        if ($this->get('update_plan')) {
            $start_date = date('Y-m-d');
            $end_date = Carbon::parse($this->tenant->user->end_date)->addMonths($plan->validity_month)->format('Y-m-d');

            // dd($diff, $end_date, $this->tenant->user);
        } else {
            // dd($this->tenant->user->start_date);
            $start_date = $this->tenant->user->start_date;
            $end_date = $this->tenant->user->end_date;
        }

        if (!$this->get('status')) {


            $this->merge([
                'status' => false,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'validaty' => $plan->validity_month,
                'plan_name' => $plan->name,
                'plan_price' => $plan->price,
                'domain_name' => $this->get('name')
            ]);
        } else {
            $this->merge([
                'status' => true,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'validaty' => $plan->validity_month,
                'plan_name' => $plan->name,
                'plan_price' => $plan->price,
                'domain_name' => $this->get('name')
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'name' => __('tenant.message.error_name'),
            'email' => __('tenant.message.error_email'),
            'password' => __('tenant.message.error_password'),
            'domain_name' => __('tenant.message.error_domain'),
            'domain_name.unique' => __('tenant.message.error_domain_already'),
            'photo' => __('tenant.message.error_profile_photo')
        ];
    }
}