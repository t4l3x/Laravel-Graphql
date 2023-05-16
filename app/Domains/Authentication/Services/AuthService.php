<?php
namespace App\Domains\Authentication\Services;

use App\Domains\Authentication\Exceptions\AuthenticationException;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use App\Domains\Authentication\Models\User;
use App\Domains\Authentication\Actions\CreateUser;
use App\Domains\Authentication\Actions\ActivateUser;
use App\Domains\Authentication\Exceptions\UserNotActivatedException;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data): User
    {
        // This action creates the user and sends the activation email.
        return app(CreateUser::class)->execute($data);
    }

    /**
     * @throws UserNotActivatedException
     */
    public function login(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            event(new Failed(Auth::guard(), $user, $credentials));
            throw new AuthenticationException('Invalid email or password.');
        }

        if (!$user->hasVerifiedEmail()) {
            throw new UserNotActivatedException('User not activated.');
        }

        event(new Login(Auth::guard(), $user, $credentials['remember']));

        return [
            'user' => $user,
            'token' => $user->createToken('authToken')->plainTextToken,
        ];
    }

    public function activateUser(User $user): User
    {
        // This action activates the user and sends the welcome email.
        return app(ActivateUser::class)->execute($user);
    }
}
