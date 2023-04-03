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
    $sql = "SELECT * FROM bus_booking where booking_status = 'PAID' order by booking_added DESC";
    $result = mysqli_query($conn, $sql) or die("Data Retrieval Failed.");

    if(isset($_GET['getID']))
    {
        $_SESSION['booking_id'] = $_GET['getID'];
        header('location: admin-booking/admin-ticket.php');
    }

    if(isset($_GET['changeCargo'])) {
        header('location: admin-cargo.php?ticket=' . $_GET['changeCargo']);
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
    <title>Admin - Paid Passengers</title>

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
    <div class="m-5">
        <h3>Paid Passengers</h3>
        <div class="hero-middle vh-100">
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">Booking ID</th>
                        <th scope="col">Seat #</th>
                        <th scope="col">Bus Code</th>
                        <th scope="col">Passenger Names</th>
                        <th scope="col">Cargo (kg)</th>
                        <th scope="col">Bus Type</th>
                        <th scope="col">Customer Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Action</th>
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
                                    "<td>" . $row_member['booking_cargo']  ."</td>" .
                                    "<td>" . $row_member['booking_busType']  ."</td>" .
                                    "<td>" . $row_member['booking_customerName']  ."</td>" .
                                    "<td>" . $row_member['booking_customerEmail']  ."</td>" .
                                    "<td>" . $row_member['booking_customerContact']  ."</td>" .
                                "<td>" 
                                ?> 
                                    <input type="button" value="View" style="background-color: green;" onclick="location.href='admin-paidPassenger.php?getID=<?php echo $row_member['booking_id'];?>'" class="hero-btn rounded"> 
                                    <input type="button" value="Cargo" class='hero-btn rounded' onclick="window.location.href='admin-paidPassenger.php?changeCargo=<?php echo $row_member['booking_id'];?>'">
                                <?php 
                                "</td>" .
                                "</tr>";
                            }
                        }
                        else {
                            ?>
                            
                            <h1>Bookings are ON QUEUE / CANCELLED...</h1>
                            
                            <?php
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>