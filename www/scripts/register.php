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
    $user_type = "user";

    if ($password1 != $password2) {
      array_push($errors, "The two passwords do not match.");
    }

    if (strlen($password1) && strlen($password2) < 5) {
      array_push($errors, "Passwords need to be 6 characters or longer.");
    }

    // if there are no erros, save user to database
    if (count($errors) == 0) {
      $password = md5($password1); // encrypt password before storing in db (security)
      $query = "SELECT * FROM user WHERE email = '$email'";
      $result = mysqli_query($db, $query);
      if (mysqli_num_rows($result) == 0) { // If no previous user is using this username
        $longueurKey = 15;
        $key = "";
        for ($i = 1; $i < $longueurKey; $i++) {
          $key .= mt_rand(0, 9);
        }
        $sql = "INSERT INTO user (`username`, `email`, `password`, `user_type`, `confirmkey`) VALUES ('$username', '$email,', '$password', '$user_type', '$key')";
        $result = mysqli_query($db, $sql);
        if (!$result) {
          echo 'Query Failed';
        }
        if (mysqli_affected_rows($db) == 1) { // If the Insert Query was successfull
          $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
          $result = mysqli_query($db, $query);
          foreach ($result->fetch_assoc() as $key => $value) {
            $data[$key] = $value;
          }
          $_SESSION['userData']['id'] = isset($data['id']) ? $data['id'] : null;
          $_SESSION['userData']['email'] = isset($data['email']) ? $data['email'] : null;
          $_SESSION['userData']['name'] = $username;
          $_SESSION['userData']['user_type'] = $user_type;
          $user_id = $data['id'];
          $widget = "INSERT INTO user_data (`user`, `widgets`) VALUES ('$user_id', ';;;;')";
          $result_widget = mysqli_query($db, $widget);


          // Send mail confirmation
          // $header = "MIME-Version: 1.0\r\n";
          // $header .= 'From: "Dashboard.com"<support@dashboard.com>'."\n";
          // $header .= 'Content-Type:text/html; charset="utf-8"'."n";
          // $header .= 'Content-Transfer-Encoding: 8bit';
          
          // $message = '
          //   <html>
          //     <body>
          //       <div align="center">
          //         <a href="http://localhost:8080/views/dashboard.php#_=_">Confirmer votre compte !</a>
          //       </div>
          //     </body>
          //   </html>
          // ';
          // mail($mail, "Confirmation de compte", $message, $header);

          header('location: ../views/dashboard.php');
        }
      } else { // The username is not available.
        array_push($errors, "That email has already been registered.");
      }
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
        $_SESSION['userData']['email'] = isset($data['email']) ? $data['email'] : null;
        $_SESSION['userData']['name'] = $username;
        header('location: ../views/dashboard.php'); // redirect to dashboard
      } else {
        array_push($errors, "Wrong username/password combination.");
      }
    }
  }

  // logout
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['userData']);
    header('location: ../views/login.php');
    exit;
  }

?>