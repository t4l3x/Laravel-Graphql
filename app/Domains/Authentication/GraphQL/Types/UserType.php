<?php

namespace App\Domains\Authentication\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class UserType extends ObjectType
{
    protected array $attributes = [
        'name' => 'User',
        'description' => 'A user',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The ID of the user',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the user',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of the user',
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created date of the user',
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The updated date of the user',
            ],
        ];
    }
}
