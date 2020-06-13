<?php

/**
 * API Sprinkle
 *
 * @link
 * @license
 */

namespace UserFrosting\Sprinkle\GraphQlApi\GraphQl\Resolver;

use UserFrosting\Sprinkle\GraphQlApi\Authenticate\Exception\AuthExpiredException;
use UserFrosting\Sprinkle\Account\Database\Models\User as UserModel;
use UserFrosting\Sprinkle\GraphQl\GraphQl\Resolver\Resolver;

/**
 * GraphQL User type definition.
 *
 */
class UsersResolver extends Resolver
{
    public static function resolve($source, $args, $context, $info)
    {
        if (!$context['auth']->check()) {
            throw new AuthExpiredException();
        }

        function ToCamelCase($string, $capitalizeFirstCharacter = false)
        {
            $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
            if (!$capitalizeFirstCharacter) {
                $str[0] = strtolower($str[0]);
            }
            return $str;
        }


        $users = UserModel::whereBetween('id', [$args['from'], $args['to']])
            ->get()->transform(function ($items, $item) {
                $items = $items->toArray();
                $fields = array();
                foreach ($items as $item => $value) {
                    $name = ToCamelCase($item);
                    $fields[$name] = $value;
                }
                $fields['isEnabled'] = $items['flag_enabled'];
                $fields['isVerified'] = $items['flag_verified'];
                return $fields;
            });

        return $users;
    }
}
