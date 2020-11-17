<!-- 
  HTML page to view login 
  a $data multidimentional array contains every info that sent to this view 
  and the language translation. 
  $data['lang']['main'] : main language data
  $data['lang']['home/login'] : home/login language data

  a login form should be in here
  users POST request to send login info 
  username, password to the same page
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 m-auto">
                <form class="text-center border border-grey p-5 rounded" action="/users/login" method="POST">
                    
                    <p class="h4 mb-4">Login</p>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control mb-4"
                        placeholder="E-mail"
                    />

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Password"
                    />

                    <button type="submit" class="btn btn-info btn-block my-4">Login</button>

                    <p>Not a member?
                        <a href="/users/register">Register</a>
                    </p>

                    <p>or sign in with:</p>

                    <a href="/auth/facebook" class="mx-2" role="button"><i class="fa fa-facebook-f light-blue-text"></i></a>
                    <a href="/auth/google" class="mx-2" role="button"><i class="fa fa-google light-blue-text"></i></a>

                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>