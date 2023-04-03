<?php

include '../connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/vendor/autoload.php';

function deleteListing(&$id)
  {
    include "../connection.php";
    $DeleteTicket = mysqli_query($conn, "DELETE FROM bus_booking where booking_id = '$id'");
  }

if($_SESSION['username'] ==false || $_SESSION['ticket_id'] == false)
{
    echo
    "<script>
            alert('You must log-in first...');
            window.location.href='admin-index.php';
    </script>";
} else {
  $ticket_id = $_SESSION['ticket_id'];
  $getEmail = mysqli_query($conn, "SELECT * FROM bus_booking where booking_id = '$ticket_id'");
  $fetchEmail = mysqli_fetch_assoc($getEmail);
  $customerEmail = $fetchEmail['booking_customerEmail'];
  $customerName = $fetchEmail['booking_customerName'];


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['check_reject'])) {

      $reason = $_POST['check_reject'];

      $mail = new PHPMailer(true);

      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;
      $mail->Username = 'irosin.elavil@gmail.com';
      $mail->Password = 'rxadqpgekgylwfnl';
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'tls';

      $mail->setFrom('irosin.elavil@gmail.com', 'IROSIN ELAVIL PH');
      $mail->addAddress($customerEmail);
      $mail->isHTML(true);
      $mail->Subject = "Your booking has been rejected";
      $mail->Body =
        "<h3>Hi, ". $customerName ."</h3>
              <b>Your booking ticket ". $_SESSION['ticket_id'] ." has been rejected due to the reason:<br><b>" . 
              $reason
              . "</b><br>Kindly rebook again, thank you!<br><p>Sincerely yours <br> Irosin Elavil PH</p>";
      if($mail->send()) {
        deleteListing($ticket_id);
        ?> 
        <script>
          alert("Email has been sent to <?php echo $customerEmail?>");
          window.location.href = 'admin-bookrecord.php';
        </script>
        <?php
        
      } else {
        ?> 
          <script>
            alert("Email was not send, please try again later");
            window.location.href = 'admin-bookrecord.php';
          </script>
          <?php
      }
      
    } else {
      ?>
          
      <script>
        console.log('You did not choose a reason');
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
    <title>Admin - Reject</title>

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
        <h3>Rejecting Ticket ID:</h3>
        <h1 class="display-1"><?php echo $_SESSION['ticket_id'];?></h1>
        <div class="hero-middle vh-100">
            <h2 class="mb-3">Select a message to be sent to the customer:</h2>
            <form method="post">
              <div class="form-check mb-3">
                  <input class="form-check-input" type="radio" name="check_reject" value="Invalid ID (PWD/Student/Senior Citizen Card)" />
                  <label class="form-check-label" for="radio_reject">
                      Invalid ID (PWD/Student/Senior Citizen Card)
                  </label>
              </div>
              <div class="form-check mb-3">
                  <input class="form-check-input" type="radio" name="check_reject" value="Invalid Reference Number / Proof of Payment" />
                  <label class="form-check-label" for="radio_reject">
                      Invalid Reference Number / Proof of Payment
                  </label>
              </div>
              <div class="form-check mb-3">
                  <input class="form-check-input" type="radio" name="check_reject" value="No Show" />
                  <label class="form-check-label" for="radio_reject">
                      No show
                  </label>
              </div>
              <input type="submit" class="hero-btn rounded">
            </form>
        </div>
    </div>    
</body>
</html>