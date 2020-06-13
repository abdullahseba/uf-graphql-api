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
use GraphQL\Type\Definition\ResolveInfo;


/**
 * GraphQL User type definition.
 *
 */
class User extends ObjectType
{
    protected $user;
    public function __construct()
    {
        $user = [
            'name' => 'User',
            'description' => 'User',
            'fields' => [
                'id' => TR::id(),
                'userName' => TR::string(),
                'firstName' => TR::string(),
                'lastName' => TR::string(),
                'email' => TR::string(),
                'locale' => TR::string(),
                'groupId' => TR::int(),
                'isVerified' => TR::boolean(),
                'isEnabled' => TR::boolean(),
                'createdAt' => TR::string(),
                'lastUpdated' => TR::string(),
                'deletedAt' => TR::string(),
            ],
            'resolveField' => function ($user, $args, $context, ResolveInfo $info) {
                // error_log('resolveField');
                // error_log(print_r($user, true));
                switch ($info->fieldName) {
                    case 'emailf':
                        return 'email';
                    default:
                        return $user[$info->fieldName];
                }
            }
        ];
        parent::__construct($user);
    }
}
