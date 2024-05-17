<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignRequest extends FormRequest
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
            'name' => 'required|max:255|unique:campaigns,name',
            'user_type' => 'required',
            'user_type' => 'required|array|max:5',
            'email_template_id' => 'required|max:255',
            'type' => 'required',
            'published_at' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|boolean',
            'user_id' => 'required|numeric'
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


        if (!$this->get('type')) {
            $this->merge([
                'type' => false,
            ]);
        } else {
            $this->merge([
                'type' => true,
            ]);
        }



        if (!$this->get('published_at')) {
            $this->merge([
                'published_at' => now()->format('Y-m-d H:i:s'),
            ]);
        } else {
            $date = Carbon::parse($this->get('published_at'))->format('Y-m-d H:i:s');
            $this->merge([
                'published_at' => $date,
            ]);
        }
        $this->merge([
            'user_id' => auth()->id(),
        ]);
    }

    //  show message in respective selected lang
    public function messages(): array
    {
        return [
            'name' => __('compaign.message.error_name'),
            'name.unique' => __('compaign.message.error_name_unique'),
            'user_type' => __('compaign.message.error_user_type'),
            'template_type' => __('compaign.message.error_template_type'),
            'type' => __('compaign.message.error_type'),
            'published_at' => __('compaign.message.error_published_at'),
            'status' => __('compaign.message.error_status'),
            'user_id' => __('compaign.message.error_user_id'),

        ];
    }
}
