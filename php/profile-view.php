<?php 

include "../connection.php";

if($_SESSION['customer_id'] ==false) {
  echo
  "<script>
          alert('You must log-in first...');
          window.location.href='landing-index.php';
  </script>";
}
else
{
  unset($_SESSION['label']);
  $booking_customerName = $_SESSION['customer_name'];
  $sql = "SELECT * FROM bus_booking WHERE booking_customerName = '$booking_customerName' order by booking_added DESC";
  $result = mysqli_query($conn, $sql) or die("Data Retrieval Failed.");

  if (isset($_GET['fare'])) {
    $separate = explode(",", $_GET['fare']);
    $_SESSION['total_fare'] = $separate[0];
    $_SESSION['booking_id'] = $separate[1];
    $_SESSION['booking_date'] = $separate[2];
    $_SESSION['booking_customerName'] = $separate[3];
    header('location: profile-pay.php');
  }

  if (isset($_GET['view_ticket'])) {
    $_SESSION['booking_id'] = $_GET['view_ticket'];
    header("location: profile-ticket.php");
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
<header id="header" class="header">
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


<section class="px-5 vh-100">
      <div class="row vh-100">
        <div class="col col-xl-15">
          <div class="card border-0" style="border-radius: 1rem;">
            <h1 class="mb-5">Your Booking Record</h1>
            <table class="table">
              
                <thead>
                  <?php
                  
                  if (mysqli_num_rows($result) > 0)
                  {
                  
                  ?>
                  <tr>
                    <th>Booking ID</th>
                    <th>Booking Added</th>
                    <th>Departure Date</th>
                    <th>Bus Code</th>
                    <th>Seat #</th>
                    <th>Route</th>
                    <th>Departure - Arrival</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        switch ($row['booking_status']) {
                          case 'PAID':
                            if ($row['booking_date'] <= date("Y-m-d")) {
                              $print_active ="";
                              $reference_status = "hidden";
  
                              $cancel_visible = "hidden";
                              
                              $refundstatus = "hidden";
  
                              $edit_active = "hidden";
                            } else {
                              $print_active = "";
                              $reference_status = "hidden";
                              $edit_active = "";
                              $cancel_visible = "";
                              $change_label = 'Update Seat';
                              $refundstatus = "";
                              $cancel_label = 'Refund';
                            }
                            break;
                          case 'PENDING':
                            $print_active = "hidden";
                            $reference_status = "hidden";
                            $edit_active = "hidden";
                            $cancel_visible = "";
                            $cancel_label = 'Cancel';
                            $refundstatus = "hidden";
                            break;
                          case 'REJECTED':
                            $print_active = "hidden";

                            $reference_status = "hidden";

                            $cancel_visible = "hidden";
                            
                            $refundstatus = "hidden";

                            $edit_active = "hidden";
                            break;
                          case 'REQUEST FOR REFUND':
                            $print_active = "hidden";

                            $reference_status = "hidden";
                    
                            $refundstatus = "hidden";
                            $cancel_visible = "hidden";

                            $edit_active = "hidden";
                            break;
                          case 'REFUND':
                            $print_active = "hidden";

                            $reference_status = "hidden";
                    
                            $refundstatus = "hidden";
                            $cancel_visible = "hidden";

                            $edit_active = "hidden";
                            break;
                          case 'APPROVED REFUND':
                            $print_active = "hidden";

                            $reference_status = "hidden";

                            $refundstatus = "hidden";
                            $cancel_visible = "";

                            $edit_active = "hidden";
                            break;
                          default:
                            if ($row['booking_date'] <= date("Y-m-d")) {
                              $print_active = "hidden";
                              $reference_status = "hidden";
                              $disabled_cancel = "hidden";
                              $change_label = 'Change Seat';
                              $refundstatus = "hidden";
                              $cancel_label = 'Cancel';
                              $cancel_visible = "hidden";
                              $edit_active = "hidden";
                            } else {
                              $print_active = "hidden";
                              $reference_status = "";
                              $disabled_cancel = "";
                              $change_label = 'Change Seat';
                              $refundstatus = "hidden";
                              $cancel_label = 'Cancel';
                              $cancel_visible = "";
                              $edit_active = "";
                            }
                            
                            break;
                        }

                        if ($row['booking_discountStatus'] == "PENDING") {
                          $reference_status = "hidden";
                        }

                        
                        if (isset($_GET['cancel'])) {
                          $getValues = array();
                          $getValues = explode(",", $_GET['cancel']);

                          $_SESSION['booking-id'] = $getValues[0];
                          $_SESSION['booking-status'] = $getValues[1];
                          
                          header("location: profile-refundSelect.php");
                        }
                      
                        

                        ?>
                          <tr>
                            <th><?php echo $row['booking_id'];?></th>
                            <?php 
                              $booking_id = $row['booking_id'];
                              $date_before = date("Y-m-d", strtotime($row['booking_date']."- 24 hours"));
                              $get_discount = mysqli_query($conn, "SELECT * FROM admin_queue_discount WHERE discount_ticketID = '$booking_id' and discount_status = 'FALSE'");
                              $fetch_discount = mysqli_fetch_assoc($get_discount);
                            ?>
                            <td> <?php echo date("Y-m-d ; G:i", strtotime($row['booking_added'])) ;?> </td>
                            <td> <?php echo $row['booking_date'] ;?> </td>
                            <td> <?php echo $row['booking_busCode'] ;?> </td>
                            <td> <?php echo $row['booking_seatChosen'] ;?> </td>
                            <td> <?php echo $row['booking_departure'] . ' - ' . $row['booking_arrival'] ;?>  </td>
                            <td><?php echo date('h:i A', strtotime($row['booking_departureTime'])) . ' - ' . date('h:i A', strtotime($row['booking_arrivalTime'])) ;?></td>
                            <td> <?php echo $row['booking_status'] ;?> </td>
                            <td>
                              <!-- View Ticket Button -->
                              <a href="profile-view.php?view_ticket=<?php echo $row['booking_id'] ?>"><button  style="background-color: #00d4ff;"  <?php echo $print_active;?> class="hero-btn rounded">Print</button></a>

                              <!-- REFERENCE button -->
                              <button <?php echo $reference_status; ?> onclick="window.location.href='profile-view.php?fare=<?php echo $row['booking_seatFare'] . ',' . $row['booking_id'] . ',' . $row['booking_date'] . ',' . $row['booking_customerName'];?>'" class="hero-btn rounded"  style="background-color: green;">Pay Now</button>
                              
                              <!-- Change Seat Button -->
                              <input onclick="window.location.href='profile-edit.php?ticketID=<?php echo $row['booking_id']; ?>'" type="button" style="background-color: purple;" <?php echo $edit_active;?> class="hero-btn rounded" value="<?php echo $change_label; ?>">
                              
                              <!-- Cancel button -->
                              <input type="button" value='<?php echo $cancel_label;?>' <?php echo $cancel_visible;?> class="hero-btn rounded" style='background-color: red;' onclick="window.location.href='profile-view.php?cancel=<?php echo $row['booking_id']. ',' . $row['booking_status']; ?>'">
                            </td>
                          </tr>
                        <?php
                      }
                    }
                    else {
                      ?>
                        <h2>You haven't book yet...</h2>
                      <?php
                    }
                  
                  ?>
                </tbody>
                
              </table>

              <h6>Keep Note:</h6>
              <li>Payment is refundable except 24hrs before departure</li>
              <li>Booking can be cancelled anytime except 24hrs before your departure.</li>
              <li>You should come to the terminal 1 hour before the departure time.</li>
              <li>If you are not at the terminal 30 minutes before the departure time, they will put someone else in your slot</li>
          </div>
        </div>
      </div>
  </section>
</body>
</html>