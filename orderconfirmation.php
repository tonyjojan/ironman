<?php
require 'config.php';

if ( !isset($_POST['type']) || empty($_POST['type'])
|| !isset($_POST['location']) || empty($_POST['location'])
|| !isset($_POST['date']) || empty($_POST['date'])) {
    // Missing required fields.
    $error = "Please fill out all required fields.";
} if($_POST['date'] < date('Y-m-d')){
  $error = "Please select a date on or after today's date.";
}else {
  // Create our new user!
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if($mysqli->connect_errno) {
      echo $mysqli->connect_error;
      exit();
  }

  $sql = "INSERT into orders (id, email, type_id, location_id, pickup_date, status)
            VALUES (null, '". $_SESSION['email'] . "', " . $_POST['type'] . ", " . $_POST['location'] . ", '" . $_POST['date'] . "', 'incomplete');";
    // Send off the query and then store it in $results.
    $userresults = $mysqli->query($sql);
    // check for errors in results
    if ($userresults == false) {
       echo $mysqli->error;
       exit();
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

    <title>Your Order</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
  </head>

  <body>

    <!-- Begin page content -->
    <main role="main" class="container">
      <?php if( isset($error) && !empty($error) ): ?>
            <div class="text-danger">
                <h1 class="mt-5"><?php echo $error; ?></h1>
            </div>
          <?php else: ?>
            <div class="text-success">
                <h1 class="mt-5">Your order was successfully sent.</h1>
            </div>
            <p class="lead">Your clothes will be pressed soon!</p>
          <?php endif;?>

    </main>

  </body>
</html>
