<?php

  require_once('../libraries/facebook-sdk/src/Facebook/autoload.php');

  if (!session_id()) {
    session_start();
  }

  if(isset($_GET['state'])) {
    $_SESSION['FBRLH_state'] = $_GET['state'];
  }

  $fb = new \Facebook\Facebook([
    'app_id' => '670367266996537',
    'app_secret' => 'b163eef587a59136bc0f1070326db86b',
    'default_graph_version' => 'v3.2',
  ]);

  try {
    $accessToken = $access_token = $fb->getRedirectLoginHelper()->getAccessToken();
  } catch (\Facebook\Exceptions\FacebookResponseException $e){
      echo "Response Exception: " . $e->getMessage();
      exit();
  } catch (\Facebook\Exceptions\FacebookSDKException $e){
      echo "SDK Exception: " . $e->getMessage();
      exit();
  }

  if (isset($access_token)) {
    $response = $fb->get("/me?fields=id, first_name, last_name, email", $accessToken);
    $userData = $response->getGraphNode()->asArray();
    $_SESSION['userData'] = $userData;
    $_SESSION['access_token'] = (string) $accessToken;
    header('Location: ../views/dashboard.php');
  }

?>