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


class UsersResolver extends Resolver
{


    public static function resolve($value, $args, $context, $info)
    {
        if (!$context['auth']->check()) {
            throw new AuthExpiredException();
        }

        self::$map = [
            'userName' => 'user_name',
            'firstName' => 'first_name',
            'lastName'  => 'last_name',
            'createdAt' => 'created_at',
            'deletedAt' => 'deleted_at',
            'isEnabled' => 'flag_enabled',
            'isVerified' => 'flag_verified',
            'groupId' => 'group_id',
            'lastUpdated' => 'updated_at'
        ];

        //Stores the selected fields form the query.
        $selectedFields = $info->getFieldSelection();

        //Stores SELECT fields for DB query.  ID required at minimum.
        $select = array('id');
        foreach (self::renameKeys($selectedFields, self::$map) as $key => $value) {
            array_push($select, $key);
        }

        //Temporary hack to remove 'roles' from main select fields and only query relation if required :(
        $role = false;
        $r_idx = array_search('roles', $select);
        if ($r_idx) {
            unset($select[$r_idx]);
            $role = true;
        }

        $users = UserModel::select($select)->whereBetween('id', [$args['from'], $args['to']])
            ->when($role, function ($query) {
                return $query->with(['roles', 'roles.users']);
            })
            ->get()->transform(function ($items, $item) {
                $items = $items->toArray();
                $map = array_flip(self::$map);
                return self::renameKeys($items, $map);
            });

        // error_log(print_r($user, true));

        return $users;
    }
}
