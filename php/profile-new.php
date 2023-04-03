<?php

include '../connection.php';

$customer_id = $_SESSION['customer_id'];

if($_SESSION['customer_id'] ==false) {
  echo
    "<script>
            alert('You must log-in first...');
            window.location.href='landing-index.php';
    </script>";
}
else {
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = date("Y-m-d");
    $advance_date = date("Y-m-d", strtotime($date. ' + 10 days'));
    $_SESSION['departure'] = filter_input(INPUT_POST, 'departure', FILTER_SANITIZE_STRING);
    $_SESSION['arrival'] = filter_input(INPUT_POST, 'arrival', FILTER_SANITIZE_STRING);
    $_SESSION['date'] =  $_POST['date'];

    header('location: profile-departure.php');

  }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/icon-bus.png">
    <title>Irosin Elavil Bus Reservation</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script type="text/javascript" src="/assets/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

    
</head>
<body>

<!-- ====== Header ====== -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-sm d-flex align-items-center justify-content-between brand">
        <!-- Navigation bar logo -->
        <a href="#" class="logo d-flex align-items-center">
            <img src="../assets/img/icon-bus.png" alt="">
            <span>Irosin Elavil Tours PH.</span>
        </a>

        <nav id="navbar" class="navbar">
            <div class="lc-block d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="profile-dashboard.php" class="mx-5">Home</a>
                <a href="profile-new.php" class="mx-5">New Booking</a>
                <a href="profile-view.php" class="mx-5">View Booking</a>
                <a href="profile-logout.php" class="mx-5">Logout</a>
            </div>
        </nav> 
        <!-- END nav -->
    </div>
</header> <!--END Header-->

<div class="hero-image" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.pexels.com/photos/846350/pexels-photo-846350.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="https://images.pexels.com/photos/69866/pexels-photo-69866.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 100%;" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
      
                      <form role="form" method="post" enctype="multipart/form-data">
      
                        <div class="d-flex align-items-center mb-3 pb-1">
                            <img src="../assets/img/icon-ticket.png" alt="" width="70">
                            <span class="h1 fw-bold mb-0">&nbsp;&nbsp;Book Your Ticket</span>
                        </div>
                        <div class="form-outline mb-4">
                            <h5>From</h5>
                            <select class="form-select" name="departure" id="departure" required>
                                <option value="" disabled selected>Select your Departure</option>
                                <option value="Irosin">Irosin</option>
                            </select>
                        </div>
      
                        <div class="form-outline mb-4">
                            <h5>To</h5>
                            <select class="form-select" name="arrival" id="arrival" required>
                                <option value="" disabled selected>Select your Destination</option>
                                <option value="Pasay">Pasay</option>
                                <option value="Cubao">Cubao</option>
                            </select>
                        </div>

                        <h5>Date</h5>
                        <div class="form-outline mb-4 border p-2 rounded">

                            <input type="date" id="date" name="date" class="dropdown-item datepicker" min="<?php $date = date('Y-m-d'); 
                              $date = date("Y-m-d", strtotime($date. ' + 2 days')); echo $date;  ?>" required />
                        </div>

                        <div class="pt-1 mb-4">
                          <button class="btn hero-btn btn-lg btn-block" type="submit">Proceed</button>
                        </div>
                        
                        <span>NOTE: You can only reserve two days in advance</span>

                      </form>
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  </div>
  <!-- Hero Section - END -->
  <!-- Hero Section - END -->

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