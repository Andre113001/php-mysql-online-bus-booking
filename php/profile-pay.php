<?php

include '../connection.php';
$customer_id = $_SESSION['customer_id'];
if($_SESSION['customer_id'] ==false)
{
    echo
    "<script>
            alert('You must log-in first...');
            window.location.href='landing-index.php';
    </script>";
}
else 
{
  $booking_id = $_SESSION['booking_id'];
  
  $sql = mysqli_query($conn,"SELECT * FROM bus_booking WHERE booking_id = '$booking_id'");
  $result = mysqli_fetch_array($sql) or die("Data Retrieval Failed.");
  $get_discount = mysqli_query($conn, "SELECT * FROM admin_queue_discount WHERE discount_ticketID = '$booking_id' and discount_status = 'TRUE'");
  $fetch_discount = mysqli_fetch_assoc($get_discount);

  if (mysqli_num_rows($get_discount) > 0)
  {
    $actualPrice = $result['booking_seatFare'];
    $type = $fetch_discount['discount_type'];

    $getTotal_passengers = $result['booking_seatChosen'];
    $getTotal_passengers = explode(",", $getTotal_passengers);
    $total_passengers = sizeof($getTotal_passengers);

    $getDiscounted_passengers = $type;
    $getDiscounted_passengers = explode(",", $getDiscounted_passengers);
    $totalDiscount = sizeof($getDiscounted_passengers);

    $farePrice = $result['booking_seatFare'] / $total_passengers;
    $discount = $farePrice * 0.2;
    
    for ($i = 0; $i < $totalDiscount; $i++) {
        $actualPrice -= $discount;
    }

  }
  else {
      $actualPrice = $result['booking_seatFare'];
      $discount_status = "FALSE";
  }
  // $mysql = mysqli_query($conn, "UPDATE bus_booking SET booking_seatFare = '$actualPrice' where booking_id = '$booking_id'");
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
          <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <h2>Payment</h2>
                <p>Kindly send  your payment in this Gcash Number to reserve your seat.</p>
                <div class="row m-4 d-flex align-items-center">
                    <div class="col">
                        <div class="card-img">
                            <img src="https://play-lh.googleusercontent.com/QNP0Aj2hyumAmYiWVAsJtY2LLTQnzHxdW7-DpwFUFNkPJjgRxi-BXg7A4yI6tgYKMeU" width="350rem" style="border-radius: 30px;">
                        </div>
                    </div>
                    <div class="col">
                          <h3>Total Payment:</h3>
                          <h2>PHP <?php echo $actualPrice; ?></h2>
                          <br>
                          <h3>Send To:</h3>
                          <h2>Irosin Elavil Bus</h2>
                          <h3>09992233453</h3>
                          <h6 class="mt-5"><span style="color: red;">REMINDER:</span> Once your payment sent, kindly upload a screenshot of confirmation and fill in the reference number.</h6>

                          <p>Ticket Code: <span class="fw-bold"><?php echo $_SESSION['booking_id']?></span></p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-2 mx-2">
                        <input type="button" value="Later" class="hero-btn rounded" onclick="window.location.href='profile-view.php'" style="width: 100px; margin-right: 20px;">
                    </div>
                    <div class="col">
                        <input type="button" value="Proceed to Proof of Payment" onclick="window.location.href='profile-gcash.php'" class="hero-btn rounded" style="background-color: green; width: 300px;" >
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