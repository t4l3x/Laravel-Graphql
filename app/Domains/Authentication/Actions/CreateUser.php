<?php

namespace App\Domains\Authentication\Actions;

use App\Domains\Authentication\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CreateUser
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @throws Exception
     */
    public function execute(array $data): User
    {
        // Validate input data
        try {
            $this->user->name = $data['name'];
            $this->user->email = $data['email'];
            $this->user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            $this->user->assignRole($data['user_type']);
            $this->user->save();

            return $this->user;
        } catch (Exception $e) {
            Log::error("Error creating user: " . $e->getMessage());
            throw new Exception("Error creating user: " . $e->getMessage(), 0, $e);
        }
    }
}
