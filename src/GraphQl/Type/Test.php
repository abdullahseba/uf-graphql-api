<?php
/**
 * API Sprinkle
 *
 * @link
 * @license
 */

namespace UserFrosting\Sprinkle\GraphQlApi\GraphQl\Type;

use GraphQL\Type\Definition\ObjectType;
use UserFrosting\Sprinkle\GraphQl\GraphQl\TypeRegistry as TR;

/**
 * GraphQL User type definition.
 *
 */
class Test extends ObjectType
{
    protected $test;
    public function __construct()
    {
        $test = [
        'name' => 'Calc',
        'fields' => [
            'sum' => [
                'type' => Type::int(),
                'args' => [
                    'x' => ['type' => Type::int()],
                    'y' => ['type' => Type::int()],
                ],
                'resolve' => function ($calc, $args) {
                    return $args['x'] + $args['y'];
                },
            ],
        ]
    ];
        parent::__construct($test);
    }
}
