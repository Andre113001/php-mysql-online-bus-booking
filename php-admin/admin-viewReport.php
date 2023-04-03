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
    $ticket_id = $_SESSION['selected_bus'];
    $date_from = $_SESSION['date_from'];
    $date_to = $_SESSION['date_to'];
    $sql = "SELECT * FROM bus_booking where booking_status = 'PAID' and booking_busCode = '$ticket_id' and booking_date BETWEEN '$date_from' and '$date_to' order by booking_date";
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
    <title>Admin - View Report</title>

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
                <a href="admin-report.php" class="hero-btn rounded float-end">Back</a>
            </div>
        </div>
        <!-- Header - END -->
    </div>

    <div class="container">
        <h1><?php echo $ticket_id; ?></h1>
        <h6><?php echo $_SESSION['date_from'];?> to <?php echo $_SESSION['date_to'];?></h6>
        <div class="hero-middle vh-100">
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">Booking Date</th>
                        <th scope="col">Ticket ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Passenger Names</th>
                        <th scope="col">Seat #</th>
                        <th scope="col">Cargo (kl)</th>
                        <th scope="col">Seat Fare</th>
                        <th scope="col">Total Fare</th>
                        <th scope="col">Discount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $total_price = 0;
                        if (mysqli_num_rows($result) > 0)
                        {
                            echo "<p>All listed below have already paid.</p>";
                            while ($row_member = mysqli_fetch_assoc($result)) {
                            $ticket = $row_member['booking_id'];
                            $get_typeDiscount = mysqli_query($conn, "SELECT * FROM admin_queue_discount WHERE discount_ticketID = '$ticket'");
                            
                            if (mysqli_num_rows($get_typeDiscount) > 0)
                            {
                                $actualPrice = $row_member['booking_seatFare'];
                                $fetchType = mysqli_fetch_assoc($get_typeDiscount);
                                $type = $fetchType['discount_type'];

                                $getTotal_passengers = $row_member['booking_seatChosen'];
                                $getTotal_passengers = explode(",", $getTotal_passengers);
                                $total_passengers = sizeof($getTotal_passengers);

                                $getDiscounted_passengers = $type;
                                $getDiscounted_passengers = explode(",", $getDiscounted_passengers);
                                $totalDiscount = sizeof($getDiscounted_passengers);

                                $farePrice = $row_member['booking_seatFare'] / $total_passengers;
                                $discount = $farePrice * 0.2;
                                
                                for ($i = 0; $i < $totalDiscount; $i++) {
                                    $actualPrice -= $discount;
                                }

                            }
                            else {
                                $actualPrice = $row_member['booking_seatFare'];
                                $type = "NONE";
                            }

                            echo   
                                "<tr>
                                    <td>" . $row_member['booking_date']  ."</td>" .
                                    "<td>" . $row_member['booking_id']  ."</td>" .
                                    "<td>" . $row_member['booking_customerName']  ."</td>" .
                                    "<td>" . $row_member['booking_passengers']  ."</td>" .
                                    "<td>" . $row_member['booking_seatChosen']  ."</td>" .
                                    "<td>" . $row_member['booking_cargo']  ."</td>" .
                                    "<td>" . $farePrice  ."</td>" .
                                    "<td>PHP " . $actualPrice ."</td>" .
                                    "<td>" .  $type ."</td>" .
                                "</tr>";
                                $total_price += $actualPrice;
                            }
                        }
                        else {
                            ?>
                            
                            <h1>No Results Found..</h1>
                            
                            <?php
                        }
                    
                    ?>
                </tbody>
            </table>
            <?php 
            
            if ($total_price != null || $total_price == 0) {
                ?> 
                    <h3>TOTAL: PHP <?php echo $total_price?></h3>
                <?php
            }
            
            ?>
        </div>
    </div>
    
</body>
</html>