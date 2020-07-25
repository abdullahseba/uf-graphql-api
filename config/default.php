<?php

return [

    'csrf' => [
        // 'enabled' => false,
        'blacklist' => [
            '^/graphql' => [
                'POST'
            ]
        ]
    ],
    'debug' => [
        'queries' => true,
    ],
];
