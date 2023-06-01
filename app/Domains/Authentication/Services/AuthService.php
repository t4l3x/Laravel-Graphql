<?php

namespace App\Domains\Authentication\Services;

use App\Domains\Authentication\Actions\ActivateUser;
use App\Domains\Authentication\Actions\CreateUser;
use App\Domains\Authentication\Actions\LoginUser;
use App\Domains\Authentication\Events\UserRegistered;
use App\Domains\Authentication\Exceptions\Authentication;
use App\Domains\Authentication\Exceptions\InvalidActivationToken;
use App\Domains\Authentication\Exceptions\UserAlreadyActivated;
use App\Domains\Authentication\Exceptions\UserNotActivated;
use App\Domains\Authentication\Models\User;
use App\Domains\Authentication\Models\UserActivation;
use Exception;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(
        public CreateUser $createUser,
        public ActivateUser $activateUser,
        public LoginUser $loginUser
    ) {
    }

    /**
     * @throws Exception
     */
    public function register(array $data): User
    {
        // This action creates the user and sends the activation email.
        $user = $this->createUser->execute($data);

        event(new UserRegistered($user));

        return $user;
    }

    /**
     * @throws UserNotActivated
     * @throws Authentication
     * @throws Exception
     */
    public function login(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            event(new Failed(Auth::guard(), $user, $credentials));
            throw new Authentication('Invalid email or password.');
        }

        if (! $user->hasVerifiedEmail()) {
            throw new UserNotActivated('User not activated.', 'email');
        }

        event(new Login(Auth::guard(), $user, $credentials['remember']));

        return $this->loginUser->execute($user);
    }

    /**
     * @throws UserAlreadyActivated
     * @throws InvalidActivationToken
     * @throws UserNotFoundException
     */
    public function activateUser($token): User
    {
        // Find the token
        $token = UserActivation::where('token', $token)->first();

        if (! $token) {
            throw new InvalidActivationToken('Invalid activation token.');
        }

        // Try to activate the user
        return $this->activateUser->execute($token->user);
    }

    public function logout(): void
    {
        Auth::guard()->logout();
    }

    public function forgotPassword(): void
    {

    }

    public function resetPassword(): void
    {

    }

    public function changePassword(): void
    {

    }

    public function changeEmail(): void
    {

    }
}
