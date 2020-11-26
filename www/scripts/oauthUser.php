<?php

  class OauthUser {

    private $db;

    function __construct($dtb) {
      $this->db = $dtb;
    }

    function verifyFacebookUser($userInfo) {
      $qry_body = "
              `username` = '".$userInfo['name']."',
              `oauth_uid` = '".$userInfo['id']."',
              `user_type` = 'user',
              `email` = '".$userInfo['email']."'";

      $select_qry = "SELECT * FROM user WHERE `oauth_uid` = '".$userInfo['id']."'";
      $res = mysqli_query($this->db, $select_qry);
      if ($res !== false and mysqli_num_rows($res) > 0) {
        // Update user details if it is already exists in the table
        $qry = "UPDATE user SET ".$qry_body." WHERE `oauth_uid` = '".$userInfo['id']."'";
      } else {
        // Insert into table if user not exists in the table
        $qry = "INSERT INTO user SET ".$qry_body."";
      }
      mysqli_query($this->db, $qry);
      $_SESSION['userData']['oauth_uid'] = $userInfo['id'];
      $_SESSION['userData']['name'] = $userInfo['name'];
      $_SESSION['userData']['email'] = $userInfo['email'];
      header('location: ../views/dashboard.php');
      exit();
    }
  }

?>