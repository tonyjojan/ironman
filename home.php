<?php
require 'config.php';
if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
  exit();
}

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
}

$sql = "SELECT orders.id, types.type, locations.location, orders.status, orders.pickup_date FROM orders
          JOIN types
            ON types.id = orders.type_id
          JOIN locations
            ON locations.id = orders.location_id
        WHERE orders.email = '" . $_SESSION['email'] . "'
        ORDER BY orders.pickup_date;";
  // Send off the query and then store it in $results.
  $userresults = $mysqli->query($sql);
  // check for errors in results
  if ($userresults == false) {
     echo $mysqli->error;
     exit();
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

    <title><?php echo $_SESSION['name'];?>'s Orders'</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="pricing.css" rel="stylesheet">
  </head>

  <body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <h5 class="my-0 mr-md-auto font-weight-normal" onclick="window.location.href='index.php'">IronMan</h5>
      <p class ="my-0 mr-md-right font-weight-normal">Welcome,  <?php echo $_SESSION['name']; ?> <br></p>
      <a class="btn btn-outline-primary" href="logout.php">Log Out</a>
    </div>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4" >Your IronMan Orders</h1>
      <div class="card mb-4 shadow-sm">
        <div class="card-header">
          <button type="button" class="btn btn-lg btn-block btn-primary" onclick="location.href='createorder.php'">New Order</button>
        </div>
      </div>
    </div>

    <div class="container">
      <?php while($row = $userresults->fetch_assoc() ) :?>
        <div class="card mb-4 shadow-lg p-3 bg-white rounded">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Order #<?php echo $row['id'];?></h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">Item: <small class="text-muted"><?php echo $row['type']; ?></small></h1>
            <h1 class="card-title pricing-card-title">Location: <small class="text-muted"><?php echo $row['location']; ?></small></h1>
            <h1 class="card-title pricing-card-title">Pickup Date: <small class="text-muted"><?php echo $row['pickup_date']; ?></small></h1>
            <?php if($row['status'] == "incomplete"): ?>
            <button type="button" class="btn btn-lg btn-block btn btn-outline-danger" onclick="window.location.href='/delete.php?orderId=<?php echo $row['id']?>'">Cancel Order</button>
          <?php else: ?>
            <span class="badge badge-success">Order Complete</span>
          <?php endif; ?>
          </div>
        </div>
      <?php endwhile; ?>


      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <img class="mb-2" src="../../assets/brand/bootstrap-solid.svg" alt="" width="24" height="24">
            <small class="d-block mb-3 text-muted">&copy; 2017-2018</small>
          </div>
          <div class="col-6 col-md">
            <h5>Features</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Cool stuff</a></li>
              <li><a class="text-muted" href="#">Random feature</a></li>
              <li><a class="text-muted" href="#">Team feature</a></li>
              <li><a class="text-muted" href="#">Stuff for developers</a></li>
              <li><a class="text-muted" href="#">Another one</a></li>
              <li><a class="text-muted" href="#">Last time</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>Resources</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Resource</a></li>
              <li><a class="text-muted" href="#">Resource name</a></li>
              <li><a class="text-muted" href="#">Another resource</a></li>
              <li><a class="text-muted" href="#">Final resource</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>About</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Team</a></li>
              <li><a class="text-muted" href="#">Locations</a></li>
              <li><a class="text-muted" href="#">Privacy</a></li>
              <li><a class="text-muted" href="#">Terms</a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
