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
class Login extends ObjectType
{
    protected $login;
    public function __construct()
    {
        $login = [
            'name' => 'Calc',
            'fields' => [
                'userName' => TR::string(),
                'password' => TR::string(),
            ]
        ];
        parent::__construct($login);
    }
}
