<?php

namespace UserFrosting\Sprinkle\GraphQlApi\Controller;

use UserFrosting\Sprinkle\Core\Controller\SimpleController;
use UserFrosting\Fortress\RequestDataTransformer;
use UserFrosting\Fortress\RequestSchema;
use UserFrosting\Fortress\ServerSideValidator;


class ApiController extends SimpleController
{
  public function test()
  {
    return 'test';
  }


  public function login($userName, $password)
  {
    /** @var \UserFrosting\Sprinkle\Core\Alert\AlertStream $ms */
    // $ms = $this->ci->alerts;

    /** @var \UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface $currentUser */
    // $currentUser = $this->ci->currentUser;

    /** @var \UserFrosting\Sprinkle\Account\Authenticate\Authenticator $authenticator */
    $authenticator = $this->ci->authenticator;

    // Return 200 success if user is already logged in
    if ($authenticator->check()) {
      // $ms->addMessageTranslated('warning', 'LOGIN.ALREADY_COMPLETE');

      // return $response->withJson([], 200);
      return true;
    }

    /** @var \UserFrosting\Support\Repository\Repository $config */
    $config = $this->ci->config;

    // Get POST parameters
    $params = [
      'user_name' => $userName,
      'password' => $password
    ];

    // Load the request schema
    $schema = new RequestSchema('schema://requests/login.yaml');

    // Whitelist and set parameter defaults
    $transformer = new RequestDataTransformer($schema);
    $data = $transformer->transform($params);

    // Validate, and halt on validation errors.  Failed validation attempts do not count towards throttling limit.
    $validator = new ServerSideValidator($schema, $this->ci->translator);
    if (!$validator->validate($data)) {
      // $ms->addValidationErrors($validator);

      // return $response->withJson([], 400);
      return false;
    }

    // Determine whether we are trying to log in with an email address or a username
    $isEmail = filter_var($data['user_name'], FILTER_VALIDATE_EMAIL);

    // Throttle requests

    /** @var \UserFrosting\Sprinkle\Core\Throttle\Throttler $throttler */
    $throttler = $this->ci->throttler;

    $userIdentifier = $data['user_name'];

    $throttleData = [
      'user_identifier' => $userIdentifier,
    ];

    $delay = $throttler->getDelay('sign_in_attempt', $throttleData);
    if ($delay > 0) {
      // $ms->addMessageTranslated('danger', 'RATE_LIMIT_EXCEEDED', [
      //     'delay' => $delay,
      // ]);

      // return $response->withJson([], 429);
      return false;
    }

    // If credential is an email address, but email login is not enabled, raise an error.
    // Note that this error counts towards the throttling limit.
    if ($isEmail && !$config['site.login.enable_email']) {
      // $ms->addMessageTranslated('danger', 'USER_OR_PASS_INVALID');
      $throttler->logEvent('sign_in_attempt', $throttleData);

      // return $response->withJson([], 403);
      return false;
    }

    // Try to authenticate the user.  Authenticator will throw an exception on failure.
    /** @var \UserFrosting\Sprinkle\Account\Authenticate\Authenticator $authenticator */
    $authenticator = $this->ci->authenticator;

    try {
      $currentUser = $authenticator->attempt(($isEmail ? 'email' : 'user_name'), $userIdentifier, $data['password'], $data['rememberme']);
    } catch (\Exception $e) {
      // only let unsuccessful logins count toward the throttling limit
      $throttler->logEvent('sign_in_attempt', $throttleData);

      throw $e;
    }

    // $ms->addMessageTranslated('success', 'WELCOME', $currentUser->export());

    // Set redirect, if relevant
    // $redirectOnLogin = $this->ci->get('redirect.onLogin');

    // return $redirectOnLogin($request, $response, $args);
    return true;
  }
}
