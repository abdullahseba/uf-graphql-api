<?php

//prettier-ignore
$app->post('/graphql', 'UserFrosting\Sprinkle\GraphQl\Controller\GraphQlController:Api')
    ->setName('graphql');
