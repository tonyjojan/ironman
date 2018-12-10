<?php
require 'config.php';

if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
    // User Not Logged In.

    if ( isset($_POST['inputEmail']) && isset($_POST['inputPassword']) ) {


        // Form was submitted
        if ( empty($_POST['inputEmail']) || empty($_POST['inputPassword']) ) {
            // Missing username or password.
            $error = "Please enter username and password.";

            //  TO check if user has enetered the correct password,
            // 1) get this user's record from the DB
            // 2) Run $_POST['password'] through the hash function
            // 3) Check that this hash matches the hash from the DB

        }
        else{
          $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

          if($mysqli->connect_errno) {
              echo $mysqli->connect_error;
              exit();
          }

          $sql = "SELECT * FROM users
                    WHERE email = '" . $_POST['inputEmail'] . "'";
          	// Send off the query and then store it in $results.
          	$userresults = $mysqli->query($sql);
          	// check for errors in results
          	if ($userresults == false) {
          	   echo $mysqli->error;
          	   exit();
          	}

            $row = $userresults->fetch_assoc();
            $useremail = $row['email'];
            $userpassword = $row['password'];
            $currentpassword = hash('sha256', $_POST['inputPassword']);

            if($_POST['inputEmail'] == $useremail && $currentpassword == $userpassword) {
              $_SESSION['logged_in'] = true;
              $_SESSION['email'] = $_POST['inputEmail'];
              $_SESSION['name'] = $row['first_name'];
              header('Location: home.php');
            }
            else {
                // Invalid credentials.
                $error = "Invalid username or password.";
            }

        }

    }

} else {
    // User Already Logged In.
    header('Location: home.php');;
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

    <title>Log in to IronMan</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="login.php" method="POST">
      <img class="mb-4" src="images/logo.jpg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Log In to IronMan</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name = "inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name = "inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <a class="btn btn-lg btn-primary btn-block" href="superlogin.php" role="button">Presser Sign In</a>
      <div class="row mb-3">
               <div class="font-italic text-danger col-sm-9 ml-sm-auto">
                   <!-- Show errors here. -->
                   <?php
                       if ( isset($error) && !empty($error) ) {
                           echo $error;
                       }
                   ?>
               </div>
           </div>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
</html>
