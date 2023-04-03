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
    $id = $_SESSION['booking-id'];
    if ($_SESSION['booking-status'] != 'PAID') {
        header('location: profile-cancel.php');
    }

    $getPassengers = mysqli_query($conn, "SELECT * FROM bus_booking WHERE booking_id = '$id'");
    $result = mysqli_fetch_assoc($getPassengers);
                                
    $arrayP = array();
    $arrayS = array();

    $arrayP = explode(',', $result['booking_passengers']);
    $arrayS = explode(',', $result['booking_seatChosen']);

    if (isset($_POST['submitBtn'])) {
        $checked = $_POST['passengers'];
        $checked_str = "";
        foreach ($checked as $check_values) {
            $checked_str .= $check_values.',';
        }
        $updateStatus = mysqli_query($conn, "UPDATE bus_booking SET booking_status = 'REFUND', booking_refund = '$checked_str' WHERE booking_id = '$id'");
        if ($updateStatus) {
            ?> 
            <script>
                alert("You have requested for refund for selected seats, kindly wait for your confirmation.");
                window.location.href='profile-view.php';
            </script>
            <?php
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

<div class="hero-image" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.pexels.com/photos/846350/pexels-photo-846350.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
    <section class="px-5">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col col-xl-5">
                <div class="card border-0" style="border-radius: 1rem;">
                    <div class='mb-3'>
                        <h3>Refund Ticket:</h3>
                        <h1><?php echo $_SESSION['booking-id'];?></h1>
                        <span>Select the passengers that are in need of refund</span>
                    </div>
                    <form action="#" method="post">
                        
                        <div class='form-check'>
                            <?php
                            
                            for ($i = 0; $i < sizeof($arrayS); $i++) {
                                ?> 
                                <input class="form-check-input" type="checkbox" name="passengers[]" value="<?php echo $arrayS[$i]. ':' .$arrayP[$i]?>">
                                <label class="form-check-label" for="passengers">Seat <?php echo $arrayS[$i] . ': ' . $arrayP[$i]?></label>
                                <br>
                                <?php
                            }

                            ?>
                        </div>
                        <input type="submit" class="hero-btn rounded mt-3" name='submitBtn'>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

</body>
</html>