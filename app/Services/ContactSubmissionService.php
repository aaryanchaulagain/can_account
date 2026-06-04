<?php

namespace App\Services;

use App\Mail\ContactSubmissionApproved;
use App\Models\ContactSubmission;
use Illuminate\Support\Facades\Mail;

class ContactSubmissionService
{
    public function approve(ContactSubmission $submission): ContactSubmission
    {
        if ($submission->status === 'approved') {
            return $submission;
        }

        $submission->update([
            'status' => 'approved',
            'approved_at' => now(),
            'read_at' => $submission->read_at ?? now(),
        ]);

        Mail::to($submission->email)->send(new ContactSubmissionApproved($submission->fresh()));

        return $submission->fresh();
    }
}
