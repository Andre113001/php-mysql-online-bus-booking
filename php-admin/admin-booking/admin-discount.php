<?php

include '../../connection.php';
if($_SESSION['username'] ==false)
{
    echo
    "<script>
            alert('You must log-in first...');
            window.location.href='../admin-index.php';
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

  // $displayNamesDiscount = implode(",", $discountedNames);

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_SESSION['customer_name'];
    $discount_category = $_POST['discount_type'];
    $discount_category = implode(",", $discount_category);
    $status = $_SESSION['discount_status'];

    $sqlResult = mysqli_query($conn, "INSERT INTO  admin_queue_discount (`discount_ticketID`, `discount_passengerNames` , `discount_type`, `discount_upload`, `discount_status`) 
                                      VALUES ('$booking_id', '$passenger_names' ,'$discount_category', 'WALK-IN', '$status')");
    if ($sqlResult) {
    // $changeStatus = mysqli_query($conn, "UPDATE bus_booking WHERE booking_id = '$booking_id'");
    echo "<script> alert('Thank you for sending your proof of payment. We'll come back to you once it is processed') </script>";
    $_SESSION['discount_status'] = "TRUE";
    header("location: admin-upload.php");
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
    <link rel="icon" href="../../assets/img/icon-bus.png">
    <title>Irosin Elavil Bus Reservation</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script type="text/javascript" src="/assets/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    
    <!-- CSS -->
    <link rel="stylesheet" href="../../css/style.css">

    
</head>
<body>

<!-- Header START -->
<div class="row mb-3 mt-5">
  <div class="col-md-11">
      <a href="admin-info.php" class="hero-btn rounded col-1 p-3 text-center float-end">Back</a>
  </div>
</div>
<!-- Header - END -->

<section    >
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

                            <label class="form-control-label mr-1 fw-bold" for="proof">Valid ID</label>
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

                
            <input type="submit" value="Submit" class="hero-btn rounded" style="background-color: green;">
            </form>
            <!-- <input type="button" class="hero-btn rounded" onclick="window.location.href='profile-seats.php'" value="Back">
            <input type="submit" value="Proceed" class="hero-btn rounded" style="background-color: green;"> -->
            </div>
        </div>
        </div>
    </div>
</section>
</body>
</html>