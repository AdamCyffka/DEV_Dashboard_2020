<?php

  include('dbconfig.php');

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

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
      function getToken($len=32) {
        return substr(md5(openssl_random_pseudo_bytes(20)), -$len);
      }
      $token = getToken(10);
      $query = "SELECT * FROM user WHERE email = '$email'";
      $result = mysqli_query($db, $query);
      if (mysqli_num_rows($result) == 0) { // If no previous user is using this username
        $sql = "INSERT INTO user (`username`, `email`, `password`, `user_type`, `token`) VALUES ('$username', '$email', '$password', '$user_type','$token')";
        $result = mysqli_query($db, $sql);
        if (!$result) {
          echo 'Query Failed';
        }
        if (mysqli_affected_rows($db) == 1) { // If the Insert Query was successful
          $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
          $result = mysqli_query($db, $query);
          foreach ($result->fetch_assoc() as $key => $value) {
            $data[$key] = $value;
          }
          $_SESSION['userData']['id'] = isset($data['id']) ? $data['id'] : null;
          $_SESSION['userData']['name'] = $username;
          $_SESSION['userData']['user_type'] = $user_type;
          $user_id = $data['id'];
          $widget = "INSERT INTO user_data (`user`, `widgets`) VALUES ('$user_id', ';;;;')";
          $result_widget = mysqli_query($db, $widget);

          // Send mail confirmation
          require_once('../libraries/php-mailer/autoload.php');

          $mail = new PHPMailer(true);

          try {
            // SMTP config
            $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
            $mail->IsSMTP();
            $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Username   = "dashboardepitech59@gmail.com";  // GMAIL username
            $mail->Password   = "Epitech59";            // GMAIL password
            $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
            $mail->Port       = 587;                   // set the SMTP port for the GMAIL server

            // Recipients
            $mail->setFrom('dashboardepitech59@gmail.com', 'Dashboard');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Confirm email';
            $mail->Body = 'Activate your email:
            <a href="http://localhost:8080/scripts/verification.php?email=' . $email . '&token=' . $token . '">Confirm email</a>';

            $mail->Send();
            $_SESSION['userData']['email'] = $email;
            $_SESSION['userData']['token'] = $token;
            array_push($errors, "Check your inbox for a confirmation email.");
          } catch (Exception $e) {
            echo 'Message could not be sent. Error: ', $mail->ErrorInfo;
          }
        }
      } else { // The username is not available.
        array_push($errors, "That email has already been registered.");
      }
    }
  }

  // log user
  if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (count($errors) == 0) {
      $password = md5($password);
      $query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
      $result = mysqli_query($db, $query);
      if (mysqli_num_rows($result) == 1) {
        foreach ($result->fetch_assoc() as $key => $value) {
          $data[$key] = $value;
        }
        $_SESSION['userData']['id'] = isset($data['id']) ? $data['id'] : null;
        $_SESSION['userData']['user_type'] = isset($data['user_type']) ? $data['user_type'] : null;
        $_SESSION['userData']['confirmation'] = isset($data['confirmation']) ? $data['confirmation'] : null;
        $_SESSION['userData']['name'] = $email;
        if (($_SESSION['userData']['confirmation']) == 1) {
          header('location: ../views/dashboard.php'); // redirect to dashboard
        }
      } else {
        array_push($errors, "Wrong email/password combination.");
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