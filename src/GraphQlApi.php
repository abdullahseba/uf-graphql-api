<?php

namespace UserFrosting\Sprinkle\GraphQlApi;

use UserFrosting\System\Sprinkle\Sprinkle;
use Psr\Container\ContainerInterface;
use UserFrosting\Sprinkle\GraphQl\GraphQl\TypeRegistry;
use UserFrosting\Sprinkle\GraphQl\GraphQl\Type\Mutation;
use UserFrosting\Sprinkle\GraphQl\GraphQl\Type\Query;

/**
 * Bootstrapper class for the 'graph_ql' sprinkle.
 */
class GraphQlApi extends Sprinkle
{
    public function __construct(ContainerInterface $ci)
    {
        //Add the container interface to the object.
        $this->ci = $ci;
    }
}
