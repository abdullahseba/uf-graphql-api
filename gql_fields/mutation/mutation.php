<?php

use UserFrosting\Sprinkle\GraphQl\GraphQl\TypeRegistry as TR;

return [
    'loging' => [
        'type' => TR::boolean(),
        'args' => [
            'password' => ['type' => TR::string()],
            'userName' => ['type' => TR::string()],
        ],
        // 'resolve' => "UserFrosting\Sprinkle\GraphQlApi\GraphQl\Resolver\LoginResolver::resolve"
        'resolve' => function () {
            return false;
        }
    ]
];
