<?php

namespace App\Services;

use App\Models\ContactSubmission;
use Illuminate\Support\Facades\DB;

class ContactSubmissionService
{
    public function __construct(protected ContactNotificationService $notifications) {}

    public function approve(ContactSubmission $submission): ContactSubmission
    {
        if ($submission->status === 'approved') {
            return $submission;
        }

        return DB::transaction(function () use ($submission) {
            $submission->update([
                'status' => 'approved',
                'approved_at' => now(),
                'read_at' => $submission->read_at ?? now(),
            ]);

            $fresh = $submission->fresh();

            if ($fresh->form_type === 'contact') {
                $this->notifications->notifyClientApproved($fresh);
            }

            return $fresh;
        });
    }
}
