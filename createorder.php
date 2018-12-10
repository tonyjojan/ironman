<?php
require 'config.php';

if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
  exit();
}


// Find types and locations
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
}


$sql = "SELECT * FROM types";
	// Send off the query and then store it in $results.
	$typesresults = $mysqli->query($sql);

	// check for errors in results
	if ($typesresults == false) {
	   echo $mysqli->error;
	   exit();
	}

  $sql = "SELECT * FROM locations";
// Send off the query and then store it in $results.
$locationsresults = $mysqli->query($sql);

// check for errors in results
if ($locationsresults == false) {
  echo $mysqli->error;
  exit();
}

$mysqli->close();



?><!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Order</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <div class="py-5 text-center">

        <img class="d-block mx-auto mb-4" src="/images/logo.jpg" alt="" width="72" height="72">
        <h2>Order form</h2>
        <p class="lead"></p>
      </div>
        <div class="col-md-8 order-md-1">
          <form class="needs-validation" novalidate  action="orderconfirmation.php" method="POST">
            <h4 class="mb-3">Clothing Information</h4>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Clothing Item</label>
                <select name="type" id="genre-id" class="form-control">
                <?php while($row = $typesresults->fetch_assoc()):?>
						            <option value="<?php echo $row['id'];?>">
						        <?php echo $row['type']; ?>
						           </option>
							       <?php endwhile; ?>
                </select>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
            </div>
            <h4 class="mb-3">Pickup Information</h4>
            <div class="mb-3">
              <label for="username">Pickup Location</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <select name="location" id="genre-id" class="form-control">
                <?php while($row = $locationsresults->fetch_assoc()):?>
						            <option value="<?php echo $row['id'];?>">
						        <?php echo $row['location']; ?>
						           </option>
							       <?php endwhile; ?>
                </select>
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
              </div>
            </div>
          <div class="mb-3">
            <label for="username">Pickup Date</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">On</span>
              </div>
              <input type="date" id="date" name="date"
                value="2018-07-22"
                  min="<?php echo date('Y-m-d');?>" max="2019-12-31">
              <div class="invalid-feedback" style="width: 100%;">
                Pickup DATE is required.
              </div>
            </div>
          </div>

            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Order</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Ironman</p>
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
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>
