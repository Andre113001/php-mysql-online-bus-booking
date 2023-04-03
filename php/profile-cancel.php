<?php 

include "../connection.php";

if($_SESSION['customer_id'] == false && $_SESSION['booking_id'] == false) {
  echo
  "<script>
          alert('You must log-in first...');
          window.location.href='landing-index.php';
  </script>";
}
else
{

  unset($_COOKIE['seats_chosen']);
  
  function deleteListing(&$id)
  {
    include "../connection.php";
    $DeleteTicket = mysqli_query($conn, "DELETE FROM bus_booking where booking_id = '$id'");
    header("location: profile-view.php");
  }

  $booking_id = $_SESSION['booking-id'];
  $getValues = mysqli_query($conn, "SELECT * FROM bus_booking WHERE booking_id = '$booking_id'");
  $result = mysqli_fetch_assoc($getValues);
  $bus_code = $result['booking_busCode'];
  $departure = $result['booking_departure'];

  $name = $_SESSION['customer_name'];


  if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $reason = $_POST['radio_reasons'];

    if (!empty($_POST['radio_reasons'])) {
      if ($reason == 'Request for refund') {
        $changeStatus = mysqli_query($conn, "UPDATE bus_booking SET booking_status = 'REQUEST FOR REFUND', booking_refund = 'WHOLE TICKET' WHERE booking_id = '$booking_id'");
        header("location: profile-view.php");
      }
      else {
        $sqlupload = mysqli_query($conn, "INSERT INTO customer_cancellation (`cancel_ticketID`, `cancel_busCode`, `cancel_busDeparture`, `cancel_customerName`, `cancel_reason`) VALUES ('$booking_id','$bus_code', '$departure', '$name', '$reason')");
        deleteListing($booking_id);
      }
    }
    else {
      echo "<script>alert('Please state your reason')</script>";
    }

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
    <section class="vh-100 px-5">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-7">
              <div class="card" style="border-radius: 1rem;">
                <h1>Cancel your booking</h1>
                <label class="mb-4">Kindly state your reason for cancellation:</label>
                <form role="form" method="post" class="mt-3" enctype="multipart/form-data">

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" value="Change my mind." name="radio_reasons">
                        <label class="form-check-label" for="radio_reasons">
                            Change my mind.
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" value="Due to unexpected reason/s." name="radio_reasons">
                        <label class="form-check-label" for="radio_reasons">
                            Due to unexpected reason/s.
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" value="Change Booking Date" name="radio_reasons">
                        <label class="form-check-label" for="radio_reasons">
                            Change Booking Date
                        </label>
                    </div>
                    
                    <!-- <div class="form-check mb-2">
                        <label class="form-check-label" for="radio_reasons">
                            Others:
                        </label>
                        <textarea class="form-control" placeholder="State your reason/s here" name="radio_reasons_others" id="radio_reasons_others" style="resize: none; height: 10em;"></textarea>
                    </div> -->
                    
                <input type="button" class="hero-btn rounded mt-5" value="Back" onclick="window.location.href='profile-view.php'">
                <input type="submit" class="hero-btn rounded mt-5" value="Submit">
                </form>
                
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