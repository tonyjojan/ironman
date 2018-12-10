<?php
if ( !empty($_SESSION['name'])) {
  header('Location: home.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Create Account</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="createsuperaccountconfirmation.php" method="POST">
      <img class="mb-4" src="images/logo.jpg" alt="" width="72" height="72">
      <h1 class="h1 mb-3 font-weight-normal">Sign Up To Be A Presser!</h1>
      <h5 class="h5 mb-3 font-weight-normal">Earn $1 in credit for each item you iron.</h5>
      <h5 class="h5 mb-3 font-weight-normal">Redeem your credits for gift cards and other rewards!</h5>
      <label for="inputFirstName" class="sr-only">First Name</label>
      <input type="text" id="inputFirstName" name="inputFirstName" class="form-control" placeholder="First Name" required autofocus>
      <label for="inputLastName" class="sr-only">Last Name</label>
      <input type="text" id="inputLastName" name="inputLastName" class="form-control" placeholder="Last Name" required autofocus>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name = "inputPassword" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Create Account</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
    <script>
        document.querySelector('form').onsubmit = function(){
            if ( document.querySelector('#inputFirstName').value.trim().length == 0 ) {
                document.querySelector('#inputFirstName').classList.add('is-invalid');
            } else {
                document.querySelector('#inputFirstName').classList.remove('is-invalid');
            }

            if ( document.querySelector('#inputLastName').value.trim().length == 0 ) {
                document.querySelector('#inputLastName').classList.add('is-invalid');
            } else {
                document.querySelector('#inputLastName').classList.remove('is-invalid');
            }

            if ( document.querySelector('#inputEmail').value.trim().length == 0 ) {
                document.querySelector('#inputEmail').classList.add('is-invalid');
            } else {
                document.querySelector('#inputEmail').classList.remove('is-invalid');
            }

            if ( document.querySelector('#inputPassword').value.trim().length == 0 ) {
                document.querySelector('#inputPassword').classList.add('is-invalid');
            } else {
                document.querySelector('#inputPassword').classList.remove('is-invalid');
            }

            return ( !document.querySelectorAll('.is-invalid').length > 0 );
        }
    </script>
  </body>
</html>
