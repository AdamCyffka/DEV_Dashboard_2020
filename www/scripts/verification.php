<?php

  include('dbconfig.php');

  $email = $_SESSION['userData']['email'];
  $token = $_SESSION['userData']['token'];
  $query = "SELECT * FROM user WHERE email = '$email' AND token = '$token'";
  $result = mysqli_query($db, $query);

  if ($result !== false && mysqli_num_rows($result) > 0) {
    $update = "UPDATE user SET confirmation = 1, token = '' WHERE email = '$email'";
    $result = mysqli_query($db, $update);
    if ($result !== false) {
      $_SESSION['userData']['confirmation'] = 1;
      header("Location: ../views/dashboard.php");
    }
    else {
      echo mysqli_error($db);
    }
  } else {
    echo 'Email already confirmed, go to the dashboard: <a href="http://localhost:8080/views/dashboard.php">Dashboard</a>';
  }

?>