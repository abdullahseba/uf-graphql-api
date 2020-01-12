<?php
/**
 * API Sprinkle
 *
 * @link
 * @license
 */

namespace UserFrosting\Sprinkle\GraphQlApi\GraphQl\Resolver;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use UserFrosting\Sprinkle\GraphQl\Authenticate\Exception\AuthExpiredException;
use UserFrosting\Sprinkle\Account\Database\Models\User as UserModel;
use UserFrosting\Sprinkle\GraphQl\Controller\GraphQlController;

use UserFrosting\Sprinkle\GraphQl\GraphQl\Resolver\Resolver;

/**
 * GraphQL User type definition.
 *
 */
class UserResolver extends Resolver
{
    public static function resolve($source, $args, $context, $info)
    {
        // $t = new GraphQlController();
        if (!$context['auth']->check()) {
            throw new AuthExpiredException();
        }

        // $user = UserModel::select('id', 'first_name')->where('id', $args['id'])->get()[0];
        $user = UserModel::where('id', $args['id'])
            ->get()
            ->first();

        $fields = [
            'id' => $user->id,
            'userName' => $user->user_name,
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'email' => $user->email,
            'locale' => $user->locale,
            'groupId' => $user->group_id,
            'isVerified' => $user->flag_verified,
            'isEnabled' => $user->flag_enabled,
            'created' => $user->created_at,
            'lastUpdated' => $user->updated_at,
            'deleted' => $user->deleted_at,
            'con' => $context['current_user']
        ];
        return $fields;
    }
}
