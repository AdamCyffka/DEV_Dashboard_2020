<?php

  require_once '../libraries/hybridauth/src/autoload.php';

  $config = [
    'callback' => 'http://localhost:8080/scripts/callbackDiscord.php',
    'keys' => [
      'id' => '782574018443477023',
      'secret' => '3iG8X97nINTeMllLwa1DHJKBHSKcdyY_'
    ],
    'authorize_url_parameters' => [
      'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
      'access_type' => 'offline'
    ]
  ];
  
  $adapter = new Hybridauth\Provider\Discord($config);

?>