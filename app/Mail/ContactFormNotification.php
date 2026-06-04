<?php

namespace App\Mail;

use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactSubmission $submission) {}

    public function envelope(): Envelope
    {
        $service = $this->submission->service_interested
            ? ' — '.$this->submission->service_interested
            : '';

        return new Envelope(
            subject: '[New Enquiry '.$this->reference().'] '.$this->submission->name.$service,
            replyTo: [
                new Address($this->submission->email, $this->submission->name),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-notification',
        );
    }

    protected function reference(): string
    {
        return '#'.str_pad((string) $this->submission->id, 5, '0', STR_PAD_LEFT);
    }
}
