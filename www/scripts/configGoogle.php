<?php

  require_once '../libraries/hybridauth/src/autoload.php';

  $config = [
    'callback' => 'http://localhost:8080/scripts/callbackGoogle.php',
    'keys' => [
      'id' => '486815267879-qe57764gth7vjjbfjddsm8fg9liq9ob9.apps.googleusercontent.com',
      'secret' => '1dF34_7wideJfy43RQwxiwWd'
    ],
    'scope' => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email',
    'authorize_url_parameters' => [
      'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
      'access_type' => 'offline'
    ]
  ];
  
  $adapter = new Hybridauth\Provider\Google($config);

?>