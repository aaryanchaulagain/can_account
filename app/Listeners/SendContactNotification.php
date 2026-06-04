<?php

namespace App\Listeners;

use App\Events\ContactFormSubmitted;
use App\Services\ContactNotificationService;

class SendContactNotification
{
    public function __construct(protected ContactNotificationService $notifications) {}

    public function handle(ContactFormSubmitted $event): void
    {
        $this->notifications->notifyAdmin($event->submission);
    }
}
