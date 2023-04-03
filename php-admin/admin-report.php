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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $_SESSION['date_from'] = $_POST['date_from'];
        $_SESSION['date_to'] = $_POST['date_to'];
        $_SESSION['selected_bus'] = $_POST['busCode'];
        header("location: admin-viewReport.php");
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
    <title>Admin - Bus Report</title>

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
                <a href="admin-busdetail.php" class="hero-btn rounded float-end">Back</a>
            </div>
        </div>
        <!-- Header - END -->
    </div>

    <div class="container">
        <form role="form" method="post" enctype="multipart/form-data">
            <div class="row align-items-center">
                <div class="col-3 mb-5">
                    <h1>Bus Report</h1>
                </div>
            </div>
            <div class="hero-middle vh-100">
                <div class="card shadow rounded">
                    <div class="row">
                        <h5>Date From</h5>
                        <div class="form-outline form-outline-lg mb-4 border p-2 rounded">
                            <input type="date" id="date_to" name="date_from" class="dropdown-item datepicker"  required/>
                        </div>
                    </div>
                    <div class="row">
                        <h5>Date To</h5>
                        <div class="form-outline form-outline-lg mb-4 border p-2 rounded">
                            <input type="date" id="date_to" name="date_to" class="dropdown-item datepicker" required />
                        </div>
                    </div>
                    <div class="row">
                        <h5>Bus Code</h5>
                        <select class="form-select form-select-md" name="busCode" id="busCode" required>
                            <option value="" disabled selected>Select Bus Code</option>
                            <?php

                            $getbus = mysqli_query($conn, "SELECT * FROM bus_details");
                            
                            while($getbus_details = mysqli_fetch_assoc($getbus)) {
                                ?>
                                
                                <option value="<?php echo $getbus_details['bus_code'];?>" ><?php echo $getbus_details['bus_code'];?></option>
                                
                                <?php
                            }
                            ?>
                        </select>
                        <div class="col-md-12 text-center mt-5">
                            <input type="submit" class="hero-btn col-3 rounded p-3" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">

        </div>
    </div>
</body>
</html>