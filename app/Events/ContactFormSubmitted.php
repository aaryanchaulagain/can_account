<?php

namespace App\Events;

use App\Models\ContactSubmission;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted
{
    use Dispatchable, SerializesModels;

    public function __construct(public ContactSubmission $submission) {}
}
