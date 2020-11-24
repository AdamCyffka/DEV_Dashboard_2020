<?php

  // Method: POST, PUT, GET etc
  // Data: array("param" => "value") ==> index.php?param=value

  class Api {
  
    function callApi($method, $url, $data = false) {
      $curl = curl_init();
  
      switch ($method) {
        case "POST":
          curl_setopt($curl, CURLOPT_POST, 1);
          if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          break;
        case "PUT":
          curl_setopt($curl, CURLOPT_PUT, 1);
          break;
        default:
          if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
      }
  
      $result = curl_exec($curl);
      if (!$result) {
        die ("Connection Failure");
      }
      curl_close($curl);
      return $result;
    }
  }

?>


<!-- EXEMPLE 

GET request:

$get_data = callApi('GET', 'https://api.example.com/get_url/'.$user['User']['customer_id'], false);
$response = json_decode($get_data, true);
$errors = $response['response']['errors'];   // Optionnal
$data = $response['response']['data'][0];    // Optionnal


POST request:

$data_array =  array(
  "username" = '".$userInfo['name']."',
);
$make_call = callApi('POST', 'https://api.example.com/post_url/', json_encode($data_array));
$response = json_decode($make_call, true);
$errors = $response['response']['errors'];    // Optionnal
$data = $response['response']['data'][0];   // Optionnal


-->