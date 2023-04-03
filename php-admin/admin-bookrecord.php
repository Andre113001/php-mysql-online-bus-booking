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
else
{
  $sql = "SELECT * FROM bus_booking where booking_status = 'ON QUEUE' or booking_status = 'PENDING' order by booking_added DESC";
  $result = mysqli_query($conn, $sql) or die ("Data Retrieval Failed!");

  if (isset($_GET['viewUpload'])) {
    $_SESSION['ticket_id'] = $_GET['viewUpload'];
    header('location: admin-view.php');
  }

  if (isset($_GET['accept'])) {
    $booking_id = $_GET['accept'];
    $getValues = mysqli_query($conn, "SELECT * FROM bus_booking WHERE booking_id = '$booking_id'");

    $UpdateStatus = mysqli_query($conn, "UPDATE bus_booking SET booking_status = 'PAID' WHERE booking_id = '$booking_id'");
    echo "<script>
    alert('You have successfully accepted Ticket ID: ". $booking_id ."');
    window.location.href='admin-bookrecord.php';
    </script>";
  }

  // $UpdateStatus = mysqli_query($conn, "UPDATE bus_booking SET booking_status = 'PAID' WHERE booking_id = '". $booking_id ."'") .
  //                         "alert('You have successfully accepted Ticket ID: ". $booking_id ."');"
  if(isset($_GET['reject']))
  {
    $_SESSION['ticket_id'] = $_GET['reject'];
    header("location: admin-reject.php");
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
    <title>Admin Dashboard - Irosin Elavil Bus Reservation</title>

    <!-- Bootstrap - CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

    
</head>
<body style="zoom: 75%;">
  
  <!-- Header START -->
  <div class="row mb-3 mt-5">
      <div class="col-md-11">
          <a href="admin-dashboard.php" class="hero-btn rounded col-1 p-3 text-center float-end">Back</a>
      </div>
  </div>
  <!-- Header - END -->
  <h3 class="mx-5 display-1"><?php echo date("h:i A, Y-m-d")?></h3>
  <h3 class="mx-5">Customers' Booking Record</h3>
  <input type="button" class="mx-5 hero-btn rounded" value="+ Add Booking" onclick="location.href='admin-booking/admin-newBooking.php'">
  <div class="hero-middle m-5 vh-100">
      <div class="row">
          <div class="col-md-12 text-center">
              <a href="admin-cancellation.php"><button class="hero-btn rounded p-3" style="background-color: orange;">Cancellations</button></a>
              <a href="admin-refund.php"><button class="hero-btn rounded p-3" style="background-color: teal;">Refund Request</button></a>
              <a href="admin-onhold.php"><button class="hero-btn rounded p-3" style="background-color: purple;">On Hold</button></a>
              <a href="admin-paidPassenger.php"><button class="hero-btn rounded p-3" style="background-color: green;">Paid Passenger</button></a>
          </div>
      </div>
      <table class="table mt-4">
          <thead>
              <tr>
                  <th scope="col">Booking ID</th>
                  <th scope="col">Booking Date</th>
                  <th scope="col">Bus Code</th>
                  <th scope="col">Bus Type</th>
                  <th scope="col">Seat No.</th>
                  <th scope="col">Total Fare</th>
                  <th scope="col">User Name</th>
                  <th class="col-1">Passenger Names</th>
                  <th scope="col">PWD/Senior Citizen/Student</th>
                  <th scope="col">Status</th>
                  <th scope="col">Email</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Departure - Arrival</th>
                  <th scope="col">Departure Time</th>
                  <th scope="col">Arrival Time</th>
                  <th scope="col">Actions</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                <?php

                  if (mysqli_num_rows($result) > 0)
                  {
                    while ($row_member = mysqli_fetch_assoc($result))
                    {
                      ?> 
                      
                      <tr>
                        <td><?php echo $row_member['booking_id']; ?></td>
                        <td><?php echo $row_member['booking_date']; ?></td>
                        <td><?php echo $row_member['booking_busCode']; ?></td>
                        <td><?php echo $row_member['booking_busType']; ?></td>
                        <td><?php echo $row_member['booking_seatChosen']; ?></td>
                        <td><?php echo $row_member['booking_seatFare']; ?></td>
                        <td><?php echo $row_member['booking_customerName']; ?></td>
                        <td><?php echo $row_member['booking_passengers']; ?></td>
                        <td><?php echo $row_member['booking_discountStatus']; ?></td>
                        <td><?php echo $row_member['booking_status']; ?></td>
                        <td><?php echo $row_member['booking_customerEmail']; ?></td>
                        <td><?php echo $row_member['booking_gender']; ?></td>
                        <td><?php echo $row_member['booking_departure']. ' - ' . $row_member['booking_arrival']; ?></td>
                        <td><?php echo date('h:i A', strtotime($row_member['booking_departureTime'])); ?></td>
                        <td><?php echo date('h:i A', strtotime($row_member['booking_arrivalTime'])); ?></td>
                        <td>
                            <a href="admin-bookrecord.php?accept=<?php echo $row_member['booking_id'];?>"><input type="button" style="background-color: green;" class="hero-btn rounded m-1" value="Accept"></a>
                            <a href="admin-bookrecord.php?reject=<?php echo $row_member['booking_id'];?>"><input type="button" class="hero-btn rounded m-1" style="background-color: orange;" value="Reject"></a>
                            <a href="admin-bookrecord.php?viewUpload=<?php echo $row_member['booking_id'];?>"><input type="button" class="hero-btn rounded m-1" value="View"></a>
                        </td>
                      </tr>
                      <?php
                    }
                  }
                  else {
                    echo "<td><h1>No Booking Yet...</h1></td>";
                  }
                ?>
              </tr>
          </tbody>
      </table>
  </div>
</body>
</html>