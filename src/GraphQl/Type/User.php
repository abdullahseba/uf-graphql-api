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
                'created' => TR::string(),
                'lastUpdated' => TR::string(),
                'deleted' => TR::string(),
                'con' => TR::string()
            ]
        ];
        parent::__construct($user);
    }
}
