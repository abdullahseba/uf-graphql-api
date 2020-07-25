<?php

//prettier-ignore
$app->post('/graphql', 'UserFrosting\Sprinkle\GraphQlApi\Controller\ApiController:Api')
    ->setName('graphql');
$app->options('/graphql', 'UserFrosting\Sprinkle\GraphQlApi\Controller\ApiController:ApiPreflight')
    ->setName('graphqlpre');
