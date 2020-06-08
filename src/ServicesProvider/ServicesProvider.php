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

    $container->extend('graphQLTypeRegistry', function ($types, $c) {

      $new_types = (object) array(
        'user' => 'UserFrosting\Sprinkle\GraphQlApi\GraphQl\Type\User',
        // 'test' => 'UserFrosting\Sprinkle\GraphQlApi\GraphQl\Type\Test'
      );
      return (object) array_merge((array) $types, (array) $new_types);
    });


    $container->extend('graphQLQueryFields', function ($fields, $c) {

      $new_fields = [

        'user' => [
          // 'type' => TR::$types::user(),
          'type' => TR::get('user'),
          'description' => 'Returns user by id (in range of 1-5)',
          'args' => [
            'id' => TR::nonNull(TR::id())
          ],
          'resolve' =>
          "UserFrosting\Sprinkle\GraphQlApi\GraphQl\Resolver\UserResolver::resolve"
        ]
      ];
      return array_merge($fields, $new_fields);
    });


    $container->extend('graphQLMutationFields', function ($fields, $c) {
      $new_fields = [

        'sum' => [
          'type' => TR::int(),
          'args' => [
            'x' => ['type' => TR::int()],
            'y' => ['type' => TR::int()],
          ],
          'resolve' => function ($calc, $args) {
            return $args['x'] + $args['y'];
          },
        ]
      ];
      return array_merge($fields, $new_fields);
    });
  }
}
