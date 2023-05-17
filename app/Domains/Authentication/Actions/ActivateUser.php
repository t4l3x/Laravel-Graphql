<?php

namespace App\Domains\Authentication\Actions;

use App\Domains\Authentication\Exceptions\InvalidActivationToken;
use App\Domains\Authentication\Exceptions\UserAlreadyActivated;
use App\Domains\Authentication\Models\User;

class ActivateUser
{
    /**
     * Execute the action.
     *
     * @param User $user
     *
     * @return User
     *
     * @throws UserAlreadyActivated
     * @throws InvalidActivationToken
     */
    public function execute(User $user): User
    {
        $activation = $user->activation()->first();

        if ($activation && $activation->activated_at) {
            throw new UserAlreadyActivated('User already activated.');
        }

        if (! $activation) {
            throw new InvalidActivationToken('Invalid activation token.');
        }

        $activation->activated_at = now();
        $activation->save();

        return $user;
    }
}
