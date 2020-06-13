<?php

//prettier-ignore
$app->post('/graphql', 'UserFrosting\Sprinkle\GraphQlApi\Controller\ApiController:Api')
    ->setName('graphql');
