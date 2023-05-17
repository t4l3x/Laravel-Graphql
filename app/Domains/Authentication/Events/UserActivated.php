<?php

namespace App\Domains\Authentication\Events;

use App\Domains\Authentication\Models\User;

class UserActivated
{
    /**
     * @param User $user
     */
    public function __construct(\App\Domains\Authentication\Models\User $user)
    {
    }
}
