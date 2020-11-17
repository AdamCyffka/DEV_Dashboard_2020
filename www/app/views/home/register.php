<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Dashboard</title>
</head>

<body>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-6 m-auto">
        <form class="text-center border border-grey p-5 rounded" action="/users/register" method="POST">

          <p class="h4 mb-4">Register</p>

          <div class="form-row mb-4">
            <div class="col">
              <!-- First name -->
              <input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="First name">
            </div>
            <div class="col">
              <!-- Last name -->
              <input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Last name">
            </div>
          </div>

          <input type="email" id="email" name="email" class="form-control mb-4" placeholder="Enter Email"
            value="<%= typeof email != 'undefined' ? email : '' %>" />

          <input type="password" id="password" name="password" class="form-control" placeholder="Create Password"
            value="<%= typeof password != 'undefined' ? password : '' %>" />
          <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
            At least 6 characters
          </small>

          <input type="password" id="password2" name="password2" class="form-control mb-4"
            placeholder="Confirm Password" value="<%= typeof password2 != 'undefined' ? password2 : '' %>" />

          <button type="submit" class="btn btn-info my-4 btn-block">
            Register
          </button>

          <p>Already a member?
            <a href="/users/login">Login</a>
          </p>

          <p>or sign up with:</p>

          <a href="/auth/facebook" class="mx-2" role="button"><i class="fa fa-facebook-f light-blue-text"></i></a>
          <a href="/auth/google" class="mx-2" role="button"><i class="fa fa-google light-blue-text"></i></a>

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