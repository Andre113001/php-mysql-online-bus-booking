<?php

include '../connection.php';

if($_SESSION['username'] ==false && $_SESSION['ticket_id'] == false)
{
    echo
    "<script>
            alert('You must log-in first...');
            window.location.href='admin-index.php';
    </script>";
}
else {
    $ticket_id = $_SESSION['ticket_id'];
    
    // GET values from gcash table
    $sqlResult = mysqli_query($conn, "SELECT * FROM admin_queue_gcash where gcash_ticketID = '$ticket_id' ");
    $getResult = mysqli_fetch_assoc($sqlResult);

    // GET values from discount table
    $sqlDiscount_get = mysqli_query($conn, "SELECT * FROM admin_queue_discount where discount_ticketID = '$ticket_id' ");
    $fetchDiscount_values = mysqli_fetch_assoc($sqlDiscount_get);

    // check if discount table is not empty
    if (mysqli_num_rows($sqlDiscount_get) > 0 ) {
        $missingDiscount_text = "hidden";
        $missing_content = "";

        $discount_url = $fetchDiscount_values['discount_upload'];
        $discount_url = explode(",", $discount_url);

        $discount_type = $fetchDiscount_values['discount_type'];
        $discount_type = explode(",", $discount_type);

        $discount_name = $fetchDiscount_values['discount_passengerNames'];
        $discount_name= explode(",", $discount_name);

        // echo "<script>console.log('" . $discount_url[1] . "')</script>";

    }
    else {
        $missingDiscount_text = "";
        $missing_content = "hidden";
    }

    // check if gcash table is not empty
    if (mysqli_num_rows($sqlResult) > 0)
    {
        $missing_text = "hidden";
        $missing = "";
    }
    else
    {
        $missing_text = "";
        $missing = "hidden";
    }

    if(isset($_GET['approveID'])) {
        $id = $_GET['approveID'];
        $mysql = mysqli_query($conn, "UPDATE bus_booking SET booking_referenceStatus = 'TRUE', booking_discountStatus = 'TRUE' where booking_id = '$id'");
        $discount_status = mysqli_query($conn, "UPDATE admin_queue_discount SET discount_status = 'TRUE' where discount_ticketID = '$id'");
        if ($mysql && $discount_status) {
            echo 
                "<script>
                    alert('You have approved ". $id ." for discount');
                    window.location.href='admin-bookrecord.php';
                </script>";
        } else {
            echo "<script>alert('Approval Failed!')</script>";
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
    <title>Admin - View Upload</title>

    <!-- Bootstrap - CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <div class="container ">
        <!-- Header START -->
        <div class="row mb-3 mt-5">
            <div class="col">
                <a href="admin-bookrecord.php" class="hero-btn rounded float-end">Back</a>
            </div>
        </div>
        <!-- Header - END -->
    </div>

    <div class="container ">
        <h1 style="font-size: 5rem;">View Upload</h1>
        <h2><?php echo $_SESSION['ticket_id'];?></h2>
        <div class="hero-middle vh-100">
            <div class="row mt-5">
                <div class="col">
                    <h4 <?php echo $missing; ?> class="fw-bold">Proof of Payment</h4>
                    <label <?php echo $missing; ?> for="reference_num">Reference Number</label><br>
                    <input type="text" class="rounded form-control form-control-lg mb-3" name="reference_num" readonly <?php echo $missing; ?> value="<?php echo $getResult['gcash_reference'];?>">
                    <h5 <?php echo $missing_text; ?>>Haven't Uploaded Yet...</h5>
                    <img <?php echo $missing; ?> src="<?php echo $getResult['gcash_proof']; ?>" name="proof" class="img-fluid shadow rounded float-left">
                </div>
                <div class="col" <?php echo $missing_content?>>
                    <h4 class="fw-bold">Discount</h4>
                    <h5 <?php echo $missingDiscount_text; ?>>Nothing to show here...</h5>
                    <div class="col">
                        <?php 

                            for ($i = 0; $i < sizeof($discount_url); $i++) {
                                ?>
                                    <div class="col mb-5">
                                        <h5><?php echo $discount_name[$i]?></h5>
                                        <p>Discount Category: <?php echo $discount_type[$i]?></p>
                                        <a href="<?php echo $discount_url[$i]?>"><input type="button" value="View ID" class="hero-btn rounded"></a>
                                    </div>
                                <?php
                            }
                        
                        ?>
                        <p>Click the button below to approve the ID/s</p>
                        <a href="admin-view.php?approveID=<?php echo $ticket_id?>" class="hero-btn rounded" style="background-color: green;">Approve for Discount and Payment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>