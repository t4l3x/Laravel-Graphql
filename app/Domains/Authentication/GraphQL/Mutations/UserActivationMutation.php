<?php

namespace App\Domains\Authentication\GraphQL\Mutations;

use App\Domains\Authentication\Exceptions\InvalidActivationToken;
use App\Domains\Authentication\Exceptions\UserAlreadyActivated;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UserActivationMutation extends AuthMutation
{

    /**
     * @throws InvalidActivationToken
     * @throws UserAlreadyActivated
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): array
    {
        $token = $args['input']['token'];
        $user = $this->authService->activateUser($token);

        return [
            'user' => $user,
            'message' => 'User account has been activated successfully.',
        ];
    }
}
