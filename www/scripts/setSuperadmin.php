<?php

  require_once('dbconfig.php');

  $id = $_GET['id'];

  $update = "UPDATE user SET user_type = 'superadmin' WHERE id = $id";
  $result = mysqli_query($db, $update);
  if ($result !== false) {
    header("Location: ../views/administration.php");
  }
  else {
    echo mysqli_error($db);
  }

?>