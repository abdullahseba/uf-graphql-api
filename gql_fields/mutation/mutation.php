<?php

use UserFrosting\Sprinkle\GraphQl\GraphQl\TypeRegistry as TR;

return [
    'login' => [
        'type' => TR::boolean(),
        'args' => [
            'password' => ['type' => TR::string()],
            'userName' => ['type' => TR::string()],
        ],
        'resolve' => "UserFrosting\Sprinkle\GraphQlApi\GraphQl\Resolver\LoginResolver::resolve"
    ],
    'logout' => [
        'type' => TR::boolean(),
        'args' => [],
        'resolve' => "UserFrosting\Sprinkle\GraphQlApi\GraphQl\Resolver\LogoutResolver::resolve"

    ]
];
