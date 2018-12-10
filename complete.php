<?php
require 'config.php';

if ( !isset($_GET['orderId']) || empty($_GET['orderId'])) {
    // Missing required fields.
    $error = "Please fill out all required fields.";
}else {
  // Create our new user!
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if($mysqli->connect_errno) {
      echo $mysqli->connect_error;
      exit();
  }

  $sql = "UPDATE orders
            SET status = 'complete'
          WHERE id = " . $_GET['orderId'] . ";";
    // Send off the query and then store it in $results.
    $results = $mysqli->query($sql);
    // check for errors in results
    if ($results == false) {
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

    <title>Order Completion</title>

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
                <h1 class="mt-5">Order Completed.</h1>
            </div>
          <?php endif;?>

    </main>

  </body>
</html>
