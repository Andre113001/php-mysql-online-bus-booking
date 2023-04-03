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
else
{
    $sql = "SELECT * FROM admin_details";
    $result = mysqli_query($conn, $sql) or die ("Failed To Retrieved Data..."); 
    $getAdmin = mysqli_fetch_array($result);


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if ($_POST['cur_password'] != $getAdmin['admin_password']) {
            echo
            "<script>
                    alert('Your entered the wrong CURRENT password...');
                    window.location.href='admin-changepassword.php';
            </script>";
        }
        else if ($_POST['new_password'] != $_POST['confirm_password'])
        {
            echo
            "<script>
                    alert('Your new password does not match...');
                    window.location.href='admin-changepassword.php';
            </script>";
        }
        else 
        {
            $newPass = $_POST['new_password'];
            $newSql = "UPDATE admin_details SET admin_password = '$newPass'";

            if ($newQuery = mysqli_query($conn, $newSql)) {
                echo
                "<script>
                        alert('Your password has been changed...');
                        window.location.href='admin-index.php';
                </script>";   
            }
            else {
                echo
                "<script>
                        alert('ERROR! Try again later...');
                        window.location.href='admin-changepassword.php';
                </script>";   
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
    <!-- Header START -->
    <div class="row mb-3 mt-5">
            <div class="col">
                <a href="admin-dashboard.php" class="hero-btn rounded float-end">Back</a>
            </div>
        </div>
    <!-- Header - END -->
    <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col col-xl-5">
        <div class="card" style="border-radius: 1rem;">
            <div class="card-body p-4 p-lg-5 text-black">

                <form role="form" method="post" enctype="multipart/form-data">

                <div class="d-flex align-items-center mb-3 pb-1">
                <img src="../assets/img/icon-bus.png" alt="" width="50">
                    <span class="h2 fw-bold mb-0" style="font-size: 20px;">&nbsp;&nbsp;Admin Change Password</span>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" name="cur_password" id="cur_password" autocomplete="off" class="form-control form-control-lg" required/>
                    <label class="form-label" for="cur_password">Current Password</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" name="new_password" id="new_password" class="form-control form-control-lg" required/>
                    <label class="form-label" for="admin_password">New Password</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-lg" required/>
                    <label class="form-label" for="confirm_password">Confirm Password</label>
                </div>

                <div class="pt-1 mb-4 text-center">
                    <button class="btn hero-btn btn-lg btn-block" type="submit">Submit</button>
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