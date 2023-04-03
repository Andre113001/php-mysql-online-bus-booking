<?php

include '../connection.php';

if($_SESSION['username'] ==false)
{
    echo
    "<script>
            alert('You must log-in first...');
            window.location.href='admin-index.php';
    </script>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/icon-bus.png">
    <title>Admin Dashboard - Irosin Elavil Bus Reservation</title>

    <!-- Bootstrap - CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

    
</head>
<body>
    <div class="container">
        <!-- Header START -->
        <div class="row mb-2 mt-5">
            <div class="col">
                <h1>Welcome back, <span style="color: #00B3D7;"> <?php echo $_SESSION['username'] ?> </span></h1>
                <span>Irosin Elavil Tours Phils. Inc.</span>
            </div>
            <div class="col d-flex justify-content-center align-items-center col-sm-2">
                <a href="admin-logout.php" class="hero-btn rounded float-end">Logout</a>
            </div>
        </div>
        <!-- Header - END -->

        <div class="row text-center">
            <div class="col-sm">
                <a href="admin-users.php">
                    <div class="card-btn rounded p-4" style="background-color: #00b3d7;">
                        <img src="../assets/img/icon-user.png" alt="">
                        <h4>Users</h4>
                    </div>
                </a>
            </div>
            
            <div class="col-sm-4">
                <a href="admin-feedback.php">
                    <div class="card-btn rounded p-4">
                        <img src="../assets/img/icon-feedback.png" alt="">
                        <h4>Feedback</h4>
                    </div>
                </a>
            </div>

        </div>
        <div class="row text-center mt-4">

            <div class="col-sm">
                <a href="admin-busdetail.php">
                    <div class="card-btn rounded p-4">
                        <img src="../assets/img/icon-bus2.png" alt="">
                        <h4>Bus Details / Report</h4>
                    </div>
                </a>
            </div>
            <!-- <div class="col-sm-4">
                <a href="#">
                    <div class="card-btn rounded p-4">
                        <img src="../assets/img/icon-route.png" alt="">
                        <h4>Assigned Routes</h4>
                    </div>
                </a>
            </div> -->
            <div class="col-sm">
                <a href="admin-bookrecord.php">
                    <div class="card-btn rounded p-4" style="background-color: #00b3d7;">
                        <img src="../assets/img/icon-booking.png"  alt="">
                        <h4>Customers Record</h4>
                    </div>
                </a>
            </div>
        </div>
        <div class="row text-center mt-4">

            
        
            <div class="col-sm">
                <a href="admin-changepassword.php">
                    <div class="card-btn rounded p-2">
                        <img src="../assets/img/icon-key.png" alt="">
                        <h4>Change Password</h4>
                    </div>
                </a>
            </div>

        </div>
    </div>

    <!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
  
  </section>
  <!-- Section: Social media -->
  
  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
              Elavil Tours Phils. Inc.
          </h6>
          <p>
          Elavil Tours Phils.Inc is a bus company in the Philippines that has routes to the Northern Samar from Manila. It has daily trips to San Jose, Rosario, Laoang. Elavil Bus Terminal is one of the top-rated places listed as a Bus Station in Pasay City
          </p>
        </div>
        <!-- Grid column -->
  
        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Contact
          </h6>
          <p>Headquarters: <br> 309 P. Tuazon Blvd, Project 4, Quezon City, 1109 Metro Manila, Philippines <br>
            Contact Numbers: <br> +63 935 039 4703 <br>
            E-mail: <br> info@phbus.com</p>
        </div>
        <!-- Grid column -->
    </div>
  </section>
  <!-- Section: Links  -->
  
  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2023 Copyright:
    <a class="text-reset fw-bold" href="#">Irosin Elavil Tours PH.</a>
  </div>
  <!-- Copyright -->
  </footer>
  <!-- Footer -->
</body>
</html>