<?php

// if (!session_id()) {
// 	session_start();
// }

// require_once __DIR__ . 'libraries/facebook/autoload.php';

// $FBObject = new \Facebook\Facebook([
// 	'app_id' => FACEBOOK_CLIENT_ID,
// 	'app_secret' => FACEBOOK_CLIENT_SECRET,
// 	'default_graph_version' => 'v2.10'
// ]);

// //Get the login redirect helper
// $helper = $FBObject->getRedirectLoginHelper();
// if (isset($_GET['state'])) {
//     $helper->getPersistentDataHandler()->set('state', $_GET['state']);
// }

// // Get the access token
// try {
//   if(isset($_SESSION['facebook_access_token'])) {
//     $accessToken = $_SESSION['facebook_access_token'];
//   } else {
//      $accessToken = $helper->getAccessToken();
//   }
// }catch(Facebook\Exceptions\FacebookResponseException $e) {
//   // When Graph returns an error
//   echo 'Graph error: ' . $e->getMessage();
//   exit;
// } catch(Facebook\Exceptions\FacebookSDKException $e) {
//   // When validation fails or other local issues
//   echo 'Facebook SDK error: ' . $e->getMessage();
//   exit;
// }

?>