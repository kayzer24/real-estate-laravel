<?php

namespace App\Listeners;

use App\Events\ContactRequestEvent;
use App\Mail\PropertyContactMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;

class ContactListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
//    public function __construct(private readonly Mailer $mailer)
//    {
//        //
//    }

    /**
     * Handle the event.
     */
//    public function handle(ContactRequestEvent $event): void
//    {
        // Currently, we are using the ContactEventSubscriber to send contact email
        // enable this logic to send the email using the event listener
        // sleep(2);
        // $this->mailer->send(new PropertyContactMail($event->property, $event->data));
//    }
}
