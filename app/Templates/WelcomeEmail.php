<?php

namespace App\Templates;

use App\Domains\Authentication\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build(): WelcomeEmail
    {
        return $this->view('emails.welcome')
            ->with(['user' => $this->user]);
    }
}
