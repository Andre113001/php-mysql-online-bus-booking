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
    
    if (isset($_POST['submitBtn'])) {
        $id = $_GET['ticket'];
        $cargo = $_POST['cargoValue'];
        $updateCargo = mysqli_query($conn, "UPDATE bus_booking SET booking_cargo = '$cargo' WHERE booking_id = '$id'");
        if ($updateCargo) {
            ?> 
            
            <script>
                alert('You have updated the cargo of <?php echo $id;?>')
                window.location.href='admin-paidPassenger.php';
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
    <title>Admin - Change Cargo</title>

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
            <a href="admin-paidPassenger.php" class="hero-btn rounded float-end">Back</a>
        </div>
    </div>
    <!-- Header - END -->
    <div class="container">
        <h3>Ticket ID:</h3>
        <h1 class='display-1'>
            <?php echo $_GET['ticket']; ?>
        </h1>
        <form method="post">
            <input type="text" class="form-control form-control-lg mt-3" name='cargoValue' autocomplete="off" placeholder="Enter cargo value here..." required/>
            <input type="submit" class="hero-btn rounded mt-3" name='submitBtn' value='Submit' style='background-color: green;'>
        </form>
    </div>
</div>
    
</body>
</html>