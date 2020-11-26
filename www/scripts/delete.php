<?php

  include('../scripts/dbconfig.php');

  $id = $_GET['id'];

  $query = "DELETE FROM user WHERE id = $id";

  $result = mysqli_query($db, $query);

  if (mysqli_affected_rows($db) == 1) { 
    header('Location: ../views/administration.php');
  } else {
    echo "Error deleting record";
  }

?>