<?php

  require_once('fbconfig.php');

  try {
    $accessToken = $handler->getAccessToken();
  } catch (\Facebook\Exceptions\FacebookResponseException $e){
      echo "Response Exception: " . $e->getMessage();
      exit();
  } catch (\Facebook\Exceptions\FacebookSDKException $e){
      echo "SDK Exception: " . $e->getMessage();
      exit();
  }

  if(!$accessToken){
      header('Location: ../views/login.php');
      exit();
  }

  $oAuth2Client = $FBObject->getOAuth2Client();
  if(!$accessToken->isLongLived())
      $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

      $response = $FBObject->get("/me?fields=id, first_name, last_name, email", $accessToken);
      $userData = $response->getGraphNode()->asArray();
      $_SESSION['userData'] = $userData;
      $_SESSION['access_token'] = (string) $accessToken;
      header('Location: ../views/dashboard.php');
      exit();

?>