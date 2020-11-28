<?php

  require_once('dbconfig.php');

  $id = $_GET['id'];

  if ($_SESSION['userData']['id'] !== $id) {
    $query = "DELETE FROM user WHERE id = $id";
    $query_data = "DELETE FROM user_data WHERE user = $id";

    $result = mysqli_query($db, $query);
    $result_data = mysqli_query($db, $query_data);
  
    if (mysqli_affected_rows($db) == 1) { 
      header('Location: ../views/administration.php');
    } else {
      echo "Error deleting record";
    }
  } else {
    header('Location: ../views/administration.php');
  }

?>