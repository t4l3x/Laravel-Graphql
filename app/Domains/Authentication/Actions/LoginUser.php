<?php

namespace App\Domains\Authentication\Actions;

use App\Domains\Authentication\Models\User;

class LoginUser
{
    public function execute(User $user): array
    {
        return [
            'user' => $user,
            'token' => $user->createToken('authToken')->plainTextToken,
        ];
    }
}
