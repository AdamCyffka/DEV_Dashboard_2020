<?php

  require_once('../libraries/facebook-sdk/src/Facebook/autoload.php');
  require_once('oauthUser.php');
  include('dbConfig.php');

  if (!session_id()) {
    session_start();
  }

  $fb = new \Facebook\Facebook([
    'app_id' => '670367266996537',
    'app_secret' => 'b163eef587a59136bc0f1070326db86b',
    'default_graph_version' => 'v3.2',
  ]);

  try {
    $accessToken = $fb->getRedirectLoginHelper()->getAccessToken();
  } catch (\Facebook\Exceptions\FacebookResponseException $e) {
      echo "Response Exception: " . $e->getMessage();
      exit();
  } catch (\Facebook\Exceptions\FacebookSDKException $e) {
      echo "SDK Exception: " . $e->getMessage();
      exit();
  }

  if (isset($accessToken)) {
    $response = $fb->get('/me?fields=name,email,id', $accessToken);
    $fbUserData = $response->getGraphUser()->asArray();
  
    // Create an instance of the OauthUser class
    $oauth_user_obj = new OauthUser($db);
    $userData = $oauth_user_obj->verifyUser($fbUserData);
  }

?>