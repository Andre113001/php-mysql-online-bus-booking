<?php

include '../connection.php';

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

require '../phpmailer/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = $_POST['email'];

  //validate email
  $getEmail = mysqli_query($conn, "SELECT * FROM customers where customer_email = '$email'");
  
  if (mysqli_num_rows($getEmail) > 0) {
    $row = mysqli_fetch_assoc($getEmail);
    if ($email == $row['customer_email']) {
      echo "<script> alert('Sorry, but the email you have entered already exist...'); </script>";
    }
  }
  else
  {
    $_SESSION['register_email'] = $_POST["email"];
    $_SESSION['register_name'] = $_POST["firstname"] . ' ' . $_POST["lastname"];
    $_SESSION['register_password'] = $_POST['password'];
    $_SESSION['register_contactnum'] = $_POST["contactnum"];
    $_SESSION['register_gender'] = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);

    try {

      $otp = generate_otp($n);
      
      $mail = new PHPMailer(true);
      //Email Initialize
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;
      $mail->Username = 'irosin.elavil@gmail.com';
      $mail->Password = 'rxadqpgekgylwfnl';
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'tls';
      
      //send by host
      $mail->setFrom('irosin.elavil@gmail.com', 'IROSIN ELAVIL PH');
      $mail->addAddress($_POST['email']);
      
      //body
      $mail->isHTML(true);
      $mail->Subject = "OTP Account Activation";
          $mail->Body =
            "<h3>Hi, ". $_SESSION['register_name'] ."</h3>
                  <b>To continue your login, your OTP is: " . $otp . " <br>Never share your OTP with somebody.</b>
                  <p>Sincerely yours <br> Irosin Elavil PH</p>";
      $mail->send();
      
      $_SESSION['user_otp'] = $otp;
      
      header("location: landing-register-verify.php");
      
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
    <title>Irosin Elavil Bus Reservation</title>

    <!-- Bootstrap - CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

    
</head>
<body>
<!-- ====== Header ====== -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-sm d-flex align-items-center justify-content-between brand">
        <!-- Navigation bar logo -->
        <a href="landing-index.php" class="logo d-flex align-items-center">
            <img src="../assets/img/icon-bus.png" alt="">
            <span>Irosin Elavil Tours PH.</span>
        </a>

        <nav id="navbar" class="navbar">
            <div class="lc-block d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="landing-about.php" class="mx-5">About</a>
                <a href="landing-contact.php" class="mx-5">Contact</a>
                <a href="landing-login.php" class="mx-5">Sign in</a>
            </div>
        </nav> 
        <!-- END nav -->
    </div>
</header> <!--END Header-->

  <!-- ======= Hero Section ======= -->
  <div class="hero-image">
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card mt-5" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="https://images.pexels.com/photos/2402648/pexels-photo-2402648.jpeg?auto=compress&cs=tinysrgb&w=1600"
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 100%; object-fit: cover;" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">

                      <form role="form" method="post" enctype="multipart/form-data" oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "Passwords do not match." : "")'>
      
                        <div class="d-flex align-items-center mb-3 pb-1">
                        <img src="../assets/img/icon-bus.png" alt="" width="50">
                          <span class="h1 fw-bold mb-0">&nbsp;&nbsp;Sign up</span>
                        </div>
      
                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Create your account here</h5>
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-outline mb-4">
                                    <input type="text" name="firstname" autocomplete="off" id="firstname" class="form-control form-control-md" required/>
                                    <label class="form-label" for="firstname">First Name</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline mb-4">
                                    <input type="text" name="lastname" id="lastname" autocomplete="off" class="form-control form-control-md" required/>
                                    <label class="form-label" for="lastname">Last Name</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-outline mb-4">
                                    <input type="password" name="password" id="password" class="form-control form-control-md" required/>
                                    <label class="form-label" for="form2Example17">Password</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline mb-4">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-md" required/>
                                    <label class="form-label" for="confirm_password">Confirm Password</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                          <div class="col">
                            <div class="form-outline mb-4">
                              <input type="email" name="email" id="email" autocomplete="off" class="form-control form-control-md" required/>
                              <label class="form-label" for="email">Email address</label>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-outline mb-4">
                              <input type="tel" name="contactnum" id="contactnum" autocomplete="off" class="form-control form-control-md" required/>
                              <label class="form-label" for="contactnum">Contact Number</label>
                            </div>
                          </div>
                      </div>

                      <div class="form-outline mb-4">
                            <select name="gender" id="gender" class="form-select form-select-md" required>
                                <option selected></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label class="form-label" for="gender">Gender</label>
                        </div>
      
                        <div class="pt-1 mb-4">
                          <button class="btn hero-btn btn-lg btn-block" type="submit" name="submit">Proceed</button>
                        </div>

                        

                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Already have an account? <a href="landing-login.php"
                            style="color: #00B3D7;">Sign in here</a></p>
                      </form>
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  </div>
  <!-- Hero Section - END -->

<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
  
  </section>
  <!-- Section: Social media -->
  
  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
              Elavil Tours Phils. Inc.
          </h6>
          <p>
          Elavil Tours Phils.Inc is a bus company in the Philippines that has routes to the Northern Samar from Manila. It has daily trips to San Jose, Rosario, Laoang. Elavil Bus Terminal is one of the top-rated places listed as a Bus Station in Pasay City
          </p>
        </div>
        <!-- Grid column -->
  
        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Contact
          </h6>
          <p>Headquarters: <br> 309 P. Tuazon Blvd, Project 4, Quezon City, 1109 Metro Manila, Philippines <br>
            Contact Numbers: <br> +63 935 039 4703 <br>
            E-mail: <br> info@phbus.com</p>
        </div>
        <!-- Grid column -->
    </div>
  </section>
  <!-- Section: Links  -->
  
  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2023 Copyright:
    <a class="text-reset fw-bold" href="#">Irosin Elavil Tours PH.</a>
  </div>
  <!-- Copyright -->
  </footer>
  <!-- Footer -->
</body>
</html>