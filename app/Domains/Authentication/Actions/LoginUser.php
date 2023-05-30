<?php

namespace App\Domains\Authentication\Actions;

use App\Domains\Authentication\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class LoginUser
{
    /**
     * Execute the user login
     *
     * @param User $user
     * @param string $tokenName
     * @return array
     * @throws Exception
     */
    public function execute(User $user, string $tokenName = 'authToken'): array
    {
        // Create a new token for the user.
        // This might fail for various reasons, e.g. database problems.
        try {
            $token = $user->createToken($tokenName);
        } catch (\Exception $e) {
            // Log the error message for debugging purposes
            Log::error("Error creating token: " . $e->getMessage());

            // You can throw a custom exception or rethrow the original exception here.
            throw new \Exception("Error creating token for user");
        }

        // If everything went well, return the user and the token.
        return [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
    }
}
