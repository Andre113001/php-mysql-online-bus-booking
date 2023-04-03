<?php
include '../connection.php';
use PHPMailer\PHPMailer\PHPMailer;

require '../phpmailer/vendor/autoload.php';

function deleteListing(&$id)
{
    include "../connection.php";
    ?> 
        <script>
            alert("You have approved booking <?php echo $action;?> for refund");
        </script>
    <?php
    unset($_GET['approve'], $_GET['disapprove']);
    $DeleteTicket = mysqli_query($conn, "DELETE FROM bus_booking where booking_id = '$id'");
    header('location: admin-refund.php');
}

if($_SESSION['username'] ==false)
{
    echo
    "<script>
            alert('You must log-in first...');
            window.location.href='admin-index.php';
    </script>";
}
else {
    $sql = "SELECT * FROM bus_booking where booking_status = 'REFUND' order by booking_added";
    $result = mysqli_query($conn, $sql) or die("Data Retrieval Failed.");

    if (isset($_GET['approve'])) {
        $get = explode(',', $_GET['approve']);
        $booking_id = $get[0];
        $newPrice = $get[1];

        $query = mysqli_query($conn, "SELECT * FROM bus_booking WHERE booking_id = '$booking_id'");
        $fetch = mysqli_fetch_assoc($query);
        
        $arrayV = explode(",", $fetch['booking_refund']);
        $get_arrayV = array();

        $arrayP = array();
        $arrayS = array();
        $i = 0;

        foreach ($arrayV as $v) {
            if ($i < sizeof($arrayV)-1) {
                $get_arrayV = explode(":", $v);
                array_push($arrayP, $get_arrayV[1]);
                array_push($arrayS, $get_arrayV[0]);
                $i += 1;
            }
        }

        $R_names = implode(",", $arrayP);
        $R_seats = implode(',', $arrayS);

        $passenger_names = array();
        $passenger_seats = array();

        $passenger_names = explode(',', $fetch['booking_passengers']);
        $passenger_seats = explode(',', $fetch['booking_seatChosen']);

        $leftName = array();
        $leftSeat = array();

        foreach ($passenger_names as $passenger) {
            if(!in_array($passenger, $arrayP)) {
                array_push($leftName, $passenger);
            }
        }

        foreach ($passenger_seats as $seats) {
            if (!in_array($seats, $arrayS)) {
                array_push($leftSeat, $seats);
            }
        }   

        $leftName = implode(',', $leftName);
        $arrayS = implode(',', $arrayS);
        $arrayP = implode(',', $arrayP);

        $leftSeat = implode(',', $leftSeat);

        $body_content = "<h3>Hi, ". $fetch['booking_customerName'] ."</h3>
        <b>Passengers from your booking id (". $booking_id .") has been approved for refund<br>
        These passenger/s include:<br>" . $arrayP . 
        " from seat # ". $arrayS ." respectively<br><br>Kindly wait for your a your notification on your Gcash account,<br> 
        <p>Sincerely yours <br> Irosin Elavil PH</p>";

        if ($leftSeat == '') {
            $delete_status = 1;
        } else {
            $delete_status = 0;
        }

        $booking_detail = mysqli_query($conn, "SELECT * FROM bus_booking where booking_id = '$booking_id'");
        $bookingResult = mysqli_fetch_assoc($booking_detail);
        
        $bus_code = $bookingResult['booking_busCode'];
        $bus_departure = $bookingResult['booking_departure'];
        $customer_name = $bookingResult['booking_customerName'];
        $customerEmail = $bookingResult['booking_customerEmail'];

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'irosin.elavil@gmail.com';
        $mail->Password = 'rxadqpgekgylwfnl';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        if ($delete_status == 1) {
            deleteListing($booking_id);
        } else {
            $changeStatus = mysqli_query($conn, "UPDATE bus_booking SET booking_status = 'PAID', booking_seatFare = '$newPrice', booking_refund = '', booking_seatChosen = '$leftSeat', booking_passengers = '$leftName'  WHERE booking_id = '$booking_id'");
        }
        
        $insert_cancel = mysqli_query($conn, "INSERT INTO customer_cancellation (cancel_ticketID, cancel_busCode, cancel_busDeparture, cancel_customerName, cancel_reason) VALUES ('$booking_id', '$bus_code', '$bus_departure', '$customer_name', 'Refund')");
            
        $mail->setFrom('irosin.elavil@gmail.com', 'IROSIN ELAVIL PH');
        $mail->addAddress($customerEmail);
        $mail->isHTML(true);
        $mail->Subject = "Request for Refund";
        $mail->Body = $body_content;
        if ($mail->send()) {
            header("location: admin-refund.php");
        }
    }

    if (isset($_GET['disapprove'])) {
        $booking_id = $_GET['disapprove'];

        $booking_detail = mysqli_query($conn, "SELECT * FROM bus_booking where booking_id = '$booking_id'");
        $bookingResult = mysqli_fetch_assoc($booking_detail);
        
        $bus_code = $bookingResult['booking_busCode'];
        $bus_departure = $bookingResult['booking_departure'];
        $customer_name = $bookingResult['booking_customerName'];
        $customerEmail = $bookingResult['booking_customerEmail'];

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'irosin.elavil@gmail.com';
        $mail->Password = 'rxadqpgekgylwfnl';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';


        $changeStatus = mysqli_query($conn, "UPDATE bus_booking SET booking_status = 'PAID' WHERE booking_id = '$booking_id'");

        if ($changeStatus) {
            $mail->setFrom('irosin.elavil@gmail.com', 'IROSIN ELAVIL PH');
            $mail->addAddress($customerEmail);
            $mail->isHTML(true);
            $mail->Subject = "Request for Refund";
            $mail->Body =
            "<h3>Hi, ". $customer_name ."</h3>
                <b>Your booking ticket ". $_SESSION['ticket_id'] ." has NOT approved for refund<br>" . 
                " <br><br>This is due to no proof of payment sent by you.<br> 
                <p>Sincerely yours <br> Irosin Elavil PH</p>";
            if ($mail->send()) {
                header("location: admin-bookrecord.php");
            }
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
    <title>Admin - Refund Request</title>

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
        <h3>Refund Requests</h3>
        <div class="hero-middle vh-100">
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">Booking ID</th>
                        <th scope="col">Total REFUND Amount</th>
                        <th scope="col">Discounted Name(s)</th>
                        <th scope="col">Reference Number</th>
                        <th scope="col">Seat Number ; Name of Passenger</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                        if (mysqli_num_rows($result) > 0)
                        {                               
                            while ($fetchResult = mysqli_fetch_assoc($result)) {
                                $id = $fetchResult['booking_id'];
                                $discount_status = $fetchResult['booking_discountStatus'];
                                $passengers = $fetchResult['booking_passengers'];
                                $passengers_array = explode(',', $passengers);
                                $get_refund_passengers = explode(',', $fetchResult['booking_refund']);
                                $num_refund_passengers = sizeof($get_refund_passengers)-1;

                                $refund_s = array();
                                $refund_n = array();

                                for ($i = 0; $i < $num_refund_passengers; $i++) {
                                    $refund_details = explode(':', $get_refund_passengers[$i]);
                                    array_push($refund_s, $refund_details[0]);
                                    array_push($refund_n, $refund_details[1]);
                                    // $refund_n = $red
                                }

                                // $refund_p = implode(',', explode(':', $fetchResult['booking_refund']));

                                

                                $actualPrice = 0;
                                $getTotal_passengers = $fetchResult['booking_seatChosen'];
                                $getTotal_passengers = explode(",", $getTotal_passengers);
                                $total_passengers = sizeof($getTotal_passengers);
                                $totalPrice = $fetchResult['booking_seatFare'];

                                $farePrice =  $totalPrice / $total_passengers;

                                $get_discount = mysqli_query($conn, "SELECT * FROM admin_queue_discount WHERE discount_ticketID = '$id' and discount_status = 'TRUE'");
                                $fetch_discount = mysqli_fetch_assoc($get_discount);
                                $NewFare = 0;

                                if ($discount_status == "TRUE") {
                                    
                                    $getDiscounted_passengers = $fetch_discount['discount_passengerNames'];
                                    $getDiscounted_passengers_array = explode(",", $getDiscounted_passengers);
                                    $totalDiscount = sizeof($getDiscounted_passengers_array);

                                    foreach ($refund_n as $passengerRefund) {
                                        if (in_array($passengerRefund, $getDiscounted_passengers_array)) {
                                            $discount = $farePrice * 0.2;
                                            $actualPrice += $farePrice - $discount;
                                            $totalPrice -= $discount;
                                        } else {
                                            $actualPrice += $farePrice;
                                        }
                                    }
                                } else {
                                    $actualPrice = $farePrice * $num_refund_passengers;
                                    $getDiscounted_passengers = 'None';
                                }

                                ?> 
                                
                                <script>console.log('<?php echo $id . ' : Refund Names: '. implode(',', $refund_n) . ' | ' . $actualPrice . ' : ' . $discount_status . ' : Discounted: ' . $getDiscounted_passengers . ' : Passengers:  ' . $passengers;?>')</script>
                                
                                <?php

                                $newPrice = $totalPrice - $actualPrice;

                                $getReference = mysqli_query($conn, "SELECT * FROM admin_queue_gcash WHERE gcash_ticketID = '$id'");
                                $fetch_reference = mysqli_fetch_assoc($getReference);
                                
                                if (mysqli_num_rows($getReference) > 0) {
                                    $reference = $fetch_reference['gcash_reference'];
                                } else {
                                    $reference = "NOT FOUND";
                                }

                                ?> 
                                <tr>
                                    <td><?php echo $fetchResult['booking_id']?></td>
                                    <td>PHP <?php echo $actualPrice;?></td>
                                    <td><?php echo $getDiscounted_passengers; ?></td>
                                    <td><?php echo $reference; ?></td>
                                    <td><?php echo $fetchResult['booking_refund'];?></td>
                                    <td>
                                        <button onclick="window.location.href='admin-refund.php?approve=<?php echo $fetchResult['booking_id']; ?>,<?php echo $newPrice; ?>'" class='hero-btn rounded' style='background-color: green;'>Approve</button>
                                        <button onclick="window.location.href='admin-refund.php?disapprove=<?php echo $fetchResult['booking_id']; ?>'" class='hero-btn rounded' style='background-color: red;'>Reject</button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else {
                            ?>
                            
                            <h1>Nothing to see here yet...</h1>
                            
                            <?php
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>