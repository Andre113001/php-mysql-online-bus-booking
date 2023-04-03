<?php

include '../connection.php';


if (!isset($_GET['fixId']) ) {
    ?>
    <script>alert("Sorry you cannot enter this site without your ticket ID") close()</script> 
    <?php
}
else {
    $booking_id = $_GET['fixId'];
    $get_details = mysqli_query($conn, "SELECT * FROM bus_booking WHERE booking_id = '$booking_id'");
    $result = mysqli_fetch_assoc($get_details);

    if (isset($_GET['action'])){
        $action = $_GET['action'];

        switch ($action) {
            case 'invalid_id':
                $discount_category = $_POST['discount_type'];
                // $imageName = $_FILES['proof']['name'];
                $fileName = $_FILES['proof']['tmp_name'];
                $filePaths = array();
                $discount_categories = array();
                $i = 0;

                foreach ($_FILES['proof']['name'] as $imageName) {

                $fileName_temp = $_FILES['proof']['tmp_name'];
                $extension = pathinfo($imageName, PATHINFO_EXTENSION);
                $newName = $booking_id . '.' . $discountedNames[$i] . '.' . $i+1 . '.' . $extension;
                $filePath = '../uploads/valid_id/' . $newName;
                array_push($filePaths, $filePath);
                array_push($discount_categories, $discount_category[$i]);
                move_uploaded_file($fileName_temp[$i], $filePath);  
                $i += 1;
                }
                $filePaths = implode(",", $filePaths);
                $discount_categories = implode(",", $discount_categories);

                $sqlResult = mysqli_query($conn, "UPDATE admin_queue_discount SET discount_type = '$discount_categories', discount_upload = '$filePaths', discount_status = 'PENDING' WHERE discount_ticketID = '$booking_id'");
                if ($sqlResult) {
                    // $changeStatus = mysqli_query($conn, "UPDATE bus_booking WHERE booking_id = '$booking_id'");
                    header("location: profile-upload.php");
                } else {
                echo "<script> alert('Upload Failed! Try again later') </script>";
                }
                break;
            case 'invalid_reference':
                $imageName = $_FILES['proof']['name'];
                $name = $_SESSION['customer_name'];


                // image processing and change of directory
                $extension = pathinfo($imageName, PATHINFO_EXTENSION);
                $newName = $booking_id . '.' . $extension;

                $fileName = $_FILES['proof']['tmp_name'];
                $filePath = '../uploads/gcash_proof/' . $newName;
                $defaultStatus = "TRUE";
                $referenceNum = $_POST['reference'];

                if (move_uploaded_file($fileName, $filePath)) {
                    $sqlResult = mysqli_query($conn, "UPDATE admin_queue_gcash SET = gcash_proof='$filePath', gcash_reference = '$referenceNum' where gcash_ticketID = '$booking_id'");
                    $sqlUpdate = mysqli_query($conn, "UPDATE bus_booking SET booking_referenceStatus = 'TRUE', booking_status = 'PENDING', booking_rejectReason='' where booking_id = '$booking_id'");
                    if ($sqlResult) {
                        // $changeStatus = mysqli_query($conn, "UPDATE bus_booking WHERE booking_id = '$booking_id'");
                        echo "<script> alert('Thank you for sending your proof of payment. We'll come back to you once it is processed') </script>";
                        header("location: profile-view.php");
                    }
                    else {
                        echo "<script> alert('Upload Failed! Try again later') </script>";
                    }
                }
                else {
                echo "<script> alert('Image Upload Failed! Try again later') </script>";
                }
                break;
            default:
                echo "ERROR!";
                break;
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
    <title>Fix Booking - <?php echo $booking_id; ?></title>

    <!-- Bootstrap - CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<div class="container h-100 d-flex align-items-center justify-content-center">
    <div class="card rounded shadow border-0 w-50">
        <h1>Fix Booking</h1>
        <h5>Booking Id:</h5>
        <h3><?php echo $booking_id;?></h3>

        <form role="form" method="post" enctype="multipart/form-data" oninput='con_reference.setCustomValidity(con_reference.value != reference.value ? "Reference Number Does Not Match." : "")'>
            <?php
            $reasons = $result['booking_rejectReason'];
            $reasons = explode(",", $reasons);

            foreach ($reasons as $reason) {
                switch ($reason) {
                    case 'Invalid ID (PWD/Student/Senior Citizen Card)':
                        ?> <h3 class='mt-3'>Upload Picture of Valid ID</h3> <?php
                        $passengers = explode(",", $result['booking_passengers']);
                        foreach ($passengers as $passenger_names) {
                            ?>
                            <div class="row mb-4 mt-4">
                            <div class="col">
                              <h5 for="proof"><?php echo $passenger_names;?></h5>
                              <input type="file" accept="image/*" class="form-control form-control-lg" name="proof[]" required/>
                              <div class="col text-center d-flex ">
                                <select class="form-select form-select-md mt-2 rounded" name="discount_type[]">
                                    <option disabled selected>Select Category</option>
                                    <option value="Student">Student</option>
                                    <option value="Senior Citizen">Senior Citizen</option>
                                    <option value="PWD">PWD</option>
                                  </select>
                              </div>
                            </div>
                            <?php
                        }
                    $action_type = "invalid_id";
                    break;
                case 'Invalid Reference Number / Proof of Payment':
                    ?> 
                    <div class="row mt-4">
                        <div class="col">
                        <h3>Upload Screenshot Proof of Payment</h3>
                        <input type="file" accept="image/*" class="form-control form-control-lg" name="proof" required/>
                        </div>
                    </div>
                    <div class="row mb-3 mt-4">
                        <div class="col">
                        <label class="form-control-label mr-1 fw-bold" for="reference">Reference Number</label>
                        <input type="text" class="form-control form-control-lg" autocomplete="off" name="reference" required/>
                        </div>
                        <div class="col">
                        <label class="form-control-label mr-1 fw-bold" for="con_proof">Confirm Reference Number</label>
                        <input type="text" class="form-control form-control-lg" autocomplete="off" name="con_reference" required/>
                        </div>
                    </div>
                    <?php
                    $action_type = "invalid_reference";
                    break;
                case 'No show':
                    #code..
                    break;
                default:
                    # code...
                    break;
                }
            }
            ?>
            <input type="button" onclick="windows.location.href='profile-fix.php?action=<?php echo $action_type;?>'" value="Submit" class="hero-btn rounded w-100 mt-4 p-3" style="background-color: green;">
        </form>
    </div>
</div>

    
</body>
</html>