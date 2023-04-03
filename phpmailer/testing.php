<?php 

include "../connection.php";

$n=6;
function generate_otp($n) {
  $characters = '0123456789';
  $randomString = '';

  for ($i = 0; $i < $n; $i++) {
      $index = rand(0, strlen($characters) - 1);
      $randomString .= $characters[$index];
  }

  return $randomString;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
// require 'vendor/phpmailer/phpmailer/src/Exception.php';
// require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
// require 'vendor/phpmailer/phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // $email = $_POST['user_email'];

  // $getEmail = mysqli_query($conn, "SELECT * FROM customers where customer_email = '$email'");

  // if (mysqli_num_rows($getEmail) >= 1) {
  //   echo "<script> alert('Sorry that email has already been taken') </script>";
  // }
  // else {
  //   $_SESSION['user_email'] = $_POST['user_email'];
  //   $_SESSION['user_password'] = $_POST['user_password'];

  //   header("location: testing-verify.php");
  // }

try {

$otp = generate_otp($n);

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->Username = 'irosin.elavil@gmail.com';
$mail->Password = 'yowjxlvalqjcjflx';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';

// //host account
// $mail->Username = 'irosin.elavil@gmail.com';
// $mail->Password = '.Irosin.elavil';

//send by host
$mail->setFrom('irosin.elavil@gmail.com', 'OTP Account Activation');
$mail->addAddress($_POST['user_email']);

//body
$mail->isHTML(true);
$mail->Subject = "Irosin Elavil PH: OTP Account Activation";
    $mail->Body =
      "<h3>Dear User</h3>
            <b>Your OTP is: " . $otp . " </b>";
$mail->send();

$_SESSION['user_email'] = $_POST['user_email'];
$_SESSION['user_password'] = $_POST['user_password'];
$_SESSION['user_otp'] = $otp;

header("location: testing-verify.php");

echo "Mail has been sent successfully!";

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
    <title>Register Testing - Irosin Elavil Bus Reservation</title>

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
                    <span class="h1 fw-bold mb-0" style="font-size: 2rem;">&nbsp;&nbsp;Register Testing</span>
                </div>

                <div class="form-outline mb-4">
                    <input type="email" name="user_email" id="user_email" autocomplete="off" class="form-control form-control-lg" />
                    <label class="form-label" for="user_email">Email</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" name="user_password" id="user_password" class="form-control form-control-lg" />
                    <label class="form-label" for="user_password">Password</label>
                </div>

                <div class="pt-1 mb-4 text-center">
                    <button class="btn hero-btn btn-lg btn-block" type="submit">Proceed</button>
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