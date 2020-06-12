<?php
return [

    'csrf' => [
        'blacklist' => [
            '^/graphql' => [
                'POST'
            ]
        ]
    ]
];
