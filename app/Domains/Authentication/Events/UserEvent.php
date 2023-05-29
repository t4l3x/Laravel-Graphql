<?php

namespace App\Domains\Authentication\Events;

use App\Domains\Authentication\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class UserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}

