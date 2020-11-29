<?php

  require_once('configGoogle.php');
  require_once('oauthUser.php');
  include('dbConfig.php');

  try {
    $adapter->authenticate();
    $userProfile = $adapter->getUserProfile();
    $userInfo = array();
    $userInfo['email'] = $userProfile->email;
    $userInfo['name'] = $userProfile->firstName;
    $userInfo['id'] = $userProfile->identifier;

    $oauth_user_obj = new OauthUser($db);
    $userData = $oauth_user_obj->verifyUser($userInfo);
  } catch (Exception $e) {
    echo $e->getMessage() ;
  }

?>