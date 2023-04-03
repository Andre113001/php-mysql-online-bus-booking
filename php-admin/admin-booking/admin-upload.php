<?php
include("../../connection.php");



$seats_chosen = $_COOKIE['seats_chosen']; 
$separate = explode(',', $seats_chosen); 
$bus_passengers = count($separate);
$totalFare = $_SESSION['bus_fare'] * $bus_passengers;
$defaultStatus = "PAID";
$passengers_name = $_SESSION['passengerNames'];

$booking_id = $_SESSION['booking_id'];
$date = $_SESSION['date'];
$customer_name = "WALK-IN";
$customer_contactnum = "WALK-IN";
$customer_email = "WALK-IN";
$customer_gender = "WALK-IN";
$bus_type = $_SESSION['bus_type'];
$bus_code = $_SESSION['bus_code'];
$bus_departure = $_SESSION['departure'];
$bus_departureTime = date("G:i", strtotime($_SESSION['bus_departureTime']));
$bus_arrival = $_SESSION['arrival'];
$bus_arrivalTime = date("G:i", strtotime($_SESSION['bus_arrivalTime']));
$booking_discountStatus = $_SESSION['discount_status'];
$reference_status = $_SESSION['reference_status'];
$time_added = date("Y-m-d H:i:s");

$sql = "INSERT INTO bus_booking (`booking_id`, `booking_date`, `booking_added` ,`booking_passengers`, `booking_busCode`, `booking_busType`, `booking_seatChosen`, `booking_seatFare`, `booking_customerName`, `booking_customerEmail`, `booking_customerContact`, `booking_gender`, `booking_departure`, `booking_departureTime`, `booking_arrival`, `booking_arrivalTime`, `booking_discountStatus` ,`booking_status`, booking_referenceStatus)
VALUES ('$booking_id', '$date', '$time_added' ,'$passengers_name' , '$bus_code', '$bus_type', '$seats_chosen', '$totalFare', '$customer_name', '$customer_email', '$customer_contactnum', '$customer_gender', '$bus_departure', '$bus_departureTime', '$bus_arrival', '$bus_arrivalTime', '$booking_discountStatus', '$defaultStatus', '$reference_status')";
$result = mysqli_query($conn, $sql) or die("Registration Failed!");

if ($result) {
    header("location: ../admin-bookrecord.php");
}
else
{
    echo ("An occur uploading your info");
}


?>