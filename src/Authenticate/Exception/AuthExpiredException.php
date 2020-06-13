<?php

namespace UserFrosting\Sprinkle\GraphQlApi\Authenticate\Exception;

use GraphQL\Error\ClientAware;

class AuthExpiredException extends \Exception implements ClientAware
{
    protected $message = 'Your session has expired. Please sign in again.';

    public function isClientSafe()
    {
        return true;
    }

    public function getCategory()
    {
        return 'Authentication';
    }
}
