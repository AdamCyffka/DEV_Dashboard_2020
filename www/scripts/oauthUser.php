<?php

  class OauthUser {

    private $db;
    private $data = array();

    function __construct($dtb) {
      $this->db = $dtb;
    }

    function verifyFacebookUser($userInfo) {
      $qry_body = "
              `username` = '".$userInfo['name']."',
              `oauth_uid` = '".$userInfo['id']."',
              `user_type` = 'user',
              `email` = '".$userInfo['email']."'";

      $qry_body2= "
              `username` = '".$userInfo['name']."',
              `oauth_uid` = '".$userInfo['id']."',
              `email` = '".$userInfo['email']."'";

      $select_qry = "SELECT * FROM user WHERE `email` = '".$userInfo['email']."'";
      $res = mysqli_query($this->db, $select_qry);
      if ($res !== false and mysqli_num_rows($res) > 0) {
        // Update user details if it is already exists in the table
        $qry = "UPDATE user SET confirmation = 1, token = '', ".$qry_body2." WHERE `email` = '".$userInfo['email']."'";
      } else {
        // Insert into table if user not exists in the table
        $qry = "INSERT INTO user SET confirmation = 1, token = '', ".$qry_body."";
      }
      $result = mysqli_query($this->db, $qry);
      $query = "SELECT * FROM user";
      $result = mysqli_query($this->db, $query);
      foreach ($result->fetch_assoc() as $key => $value) {
        $this->data[$key] = $value;
      }
      $_SESSION['userData']['id'] = isset($this->data['id']) ? $this->data['id'] : null;
      $_SESSION['userData']['oauth_uid'] = $userInfo['id'];
      $_SESSION['userData']['user_type'] = isset($this->data['user_type']) ? $this->data['user_type'] : null;
      $_SESSION['userData']['name'] = $userInfo['name'];
      $user_id = $this->data['id'];
      $widget = "INSERT INTO user_data (`user`, `widgets`) VALUES ('$user_id', ';;;;')";
      mysqli_query($this->db, $widget);
      $_SESSION['userData']['confirmation'] = 1;
      header('location: ../views/dashboard.php');
      exit();
    }

    function verifyGoogleUser($userInfo) {
      $qry_body = "
              `username` = '".$userInfo['name']."',
              `oauth_uid` = '".$userInfo['id']."',
              `user_type` = 'user',
              `email` = '".$userInfo['email']."'";
            
      $qry_body2= "
              `username` = '".$userInfo['name']."',
              `oauth_uid` = '".$userInfo['id']."',
              `email` = '".$userInfo['email']."'";

      $select_qry = "SELECT * FROM user WHERE `email` = '".$userInfo['email']."'";
      $res = mysqli_query($this->db, $select_qry);
      if ($res !== false and mysqli_num_rows($res) > 0) {
        // Update user details if it is already exists in the table
        $qry = "UPDATE user SET confirmation = 1, token = '', ".$qry_body2." WHERE `email` = '".$userInfo['email']."'";
      } else {
        // Insert into table if user not exists in the table
        $qry = "INSERT INTO user SET confirmation = 1, token = '', ".$qry_body."";
      }
      $result = mysqli_query($this->db, $qry);
      $query = "SELECT * FROM user";
      $result = mysqli_query($this->db, $query);
      foreach ($result->fetch_assoc() as $key => $value) {
        $this->data[$key] = $value;
      }
      $_SESSION['userData']['id'] = isset($this->data['id']) ? $this->data['id'] : null;
      $_SESSION['userData']['oauth_uid'] = $userInfo['id'];
      $_SESSION['userData']['user_type'] = isset($this->data['user_type']) ? $this->data['user_type'] : null;
      $_SESSION['userData']['name'] = $userInfo['name'];
      $user_id = $this->data['id'];
      $widget = "INSERT INTO user_data (`user`, `widgets`) VALUES ('$user_id', ';;;;')";
      mysqli_query($this->db, $widget);
      $_SESSION['userData']['confirmation'] = 1;
      header('location: ../views/dashboard.php');
      exit();
    }

  }

?>