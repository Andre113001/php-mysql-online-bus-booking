<?php

include '../connection.php';

if($_SESSION['customer_id'] ==false)
{
    echo
    "<script>
            alert('You must log-in first...');
            window.location.href='landing-index.php';
    </script>";
}
else {
    unset($_SESSION['bus_fare'], $_COOKIE['seats_chosen'], $_SESSION['seats_chosen'], $_SESSION['booking_id'], $_SESSION['date'], $_SESSION['bus_type']);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
         $date = date("Y-m-d");
        // Initialize for feedback
        $customer_id = $_SESSION['customer_id'];
        $customer_name = $_SESSION['customer_name'];
        $feedback_text = $_POST['feedback_text'];

        //single quote error fix
        $feedback_text = str_replace("'", "\'", $feedback_text);

        // upload to customer_feedback table
        $sql = "INSERT INTO customer_feedback (customer_id, customer_name, feedback_text, feedback_date) VALUES ('$customer_id', '$customer_name', '$feedback_text', '$date');";
        $result = mysqli_query($conn, $sql);


        if ($result) {
            echo 
            "<script>
                alert('Thank you for your feedback!');
            </script>";
        }
        else {
            echo 
            "<script>
                alert('Feedback error! please try again later...');
            </script>";
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
    <title>Welcome, <?php echo $_SESSION['customer_name']; ?> | Irosin Elavil Bus Reservation</title>

    <!-- Bootstrap - CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

<!-- ======= Hero Section ======= -->
<div class="hero-image" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.pexels.com/photos/846350/pexels-photo-846350.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="row h-100 d-flex justify-content-center align-items-center ">
            <div class="col  hero-text-profile px-5">
                <h4 style="color: white;">Welcome, <span style="color:#2acde4;"> <?php echo $_SESSION['customer_name'] ?> </span></h4>
                <h1>EXPLORE THE BAYAN OF IROSIN WITH <span style="color: #2acde4; font-weight: bold;">ELAVIL.</span></h1>
                <p>Enjoy the fastest and safest bus in bicol.</p>
            </div>

            <div class="col  hero-text-profile m-3">
                <div class="row m-3">
                    <div class="col ">
                        <img class="img-fluid h-100" src="https://jontotheworld.com/wp-content/uploads/2017/07/irosin2.jpg" alt="">
                    </div>
                    <div class="col">
                        <img class="img-fluid w-100 h-100 img-responsive" src="http://armageddonviews.weebly.com/uploads/1/3/4/5/13458457/1840926_orig.jpg" alt="" style="object-fit: cover;">                    </div>
                </div>
                <div class="row m-3">
                    <div class="col ">
                        <img class="img-fluid img-responsive h-100" src="https://www.vigattintourism.com/assets/article_main_photos/optimize/1349773122bZHXZzWJ.jpg" alt="" srcset="">
                    </div>
                    <div class="col ">
                        <img class="img-fluid img-responsive h-100" src="https://www.sorsogon.gov.ph/wp-content/uploads/2019/10/Valley-View-Park.png" alt="">
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
  <!-- Hero Section - END -->

  <div class="form-feedback m-5">
    <h2 class="display-6">GIVE US YOUR FEEDBACK</h2>
    <form class="container" role="form" method="post" enctype="multipart/form-data">
        <div class="mb-3">
        <textarea class="form-control" placeholder="Leave your feedback here" name="feedback_text" id="feedback_text" style="resize: none; height: 10em;"></textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary hero-btn">Submit</button>
        </div>
        
    </form>
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