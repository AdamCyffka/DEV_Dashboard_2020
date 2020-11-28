<?php

  require_once '../libraries/hybridauth/src/autoload.php';

  $config = [
    'callback' => 'http://localhost:8080/scripts/callbackFacebook.php',
    'keys' => [
      'id' => '670367266996537',
      'secret' => 'b163eef587a59136bc0f1070326db86b'
    ],
    'authorize_url_parameters' => [
      'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
      'access_type' => 'offline'
    ]
  ];
  
  $adapter = new Hybridauth\Provider\Facebook($config);

?>