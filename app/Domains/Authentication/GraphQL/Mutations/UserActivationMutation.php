<?php

namespace App\Domains\Authentication\GraphQL\Mutations;

use App\Domains\Authentication\Exceptions\InvalidActivationToken;
use App\Domains\Authentication\Exceptions\UserAlreadyActivated;
use App\Domains\Authentication\Traits\AuthServiceTrait;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UserActivationMutation
{
    use AuthServiceTrait;

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
