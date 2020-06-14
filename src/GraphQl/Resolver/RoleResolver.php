<?php

/**
 * API Sprinkle
 *
 * @link
 * @license
 */

namespace UserFrosting\Sprinkle\GraphQlApi\GraphQl\Resolver;

use UserFrosting\Sprinkle\GraphQlApi\Authenticate\Exception\AuthExpiredException;
use UserFrosting\Sprinkle\Account\Database\Models\Role as RoleModel;
use UserFrosting\Sprinkle\GraphQl\GraphQl\Resolver\Resolver;


class RoleResolver extends Resolver
{
    public static function resolve($value, $args, $context, $info)
    {
        if (!$context['auth']->check()) {
            throw new AuthExpiredException();
        }

        //Only used for 'users' relation.
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

        //Temporary hack to remove 'users' from main select fields and only query relation if required :(
        $role = false;
        $r_idx = array_search('users', $select);
        if ($r_idx) {
            unset($select[$r_idx]);
            $role = true;
        }

        $role = RoleModel::select($select)->where('id', $args['id'])
            ->when($role, function ($query) {
                return $query->with(['users', 'users.roles']);
            })
            ->get()->transform(function ($items, $item) {
                $items = $items->toArray();
                $map = array_flip(self::$map);
                return self::renameKeys($items, $map);
            })->first();

        return $role;
    }
}
