<?php

namespace UserFrosting\Sprinkle\GraphQlApi\ServicesProvider;

class ServicesProvider
{
  /**
   * Register api services.
   *
   * @param Container $container A DI container implementing ArrayAccess and container-interop.
   */
  public function register($container)
  {

    $container->extend('graphQLTypeRegistry', function ($types, $c) {

      $new_types = (object) array(
        'user' => 'UserFrosting\Sprinkle\GraphQlApi\GraphQl\Type\User',
        'role' => 'UserFrosting\Sprinkle\GraphQlApi\GraphQl\Type\Role',
        'login' => 'UserFrosting\Sprinkle\GraphQlApi\GraphQl\Type\Login'
      );
      return (object) array_merge((array) $types, (array) $new_types);
    });
  }
}
