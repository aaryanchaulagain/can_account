<?php

namespace App\Mail;

use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactSubmissionApproved extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactSubmission $submission) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your enquiry has been received — Canberra Accountants',
            from: new Address(
                config('mail.from.address', 'info@canberraaccountants.com.au'),
                config('mail.from.name', 'Canberra Accountants'),
            ),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-approved',
        );
    }
}
