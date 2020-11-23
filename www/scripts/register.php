<?php

  include('dbconfig.php');

  $username = "";
  $email = "";
  $errors = array();
  $data = array();
  $userData = array();

  // register user
  if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password1 = mysqli_real_escape_string($db, $_POST['password1']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);

    if ($password1 != $password2) {
      array_push($errors, "The two passwords do not match");
    }

    // if there are no erros, save user to database
    if (count($errors) == 0) {
      $password = md5($password1); // encrypt password before storing in db (security)
      $sql = "INSERT INTO user (username, email, password)
              VALUES ('$username', '$email,', '$password')";
      mysqli_query($db, $sql);
      $_SESSION['userData']['username'] = $username;
      header('location: ../views/dashboard.php');
    }
  }

  // log user
  if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (count($errors) == 0) {
      $password = md5($password);
      $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
      $result = mysqli_query($db, $query);
      if (mysqli_num_rows($result) == 1) {
        foreach ($result->fetch_assoc() as $key => $value) {
          $data[$key] = $value;
        }
        $_SESSION['userData']['id'] = isset($data['id']) ? $data['id'] : null;
        $_SESSION['userData']['email'] = isset($data['email']) ? $data['email'] : null;
        $_SESSION['userData']['name'] = $username;
        header('location: ../views/dashboard.php'); // redirect to dashboard
      } else {
        array_push($errors, "Wrong username/password combination");
      }
    }
  }

  // logout
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['userData']);
    header('location: ../views/login.php');
  }

?>