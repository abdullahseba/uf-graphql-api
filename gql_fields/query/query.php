<?php

use UserFrosting\Sprinkle\GraphQl\GraphQl\TypeRegistry as TR;


return [
    'user' => [
        // 'type' => TR::get('user'),
        'type' => TR::user(),
        'description' => 'Returns user by id (in range of 1-5)',
        'args' => [
            'id' => TR::nonNull(TR::id())
        ],
        'resolve' =>
        "UserFrosting\Sprinkle\GraphQlApi\GraphQl\Resolver\UserResolver::resolve"
    ]
];
