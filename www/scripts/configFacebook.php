<?php

  require_once '../libraries/hybridauth/src/autoload.php';

  $config = [
    'callback' => 'http://localhost:8080/scripts/callbackTwitch.php',
    'keys' => [
      'id' => 'fdmwsirygpv7rdta8ssr07rqno73ej',
      'secret' => '1seeqt50mkzk007p7lns80639uzli6'
    ],
    'authorize_url_parameters' => [
      'approval_prompt' => 'force',
      'access_type' => 'offline'
    ]
  ];
  
  $adapter = new Hybridauth\Provider\TwitchTV($config);

?>