<?php

namespace Tests\Feature;

use App\Mail\ContactFormNotification;
use App\Mail\ContactSubmissionApproved;
use App\Enums\UserRole;
use App\Models\ContactSubmission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_submission_emails_admin(): void
    {
        Mail::fake();
        config(['mail.contact_to' => 'admin@example.com']);

        $this->post(route('contact.store'), [
            'name' => 'Jane Client',
            'email' => 'jane@example.com',
            'phone' => '0400000000',
            'message' => 'I would like to book a consultation.',
            'form_type' => 'contact',
        ])->assertRedirect();

        $submission = ContactSubmission::first();
        $this->assertNotNull($submission);
        $this->assertSame('contact', $submission->form_type);

        Mail::assertSent(ContactFormNotification::class, function (ContactFormNotification $mail) use ($submission) {
            return $mail->hasTo('admin@example.com')
                && $mail->submission->is($submission);
        });
    }

    public function test_admin_approve_sends_client_confirmation(): void
    {
        Mail::fake();

        $adminRole = Role::create(['name' => 'Admin', 'slug' => UserRole::Admin->value]);
        $admin = User::factory()->create(['role_id' => $adminRole->id, 'is_active' => true]);
        $submission = ContactSubmission::create([
            'form_type' => 'contact',
            'name' => 'Jane Client',
            'email' => 'jane@example.com',
            'message' => 'Consultation please',
            'status' => 'new',
        ]);

        $response = $this->actingAs($admin)
            ->post(route('admin.contacts.approve', $submission));

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $response->assertSessionMissing('error');

        $submission->refresh();
        $this->assertSame('approved', $submission->status);

        Mail::assertSent(ContactSubmissionApproved::class, function (ContactSubmissionApproved $mail) use ($submission) {
            return $mail->hasTo('jane@example.com')
                && $mail->submission->is($submission);
        });
    }
}
