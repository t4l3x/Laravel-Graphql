<?php

namespace App\Domains\Authentication\Listeners;

use App\Domains\Authentication\Events\UserRegistered;
use App\Templates\WelcomeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
// Import your email mailable class, e.g., WelcomeEmail

class SendWelcomeEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UserRegistered $event): void
    {
        // Replace WelcomeEmail with your mailable class

        Mail::to($event->user->email)->send(new WelcomeEmail($event->user));
    }
}
