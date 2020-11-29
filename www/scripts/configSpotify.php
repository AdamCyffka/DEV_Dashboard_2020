<?php

  require_once '../libraries/hybridauth/src/autoload.php';

  $config = [
    'callback' => 'http://localhost:8080/scripts/callbackSpotify.php',
    'keys' => [
      'id' => '75b07b22f18c45eebb2c0bfccfd3d8d7',
      'secret' => 'd9b974feb77a417ba517957952f36c14'
    ],
    'authorize_url_parameters' => [
      'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
      'access_type' => 'offline'
    ]
  ];
  
  $adapter = new Hybridauth\Provider\Spotify($config);

?>