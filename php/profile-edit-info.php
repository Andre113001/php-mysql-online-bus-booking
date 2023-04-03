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
    $seats = implode(",", $seats_chosen);
    $_SESSION['seats_chosen'] = $seats;
    $id = $_SESSION['id'];
    $getBus = mysqli_query($conn, "SELECT * FROM bus_booking WHERE booking_id = '$id'");
    $fetchBus = mysqli_fetch_assoc($getBus);
    $bus_code = $fetchBus['booking_busCode'];
    $getFare = mysqli_query($conn, "SELECT * FROM bus_details WHERE bus_code = '$bus_code'");
    $fetchFare = mysqli_fetch_assoc($getFare);

    $fare = $fetchFare['bus_fare'];

    $valueArray = array();
    $passengerNames = array();
    $passengerDiscount = array();
    $discountedNames = array();
    $totalFare = 0;

    $_SESSION['total_fare'] = $totalFare;

    $stringNames = implode(",", $passengerNames);
    $_SESSION['passengerNames'] = $stringNames;

    $status = $_SESSION['status'];
    
    $mysql = mysqli_query($conn, "UPDATE bus_booking SET booking_seatChosen = '$seats' WHERE booking_id = '$id'");
    if ($mysql) {
        ?> 
        
        <script>
            alert("You have updated booking ticket: <?php echo $id; ?>")
            window.location.href="profile-view.php";
        </script>
        
        <?php
    }
}

?>