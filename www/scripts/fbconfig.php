<?php

  require_once('dbconfig.php');
  require_once('../libraries/facebook-sdk/src/Facebook/autoload.php');

  $FBObject = new \Facebook\Facebook([
    'app_id' => '670367266996537',
    'app_secret' => 'b163eef587a59136bc0f1070326db86b',
    'default_graph_version' => 'v3.2',
  ]);
  
  $handler = $FBObject -> getRedirectLoginHelper();

?>