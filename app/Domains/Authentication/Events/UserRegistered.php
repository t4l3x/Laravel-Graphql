<?php

namespace App\Domains\Authentication\Events;

use App\Domains\Authentication\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegistered extends UserEvent
{

}
