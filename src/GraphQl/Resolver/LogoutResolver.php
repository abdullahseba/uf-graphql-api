<?php

/**
 * API Sprinkle
 *
 * @link
 * @license
 */

namespace UserFrosting\Sprinkle\GraphQlApi\GraphQl\Resolver;

use UserFrosting\Sprinkle\GraphQlApi\Controller\ApiController;
use UserFrosting\Sprinkle\GraphQl\GraphQl\Resolver\Resolver;

/**
 * GraphQL User type definition.
 *
 */
class LogoutResolver extends Resolver
{

    public static function resolve($source, $args, $context, $info)
    {

        try {
            $con = new ApiController($context['ci']);
            return  $con->logout();
        } catch (\Throwable $th) {
            error_log($th);
        }
    }
}
