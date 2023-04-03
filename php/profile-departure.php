<?php

include '../connection.php';
if($_SESSION['customer_id'] ==false)
{
    echo
    "<script>
            alert('You must log-in first...');
            window.location.href='../admin-index.php';
    </script>";
}
else 
{
  $sql = "SELECT * FROM bus_details order by bus_id";
  $result = mysqli_query($conn, $sql) or die("Data Retrieval Failed.");
  
  
  if (isset($_GET['ticketId'])) {
    $bus_id = $_GET['ticketId'];
    $getValues = mysqli_query($conn, "SELECT * FROM bus_details WHERE bus_id = '$bus_id'"); 
    $newValues = mysqli_fetch_array($getValues);

    $_SESSION['bus_id'] = $newValues['bus_id'];
    $_SESSION['bus_code'] = $newValues['bus_code'];
    $_SESSION['bus_type'] = $newValues['bus_type'];
    $_SESSION['bus_departureTime'] = date('h:i A', strtotime($newValues['bus_departureTime']));
    $_SESSION['bus_arrivalTime'] = date('h:i A', strtotime($newValues['bus_arrivalTime']));
    $_SESSION['bus_seats'] = $newValues['bus_seats'];
    $_SESSION['bus_fare'] = $newValues['bus_fare'];

    header('location: profile-seats.php');
    die();
  }


  // convert to session date to determine available busses
  $timestamp = strtotime($_SESSION['date']);
  $day = date('l', $timestamp);

  $booking_date = $_SESSION['date'];
  $booking_values = mysqli_query($conn ,"SELECT * FROM bus_booking");
  $booking_array = mysqli_fetch_assoc($booking_values);

  // $bus_code = $booking_array['booking_busCode'];

  // $getSeats = mysqli_query($conn, "SELECT * FROM bus_booking where booking_date = '$booking_date' and booking_busCode = '$bus_code'");
  // $i = 0;
  // $reserved = array();

  // while($seats = mysqli_fetch_assoc($getSeats)) {
  //   $reserved[$i] = $seats['booking_seatChosen'];
  //   $i += 1;
  // }

  // $reservedNew = implode(",", $reserved);
  // $reserved = explode(",", $reservedNew);
  
  // echo "<script>console.log('" . sizeof($reserved) . "')</script>";

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
                <h1 class="mb-5">Available Departure Time</h1>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Departure Date</th>
                        <th scope="col">Bus Code</th>
                        <th scope="col">Type</th>
                        <th scope="col">Departure</th>
                        <th scope="col">Departure Time</th>
                        <th scope="col">Arrival</th>
                        <th scope="col">Arrival Time</th>
                        <th scope="col">Available Seats</th>
                        <th scope="col">Fare (per seat)</th>
                      </tr>
                    </thead>
                    <tbody role="form" method="post">
                      <?php 
                    
                      
                      if (mysqli_num_rows($result) > 0)
                      {
                          while ($row_member = mysqli_fetch_assoc($result)) {
                            $bus_arrival = $_SESSION['arrival'];
                            $bus_code = $row_member['bus_code'];
                            $booking_date = $_SESSION['date'];

                            $getSeats = mysqli_query($conn, "SELECT * FROM bus_booking WHERE booking_busCode = '$bus_code' and booking_date = '$booking_date'");                            
                            $i = 0;
                            $seats = array();

                            while ($fetch_seats = mysqli_fetch_assoc($getSeats)){
                              $seats[$i] = $fetch_seats['booking_seatChosen'];

                              $i += 1;
                            }

                            $seats_avail = implode(",", $seats);
                            $seatsAvail = explode(",", $seats_avail);

                            if (strlen($seats_avail) > 0) {
                              $seats_pass = $row_member['bus_seats'] - sizeof($seatsAvail);
                            }
                            else {
                              $seats_pass = $row_member['bus_seats'];
                            }


                            if ($day == $row_member['bus_schedule']  &&  $row_member['bus_arrival'] == $_SESSION['arrival'])
                            {
                              echo   
                                  "<tr>".
                                      "<td>" . $_SESSION['date']  ."</td>" .
                                      "<td>" . $row_member['bus_code']  ."</td>" .
                                      "<td>" . $row_member['bus_type']  ."</td>" .
                                      "<td>" . $_SESSION['departure']  ."</td>" .
                                      "<td>" . date('h:i A', strtotime($row_member['bus_departureTime']))  ."</td>" .
                                      "<td>" . $_SESSION['arrival']  ."</td>" .
                                      "<td>" . date('h:i A', strtotime($row_member['bus_arrivalTime'])) ."</td>" .
                                      "<td>" . $seats_pass . "</td>" .
                                      "<td>" . "PHP ". $row_member['bus_fare']  ."</td>" .
                                      "<td>" 
                                          ?> 
                                          <?php
                                            // if (strlen($seats_avail) > 0) {
                                            //   $disabled = "disabled";
                                            //   $color = "grey";
                                            //   $warning = "";
                                            //   $warning_text = "You have already booked in this bus";
                                            // } else {
                                            //   $disabled = "";
                                            //   $color = "#00b3d7";
                                            //   $warning = "hidden";
                                            //   $warning_text = "";
                                            // }
                                          
                                          ?>
                                          <form action="" method="post">
                                            <a href="profile-departure.php?ticketId=<?php echo $row_member['bus_id'] ?>"><input type="button" style="background-color: <?php echo $color = "#00b3d7";?>" value="Select" name="bus_chosen" <?php echo $disabled = ""; ?> id="bus_chosen" class="hero-btn rounded"></a>
                                            <!-- <br><label <?php echo $warning; ?> for="bus_chosen"><?php echo $warning_text; ?></label> -->
                                          </form>
                                          <?php
                                      "</td> .
                                  </tr>";
                            }
                            
                          }
                        }

                        

                      
                      ?>
                    </tbody>
                    
                  </table>
                  
                  <button class="hero-btn rounded text-center" style="width: 10%;" onclick="window.location.href='profile-new.php'">Back</button>

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