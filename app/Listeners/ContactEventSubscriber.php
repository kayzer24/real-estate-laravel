<?php

namespace App\Listeners;

use App\Events\ContactRequestEvent;
use App\Mail\PropertyContactMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Mail\Mailer;

class ContactEventSubscriber implements ShouldQueue
{
    public function __construct(private readonly Mailer $mailer)
    {
    }

    public function sendContactEmail(ContactRequestEvent $event): void
    {
        $this->mailer->send(new PropertyContactMail($event->property, $event->data));
    }
    public function subscribe(Dispatcher $events): array
    {
        return [
            ContactRequestEvent::class => 'sendContactEmail'
        ];
    }
}
