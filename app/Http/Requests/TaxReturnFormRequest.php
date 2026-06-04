<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaxReturnFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $numericFields = ['tfn', 'abn', 'bsb', 'post_code'];
        $cleaned = [];

        foreach ($numericFields as $field) {
            if ($this->has($field) && $this->input($field) !== null) {
                $cleaned[$field] = preg_replace('/\D/', '', (string) $this->input($field));
            }
        }

        $this->merge($cleaned);
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'gender' => ['required', 'string', Rule::in(['Male', 'Female', 'Other', 'Prefer not to say'])],
            'tfn' => ['required', 'string', 'regex:/^\d{9}$/'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'abn' => ['nullable', 'string', 'regex:/^\d{11}$/'],
            'bsb' => ['required', 'string', 'regex:/^\d{6}$/'],
            'account_number' => ['required', 'string', 'max:20'],
            'street_address' => ['required', 'string', 'max:255'],
            'suburb' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', Rule::in(['ACT', 'NSW', 'NT', 'QLD', 'SA', 'TAS', 'VIC', 'WA'])],
            'post_code' => ['required', 'string', 'regex:/^\d{4}$/'],
            'has_spouse' => ['required', Rule::in(['Yes', 'No'])],
            'number_of_children' => ['required', 'integer', 'min:0', 'max:20'],
            'id_document' => ['required', 'file', 'max:10240', 'mimes:pdf,jpg,jpeg,png,webp'],
            'terms_accepted' => ['accepted'],
            'website' => ['prohibited'],
        ];
    }

    public function messages(): array
    {
        return [
            'website.prohibited' => 'Spam detected.',
            'tfn.regex' => 'TFN must be exactly 9 digits.',
            'abn.regex' => 'ABN must be exactly 11 digits.',
            'bsb.regex' => 'BSB must be exactly 6 digits.',
            'post_code.regex' => 'Post code must be 4 digits.',
            'terms_accepted.accepted' => 'You must accept the terms and conditions.',
            'id_document.required' => 'Please upload your ID document.',
        ];
    }
}
