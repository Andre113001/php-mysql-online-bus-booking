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

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $imageName = $_FILES['proof']['name'];
    $name = $_SESSION['customer_name'];


    // image processing and change of directory
    $extension = pathinfo($imageName, PATHINFO_EXTENSION);
    $newName = $booking_id . '.' . $extension;

    $fileName = $_FILES['proof']['tmp_name'];
    $filePath = '../uploads/gcash_proof/' . $newName;
    $defaultStatus = "TRUE";
    $referenceNum = $_POST['reference'];

    if (move_uploaded_file($fileName, $filePath)) {
      $sqlResult = mysqli_query($conn, "INSERT INTO  admin_queue_gcash (`gcash_ticketID`, `gcash_proof`, `gcash_reference`) 
                                        VALUES ('$booking_id','$filePath', '$referenceNum')");
      $sqlUpdate = mysqli_query($conn, "UPDATE bus_booking SET booking_referenceStatus = 'TRUE', booking_status = 'PENDING' where booking_id = '$booking_id'");
      if ($sqlResult) {
        // $changeStatus = mysqli_query($conn, "UPDATE bus_booking WHERE booking_id = '$booking_id'");
        echo "<script> alert('Thank you for sending your proof of payment. We'll come back to you once it is processed') </script>";
        header("location: profile-view.php");
      }
      else {
        echo "<script> alert('Upload Failed! Try again later') </script>";
      }
    }
    else {
      echo "<script> alert('Image Upload Failed! Try again later') </script>";
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
                <h1>Upload Proof of Payment</h1>
                <p>Kindly upload your screenshot proof of payment and enter the reference number </p>
                <form role="form" method="post" enctype="multipart/form-data" oninput='con_reference.setCustomValidity(con_reference.value != reference.value ? "Reference Number Does Not Match." : "")'>

                  <div class="row mb-4">
                    <div class="col-5">
                      <label class="form-control-label mr-1 fw-bold" for="proof">Upload Screenshot Proof of Payment</label>
                      <input type="file" accept="image/*" class="form-control form-control-lg" name="proof" required/>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col">
                      <label class="form-control-label mr-1 fw-bold" for="reference">Reference Number</label>
                      <input type="text" class="form-control form-control-lg" autocomplete="off" name="reference" required/>
                    </div>
                    <div class="col">
                      <label class="form-control-label mr-1 fw-bold" for="con_proof">Confirm Reference Number</label>
                      <input type="text" class="form-control form-control-lg" autocomplete="off" name="con_reference" required/>
                    </div>
                  </div>
                  <div class="row">
                    <input type="button" value="Cancel" class="hero-btn rounded" onclick="window.location.href='profile-pay.php'" style="width: 150px; margin-right: 20px;">
                    <input type="submit" value="Submit" class="hero-btn rounded" style="width: 150px; background-color: green;">
                  </div>

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