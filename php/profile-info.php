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
    $seats_chosen = explode(",", $_COOKIE['seats_chosen']);
    $_SESSION['seats_chosen'] = implode(",", $seats_chosen);
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $valueArray = array();
        $passengerNames = array();
        $passengerDiscount = array();
        $discountedNames = array();

        foreach($_POST['passengerName'] as $names ) {
            array_push($passengerNames, $names);
        }

        $stringNames = implode(",", $passengerNames);
        $_SESSION['passengerNames'] = $stringNames;

        if (!empty($_POST['checkDiscount'])) { // if one are checked

            foreach ($_POST['checkDiscount'] as $value) {
                array_push($passengerDiscount, $value);
            }

            $valueString = implode(",", $passengerDiscount);
            $_SESSION['discountedSeats'] = $valueString;

            $_SESSION['reference_status'] = "FALSE";
            header("location: profile-discount.php");
        }
        else { // if none checked
            $_SESSION['discount_status'] = "FALSE";
            $_SESSION['reference_status'] = "TRUE";
            header("location: profile-upload.php");
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
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-15">
              <div class="card" style="border-radius: 1rem;">
                <h1>Passenger Info</h1>
                <p>Kindly fill in the form.</p>
                <form role="form" method="post" enctype="multipart/form-data">
                <?php
                
                for ($i = 0; $i < sizeof($seats_chosen); $i++) {
                    ?> 
                        <div class="row mb-4 ">
                            <div class="col-1 d-flex align-items-center">
                                <span class="fw-bold">Seat # <?php echo $seats_chosen[$i];?> :</span>
                            </div>
                            <div class="col-5 d-flex align-items-center">
                                <input type="text" class="form-control form-control-lg" name="passengerName[]" placeholder="Enter name here..." required/>       
                            </div>
                            <div class="col-3 d-flex align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="checkDiscount[]" value="<?php echo $seats_chosen[$i];?>" id="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <span style="color: red;">*</span>Check here if you are a Senior Citizen/Student/PWD.
                                    </label>
                                </div>
                            </div>
                        </div>

                    
                    
                    <?php
                }
                
                ?>
                
                    <input type="button" class="hero-btn rounded" onclick="window.location.href='profile-seats.php'" value="Back">
                    <input type="submit" value="Submit" class="hero-btn rounded" style="background-color: green;">
                </form>
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