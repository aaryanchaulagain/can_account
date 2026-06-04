<?php

namespace App\Services;

use App\Events\ContactFormSubmitted;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactService
{
    public function submit(array $data, Request $request): ContactSubmission
    {
        $submission = ContactSubmission::create([
            'form_type' => $data['form_type'] ?? 'contact',
            ...$data,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'new',
        ]);

        event(new ContactFormSubmitted($submission));

        return $submission;
    }
}
