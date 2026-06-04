<?php

namespace App\Listeners;

use App\Events\ContactFormSubmitted;
use App\Mail\ContactFormNotification;
use Illuminate\Support\Facades\Mail;

class SendContactNotification
{
    public function handle(ContactFormSubmitted $event): void
    {
        $email = config('mail.contact_to', config('mail.from.address'));

        Mail::to($email)->send(new ContactFormNotification($event->submission));
    }
}
