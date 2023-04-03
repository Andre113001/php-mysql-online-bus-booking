<?php

include '../connection.php';

$admin_active = $_SESSION['username'];

if($admin_active == false) {
    echo
    "<script>
            alert('You must log-in first...');
            window.location.href='admin-index.php';
    </script>";
}
else {
    $sql = "SELECT * FROM bus_details order by bus_id";
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
    <title>Admin - Bus Details</title>

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
                <a href="admin-dashboard.php" class="hero-btn rounded float-end">Back</a>
            </div>
        </div>
        <!-- Header - END -->
    </div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-3">
                <h1>Bus Details</h1>
            </div>
        </div>
        <div class="row text-right">
            <div class="col-md-7 text-right">
                <a href="admin-report.php"><button class="hero-btn rounded" style="background-color: orange;">Bus Report</button></a>
                <a href="admin-addbus.php"><button class="hero-btn rounded" style="background-color: green;">+ Add New Bus</button></a>
            </div>
        </div>
        <div class="hero-middle vh-100">
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">Bus Code</th>
                        <th scope="col">Plate Number</th>
                        <th scope="col">Type</th>
                        <th scope="col">Driver</th>
                        <th scope="col">Conductor</th>
                        <th scope="col"># of Seats</th>
                        <th scope="col">Scheduled Day</th>
                        <th scope="col">Departure and Arrival Time</th>
                        <th scope="col">Route</th>
                        <th scope="col">Fare (per seat)</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        
                        if (mysqli_num_rows($result) > 0)
                        {
                            while ($row_member = mysqli_fetch_assoc($result)) {
                            echo   
                                "<tr>
                                    <td>" . $row_member['bus_code']  ."</td>" .
                                    "<td>" . $row_member['bus_platenum']  ."</td>" .
                                    "<td>" . $row_member['bus_type']  ."</td>" .
                                    "<td>" . $row_member['bus_driver']  ."</td>" .
                                    "<td>" . $row_member['bus_conductor']  ."</td>" .
                                    "<td>" . $row_member['bus_seats']  ."</td>" .
                                    "<td>" . $row_member['bus_schedule']  ."</td>" .
                                    "<td>" . $row_member['bus_departureTime']. ' - '. $row_member['bus_arrivalTime']  ."</td>" .
                                    "<td>" . $row_member['bus_departure']. ' - ' .  $row_member['bus_arrival']  ."</td>" .
                                    "<td>" . $row_member['bus_fare']  ."</td>" .
                                "</tr>";
                            }
                        }
                    
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>