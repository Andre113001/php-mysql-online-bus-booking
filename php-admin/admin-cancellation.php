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
    $sql = "SELECT * FROM customer_cancellation order by cancel_id DESC";
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
    <title>Admin - Cancellations</title>

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
        <h1>Customer Cancellations</h1>
        <div class="hero-middle vh-100">
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">Cancellation ID</th>
                        <th scope="col">Ticket ID</th>
                        <th scope="col">Bus Code</th>
                        <th scope="col">Date</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Reason/s</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                        if (mysqli_num_rows($result) > 0)
                        {
                            while ($row_member = mysqli_fetch_assoc($result)) {
                            echo   
                                "<tr>
                                    <td>" . $row_member['cancel_id']  ."</td>" .
                                    "<td>" . $row_member['cancel_ticketID']  ."</td>" .
                                    "<td>" . $row_member['cancel_busCode']  ."</td>" .
                                    "<td>" . $row_member['cancel_busDeparture']  ."</td>" .
                                    "<td>" . $row_member['cancel_customerName']  ."</td>" .
                                    "<td>" . $row_member['cancel_reason']  ."</td>" .
                                "</tr>";
                            }
                        }
                        else {
                            ?>
                            
                            <h1>There are no cancellations, yet...</h1>
                            
                            <?php
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    
</body>
</html>