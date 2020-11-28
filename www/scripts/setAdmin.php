<?php

  require_once('dbconfig.php');

  $id = $_GET['id'];
  $data = array();

  $update = "UPDATE user SET user_type = 'admin' WHERE id = $id";
  $result = mysqli_query($db, $update);
  if ($result !== false) {
    $query = "SELECT * FROM user";
    $result = mysqli_query($db, $query);
    foreach ($result->fetch_assoc() as $key => $value) {
      $data[$key] = $value;
    }
    $_SESSION['userData']['user_type'] = isset($data['user_type']) ? $data['user_type'] : null;
    header("Location: ../views/administration.php");
  }
  else {
    echo mysqli_error($db);
  }

?>