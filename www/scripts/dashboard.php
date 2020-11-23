<?php

  include('dbconfig.php');

  $data = array();

  $sql = "SELECT * FROM user_data WHERE user='".$_SESSION['user_id']."'";
  $result = mysqli_query($db, $sql);
  if ($result !== false) {
    foreach ($result->fetch_assoc() as $key => $value) {
      $data[$key] = $value;
    }
  } else {
    echo mysqli_error($db);
  }

  foreach ($data as $key => $value) {
    echo $key.": ".$value."\n";
  }

?>