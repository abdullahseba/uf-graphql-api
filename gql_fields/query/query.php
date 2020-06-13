<?php

use UserFrosting\Sprinkle\GraphQl\GraphQl\TypeRegistry as TR;


return [
    'user' => [
        'type' => TR::user(),
        'description' => 'Returns a user by id',
        'args' => [
            'id' => TR::nonNull(TR::id())
        ],
        'resolve' => "UserFrosting\Sprinkle\GraphQlApi\GraphQl\Resolver\UserResolver::resolve"
    ],
    'users' => [
        'type' => TR::ListOf(TR::user()),
        'description' => 'Returns a range of users',
        'args' => [
            'from' => [
                'type' => TR::nonNull(TR::id()),
                'description' => 'Start of id range',
            ],
            'to' =>  [
                'type' => TR::nonNull(TR::id()),
                'description' => 'End of id range',
            ],

        ],
        'resolve' => "UserFrosting\Sprinkle\GraphQlApi\GraphQl\Resolver\UsersResolver::resolve"
    ],
];
