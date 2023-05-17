<?php

namespace App\Domains\Authentication\Actions;

use App\Domains\Authentication\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    public function execute(array $data): User
    {
        // Validate input data

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->assignRole($data['user_type']);
        $user->save();

        return $user;
    }
}
