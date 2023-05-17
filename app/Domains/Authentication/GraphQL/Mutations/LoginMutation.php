<?php

namespace App\Domains\Authentication\GraphQL\Mutations;

use App\Domains\Authentication\Exceptions\Authentication;
use App\Domains\Authentication\Services\AuthService;
use App\Domains\Authentication\Traits\AuthService;
use Illuminate\Validation\ValidationException;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class LoginMutation
{

    use AuthService;

    /**
     * @throws ValidationException|\App\Domains\Authentication\Exceptions\UserNotActivated
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): array
    {
        $credentials = [
            'email' => $args['input']['email'],
            'password' => $args['input']['password'],
            'remember' => $args['input']['remember'] ?? false,
        ];

        $response = $this->authService->login($credentials);


            return [
                'user' => $response['user'],
                'token' => $response['token'],
            ];
    }
}
