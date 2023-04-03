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
else {
    $sql = "SELECT * FROM bus_booking where booking_status = 'REJECTED'";
    $result = mysqli_query($conn, $sql) or die("Data Retrieval Failed.");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/icon-bus.png">
    <title>Admin - On-Hold Passengers</title>

    <!-- Bootstrap - CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <div class="container">
        <!-- Header START -->
        <div class="row mb-3 mt-5">
            <div class="col">
                <a href="admin-bookrecord.php" class="hero-btn rounded float-end">Back</a>
            </div>
        </div>
        <!-- Header - END -->
    </div>

    <div class="container">
        <h3>On-Hold / Rejected Bookings</h3>
        <div class="hero-middle vh-100">
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">Booking ID</th>
                        <th scope="col">Seat #</th>
                        <th scope="col">Bus Code</th>
                        <th scope="col">Passenger Names</th>
                        <th scope="col">Total Fare</th>
                        <th scope="col">Bus Type</th>
                        <th scope="col">Customer Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Reason(s)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                        if (mysqli_num_rows($result) > 0)
                        {
                            while ($row_member = mysqli_fetch_assoc($result)) {
                            echo   
                                "<tr>
                                    <td>" . $row_member['booking_id']  ."</td>" .
                                    "<td>" . $row_member['booking_seatChosen']  ."</td>" .
                                    "<td>" . $row_member['booking_busCode']  ."</td>" .
                                    "<td>" . $row_member['booking_passengers']  ."</td>" .
                                    "<td>" . $row_member['booking_seatFare']  ."</td>" .
                                    "<td>" . $row_member['booking_busType']  ."</td>" .
                                    "<td>" . $row_member['booking_customerName']  ."</td>" .
                                    "<td>" . $row_member['booking_customerEmail']  ."</td>" .
                                    "<td>" . $row_member['booking_customerContact']  ."</td>" .
                                    "<td>" . $row_member['booking_rejectReason']  ."</td>" .
                                "</tr>";
                            }
                        }
                        else {
                            ?>
                            
                            <h1>Bookings are ON QUEUE / PAID...</h1>
                            
                            <?php
                        }
                    
                    ?>
                </tbody>
            </table>
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