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


class LoginResolver extends Resolver
{

    public static function resolve($source, $args, $context, $info)
    {

        try {
            $con = new ApiController($context['ci']);
            return  $con->login($args['userName'], $args['password']);
        } catch (\Throwable $th) {
            error_log($th);
        }
    }
}
