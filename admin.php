<?php
require 'config.php';

if ( !isset($_SESSION['super_logged_in']) || !$_SESSION['super_logged_in'] ) {
  exit();
}

if($_SESSION['super_logged_in'] != true) {
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
        ORDER BY orders.pickup_date;";
  // Send off the query and then store it in $results.
  $results = $mysqli->query($sql);
  // check for errors in results
  if ($results == false) {
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

    <title>IronMan Admin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">IronMan Admin</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">

        </li>
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">Log out</a>
        </li>
      </ul>
    </nav>




    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
                <a class="nav-link disabled" href="#">
                  <span data-feather="gift"></span>
                  Rewards(Coming soon)
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <br>
          <h2>Welcome,  <?php echo $_SESSION['name']; ?>.<br></p>Orders:</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Item</th>
                  <th>Location</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = $results->fetch_assoc() ) :?>

                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['type']; ?></td>
                  <td><?php echo $row['location']; ?></td>
                  <td><?php echo $row['date']; ?></td>
                  <td><?php if($row['status'] == "incomplete"): ?>
                  <button type="button" class="btn btn-block btn btn-outline-success" onclick="window.location.href='/complete.php?orderId=<?php echo $row['id']?>'">Pick Up</button>
                <?php else: ?>
                  <span class="badge badge-success">Order Complete</span>
                <?php endif; ?></td>
                </tr>
              <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>
  </body>
</html>
