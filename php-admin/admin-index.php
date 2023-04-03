<?php 

include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Initialize
    $username = $_POST['admin_username'];
    $password = $_POST['admin_password'];

    $sql = "SELECT * FROM admin_details WHERE admin_username = '$username' AND admin_password = '$password' ";
    $result = mysqli_query($conn, $sql) or die("Data Retrieval Failed.");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['admin_username'];

        header('location: admin-dashboard.php');
    }
    else {
        echo
        "<script>
                alert('Wrong input, try again...');
                window.location.href='admin-index.php';
        </script>";
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
    <title>Administrator - Irosin Elavil Bus Reservation</title>

    <!-- Bootstrap - CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

    
</head>
<body>

<section class="vh-100">
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col col-xl-5">
        <div class="card" style="border-radius: 1rem;">
            <div class="card-body p-4 p-lg-5 text-black">

                <form role="form" method="post" enctype="multipart/form-data">

                <div class="d-flex align-items-center mb-3 pb-1">
                <img src="../assets/img/icon-bus.png" alt="" width="50">
                    <span class="h1 fw-bold mb-0" style="font-size: 2rem;">&nbsp;&nbsp;Admin Login</span>
                </div>

                <div class="form-outline mb-4">
                    <input type="text" name="admin_username" id="admin_username" autocomplete="off" class="form-control form-control-lg" />
                    <label class="form-label" for="admin_username">Username</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" name="admin_password" id="admin_password" class="form-control form-control-lg" />
                    <label class="form-label" for="admin_password">Password</label>
                </div>

                <div class="pt-1 mb-4 text-center">
                    <button class="btn hero-btn btn-lg btn-block" type="submit">Login</button>
                </div>
                </form>

            </div>
        </div>
    </div>
    </div>
</div>
</section>

</body>
</html>