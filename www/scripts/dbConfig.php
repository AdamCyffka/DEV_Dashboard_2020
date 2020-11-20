<?php

  if (!session_id()) {
    session_start();
  }

  require_once('credentials.php');

  $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if (!$db) {
    exit;
  }

?>