<?php

namespace App\Domains\Authentication\GraphQL\Mutations;

use App\Domains\Authentication\Traits\AuthService;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UserActivationMutation
{
    use AuthService;

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
