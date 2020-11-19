<?php

  require_once('config.php');

  $username = "";
  $email = "";
  $errors = array();

  if (isset($_POST['register'])) {
    $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password1 = mysqli_real_escape_string($db, $_POST['password1']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);

    // ensure that form fields are filled properly
    if (empty($first_name)) {
      array_push($errors, "First name is required");
    }
    if (empty($last_name)) {
      array_push($errors, "Last name is required");
    }
    if (empty($email)) {
      array_push($errors, "Email is required");
    } 
    if (empty($password1)) {
      array_push($errors, "Password is required");
    }

    if ($password1 != $password2) {
      array_push($errors, "The two passwords do not match");
    }

    // if there are no erros, save user to database
    if (count($errors) == 0) {
      $password = md5($password1); // encrypt password before storing in db (security)
      $sql = "INSERT INTO user (firstname, lastname, email, password)
              VALUES ('$first_name', '$last_name', '$email,', '$password')";
      mysqli_query($db, $sql);
    }
  }

?>