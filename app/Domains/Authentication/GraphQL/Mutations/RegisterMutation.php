<?php

namespace App\Domains\Authentication\GraphQL\Mutations;

use App\Domains\Authentication\Traits\AuthServiceTrait;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class RegisterMutation
{

    use AuthServiceTrait;

    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo): array
    {
        $user = $this->authService->register($args['input']);
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
