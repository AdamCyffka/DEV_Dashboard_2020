<?php

  include('../scripts/fbconfig.php');
  include('../scripts/register.php');
  
  if (isset($_SESSION['userData'])) {
    if (isset($_SESSION['userData']['confirmation']) && ($_SESSION['userData']['confirmation']) == 1) {
      header('location: dashboard.php');
    }
  }

  $loginUrl = $fb->getRedirectLoginHelper()->getLoginUrl("http://localhost:8080/scripts/fbconfig.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <script src="https://kit.fontawesome.com/e98aadb0d3.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../public/css/dashboard.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Dashboard</title>
</head>

<body>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-6 m-auto">
        <form class="text-center border border-grey p-5 rounded" action="login.php" method="POST">

          <!-- display validation errors here -->
          <?php include('../scripts/errors.php'); ?>

          <p class="h4 mb-4">Login</p>

          <input type="text" id="username" name="username" class="form-control mb-4" placeholder="Username"
            value="<?php echo $username; ?>" required />

          <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />

          <button type="submit" name="login" class="btn btn-info btn-block my-4">Login</button>

          <p>Not a member?
            <a href="register.php">Register</a>
          </p>

          <p>or sign in with:</p>

          <a href="<?php echo htmlspecialchars($loginUrl); ?>" class="mx-2" role="button"><i
              class="fab fa-facebook-f light-blue-text"></i></a>
          <a href="../scripts/callbackGoogle.php" class="mx-2" role="button"><i class="fa fa-google light-blue-text"></i></a>

        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
</body>

</html>