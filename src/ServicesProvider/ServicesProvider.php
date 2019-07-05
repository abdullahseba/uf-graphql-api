<?php

namespace UserFrosting\Sprinkle\GraphQlApi\ServicesProvider;

use UserFrosting\Sprinkle\GraphQl\GraphQl\TypeRegistry;
use UserFrosting\Sprinkle\GraphQl\GraphQl\TypeRegistry as TR;

class ServicesProvider
{
  /**
   * Register api services.
   *
   * @param Container $container A DI container implementing ArrayAccess and container-interop.
   */
  public function register($container)
  {
    $container->extend('graphQLQueryFields', function ($fields, $c) {
      $new_fields = [
        'tests' => [
          'type' => TR::get('user'),
          'description' => 'Returns user by id (in range of 1-5)',
          'args' => [
            'id' => TR::nonNull(TR::id())
          ],
          'resolve' =>
            "UserFrosting\Sprinkle\GraphQl\GraphQl\Resolver\UserResolver::resolve"
        ]
      ];
      return array_merge($fields, $new_fields);
    });
  }
}
