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
  $discountedNames = array();
  $names = explode(",", $_SESSION['passengerNames']);
  $seats = explode(",", $_SESSION['seats_chosen']);
  $discountSeats = explode(",", $_SESSION['discountedSeats']);
  $passenger_names = $_SESSION['passengerNames'];
  
  for ($i = 0; $i < sizeof($seats); $i++) {
    for ($j = 0; $j < sizeof($discountSeats); $j++) {
      if ($seats[$i] == $discountSeats[$j]) {
        array_push($discountedNames, $names[$i]);
      }
    }
  }

  $d_names = implode(",", $discountedNames);

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_SESSION['customer_name'];
    $discount_category = $_POST['discount_type'];
    // $imageName = $_FILES['proof']['name'];
    $fileName = $_FILES['proof']['tmp_name'];
    $filePaths = array();
    $discount_categories = array();
    $i = 0;

    foreach ($_FILES['proof']['name'] as $imageName) {

      $fileName_temp = $_FILES['proof']['tmp_name'];
      $extension = pathinfo($imageName, PATHINFO_EXTENSION);
      $newName = $booking_id . '.' . $discountedNames[$i] . '.' . $i+1 . '.' . $extension;
      $filePath = '../uploads/valid_id/' . $newName;
      array_push($filePaths, $filePath);
      array_push($discount_categories, $discount_category[$i]);
      move_uploaded_file($fileName_temp[$i], $filePath);  
      $i += 1;
    }
    $filePaths = implode(",", $filePaths);
    $discount_categories = implode(",", $discount_categories);

    $sqlResult = mysqli_query($conn, "INSERT INTO  admin_queue_discount (`discount_ticketID`, `discount_passengerNames` , `discount_type`, `discount_upload`) 
                                      VALUES ('$booking_id', '$d_names' ,'$discount_categories', '$filePaths')");
    if ($sqlResult) {
    // $changeStatus = mysqli_query($conn, "UPDATE bus_booking WHERE booking_id = '$booking_id'");
    echo "<script> alert('Thank you for sending your proof of payment. We'll come back to you once it is processed') </script>";
    $_SESSION['discount_status'] = "PENDING";
    header("location: profile-upload.php");
    } else {
    echo "<script> alert('Upload Failed! Try again later') </script>";
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
            <div class="col col-xl-7">
              <div class="card" style="border-radius: 1rem;">
                <h1>Validation</h1>
                <p>Please upload your <span class="fw-bold">valid ID</span> to verify for you discount</p>
                <form role="form" method="post" enctype="multipart/form-data">
                    <?php
                      for ($i = 0; $i < sizeof($discountedNames); $i++)
                      {
                          ?> 
                          
                          <h4>Seat #<?php  echo $discountSeats[$i]. ": ". $discountedNames[$i] ?></h4>
                          <div class="row mb-4">
                            <div class="col">

                              <label class="form-control-label mr-1 fw-bold" for="proof">Upload Picture of Valid ID</label>
                              <input type="file" accept="image/*" class="form-control form-control-lg" name="proof[]" required/>
                              <div class="col-5 text-center d-flex ">
                                <select class="form-select form-select-md mt-2 rounded" name="discount_type[]">
                                    <option disabled selected>Select Category</option>
                                    <option value="Student">Student</option>
                                    <option value="Senior Citizen">Senior Citizen</option>
                                    <option value="PWD">PWD</option>
                                  </select>
                              </div>
                            </div>

                          </div>
                        
                          <?php
                      }

                ?> 

                  

                  <input type="button" class="hero-btn rounded" onclick="window.location.href='profile-info.php'" value="Cancel">
                  <input type="submit" value="Submit" class="hero-btn rounded" style="background-color: green;">
                </form>
                <!-- <input type="button" class="hero-btn rounded" onclick="window.location.href='profile-seats.php'" value="Back">
                <input type="submit" value="Proceed" class="hero-btn rounded" style="background-color: green;"> -->
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