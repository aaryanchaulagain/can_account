<?php

namespace App\Services;

use App\Mail\ContactFormNotification;
use App\Mail\ContactSubmissionApproved;
use App\Models\ContactSubmission;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactNotificationService
{
    public function notifyAdmin(ContactSubmission $submission): void
    {
        if ($submission->form_type !== 'contact') {
            return;
        }

        $adminEmail = $this->adminNotificationEmail();

        if (! $adminEmail) {
            Log::warning('Contact form admin notification skipped: no MAIL_CONTACT_TO or site email configured.');

            return;
        }

        try {
            Mail::to($adminEmail)->send(new ContactFormNotification($submission));
        } catch (\Throwable $e) {
            Log::error('Failed to send contact form admin notification.', [
                'submission_id' => $submission->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function notifyClientApproved(ContactSubmission $submission): void
    {
        if (! $submission->email) {
            return;
        }

        try {
            Mail::to($submission->email)->send(new ContactSubmissionApproved($submission));
        } catch (\Throwable $e) {
            Log::error('Failed to send contact approval email to client.', [
                'submission_id' => $submission->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    public function adminNotificationEmail(): ?string
    {
        $configured = config('mail.contact_to');
        $siteEmail = SiteSetting::get('email');

        $email = $configured ?: $siteEmail;

        return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : null;
    }
}
