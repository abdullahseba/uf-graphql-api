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
class Role extends ObjectType
{
    protected $role;
    public function __construct()
    {
        $role = [
            'name' => 'Role',
            'description' => 'Role',
            'fields' => function () {
                return [
                    'id' => TR::id(),
                    'slug' => TR::string(),
                    'name' => TR::string(),
                    'description' => TR::string(),
                    'users' => TR::listOf(TR::user())
                ];
            },
            // 'resolveField' => function ($user, $args, $context, $info) {
            //     // error_log($info->fieldName);
            //     // error_log(print_r($user, true));
            //     switch ($info->fieldName) {
            //         case 'emailf':
            //             return 'email';
            //         default:
            //             return $user[$info->fieldName];
            //     }
            // }
        ];
        parent::__construct($role);
    }
}
