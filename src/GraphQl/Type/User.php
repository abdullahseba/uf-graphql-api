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
            'fields' => function () {
                return [
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
                    'roles' => TR::listOf(TR::role())
                ];
            },

        ];
        parent::__construct($user);
    }
}
