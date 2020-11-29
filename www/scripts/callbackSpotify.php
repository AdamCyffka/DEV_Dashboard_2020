<?php

  require_once('configSpotify.php');
  require_once('oauthUser.php');
  include('dbConfig.php');

  try {
    $adapter->authenticate();
    $userProfile = $adapter->getUserProfile();
    $userInfo = array();
    $userInfo['email'] = $userProfile->email;
    $userInfo['name'] = $userProfile->displayName;
    $userInfo['id'] = $userProfile->identifier;

    // Create an instance of the OauthUser class
    $oauth_user_obj = new OauthUser($db);
    $userData = $oauth_user_obj->verifyUser($userInfo);
  } catch (Exception $e) {
    echo $e->getMessage() ;
  }

?>