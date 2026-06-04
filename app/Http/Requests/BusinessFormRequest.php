<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BusinessFormRequest extends FormRequest
{
    public const SERVICE_TYPES = [
        'Business Registration',
        'Start a Business',
        'Business Tax Return',
        'Business Activity Statement',
        'GST Registration',
        'PAYG Registration',
        'Company Setup',
        'Trust Setup',
        'Business Engagement Form',
    ];

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('abn') && $this->input('abn') !== null && $this->input('abn') !== '') {
            $this->merge(['abn' => preg_replace('/\D/', '', (string) $this->input('abn'))]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'business_name' => ['required', 'string', 'max:255'],
            'abn' => ['nullable', 'string', 'regex:/^\d{11}$/'],
            'business_structure' => ['required', 'string', Rule::in(['Sole Trader', 'Partnership', 'Company', 'Trust', 'SMSF', 'Other'])],
            'service_type' => ['required', 'string', Rule::in(self::SERVICE_TYPES)],
            'message' => ['required', 'string', 'max:5000'],
            'terms_accepted' => ['accepted'],
            'website' => ['prohibited'],
        ];
    }

    public function messages(): array
    {
        return [
            'website.prohibited' => 'Spam detected.',
            'abn.regex' => 'ABN must be exactly 11 digits.',
            'terms_accepted.accepted' => 'You must accept the terms and conditions.',
        ];
    }
}
