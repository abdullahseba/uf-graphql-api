<?php
return [

    'csrf' => [
        // 'enabled' => false,
        'blacklist' => [
            '^/graphql' => [
                'POST'
            ]
        ]
    ]
];
