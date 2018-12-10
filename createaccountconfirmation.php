<?php
require 'config.php';

if ( !isset($_POST['inputFirstName']) || empty($_POST['inputFirstName'])
    || !isset($_POST['inputLastName']) || empty($_POST['inputLastName'])
    || !isset($_POST['inputEmail']) || empty($_POST['inputEmail'])
    || !isset($_POST['inputPassword']) || empty($_POST['inputPassword']) ) {
    $error = "Please fill out all required fields.";
}
else {
    // Create our new user!
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if($mysqli->connect_errno) {
        echo $mysqli->connect_error;
        exit();
    }

    // Check that the user's username or email is not already taken.
    $sql_registered = "SELECT * FROM users
                        WHERE email = '" . $_POST['inputEmail'] . "';";

    $results_registered = $mysqli->query($sql_registered);
    if(!$results_registered) {
        echo $mysqli->error;
        exit();
    }

    // If we get ANY result back, it means the username or email has already been taken
    // var_dump($results_registered);
    if($results_registered->num_rows > 0) {
        $error = "Email has been already taken. Please choose another one.";
    }
    else {

        // Add this new user to the DB
        // Hash our password
        $password = hash('sha256', $_POST['inputPassword']);

        // Run our SQL query
        $sql = "INSERT INTO users(first_name, last_name, email, password)
                VALUES('" . $_POST['inputFirstName'] . "','" .  $_POST['inputLastName'] . "','".  $_POST['inputEmail'] . "','". $password . "');";

        $results = $mysqli->query($sql);

        if(!$results) {
            echo $mysqli->error;
            exit();
        }


    }

    $mysqli->close();
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
    <div class="container">

              <?php if ( isset($error) && !empty($error) ) : ?>
                   <div class="text-danger"><?php echo $error; ?></div>
               <?php else : ?>
                   <h1 class="h3 mb-3 font-weight-normal">Your account was successfully created.</h1>
               <?php endif; ?>
               <!-- Content here -->
   </div>
  </body>
</html>
