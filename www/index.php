<?php

  include('scripts/register.php');

  if (isset($_SESSION['username'])) {
    header('location: views/dashboard.php');
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" type="text/css" href="public/css/dashboard.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Dashboard</title>
</head>

<body>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-6 m-auto">
        <div class="text-center border border-grey p-5 rounded">
          <h1>Welcome to the Dashboard</h1>
          <p>You can start by creating an account or login.</p>
          <a href="views/register.php" class="btn btn-primary btn-block my-4"><span class="fa fa-user-plus"></span> Sign Up</a>
          <a href="views/login.php" class="btn btn-success btn-block my-4"><span class="fa fa-sign-in"></span> Login</a>
        </div>
        <small class="form-text text-muted text-center">
          Created by Adam Cyffka & Valentin Masson
        </small>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>