<?php
  $first_name = "";
  $last_name = "";
  $errors = array();

  // connect to the database
  $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if ($db -> connect_errno) {
    echo "Failed to connect to MySQL: " . $db -> connect_error;
    exit();
  }

  if (isset($_POST['register'])) {
    $first_name = $db->real_escape_string($_POST['first_name']);
    $last_name = $db->real_escape_string($_POST['last_name']);
    $email = $db->real_escape_string($_POST['email']);
    $password1 = $db->real_escape_string($_POST['password1']);
    $password2 = $db->real_escape_string($_POST['password2']);

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
    if (count($erros) == 0) {
      $password = md5($password1); // encrypt password before storing in db (security)
      $sql = "INSERT INTO user (firstname, lastname, email, password)
              VALUES ('$first_name', '$last_name', '$email,', '$password')";
    mysqli_query($db, $sql);
    }
  }



?>