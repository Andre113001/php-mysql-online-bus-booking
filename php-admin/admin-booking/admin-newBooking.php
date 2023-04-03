<?php

include '../../connection.php';

if($_SESSION['username'] ==false) {
  echo
    "<script>
            alert('You must log-in first...');
            window.location.href='landing-index.php';
    </script>";
}
else {
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = date("Y-m-d");
    $advance_date = date("Y-m-d", strtotime($date. ' + 10 days'));
    $_SESSION['departure'] = filter_input(INPUT_POST, 'departure', FILTER_SANITIZE_STRING);
    $_SESSION['arrival'] = filter_input(INPUT_POST, 'arrival', FILTER_SANITIZE_STRING);
    $_SESSION['date'] =  $_POST['date'];

    header('location: admin-departure.php');

  }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/img/icon-bus.png">
    <title>Irosin Elavil Bus Reservation</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script type="text/javascript" src="/assets/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    
    <!-- CSS -->
    <link rel="stylesheet" href="../../css/style.css">

    
</head>
<body>

<!-- Header START -->
<div class="row mb-3 mt-5">
  <div class="col-md-11">
      <a href="../admin-bookrecord.php" class="hero-btn rounded col-1 p-3 text-center float-end">Back</a>
  </div>
</div>
<!-- Header - END -->

<section class="vh-100">
    <div class="container vh-50">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="https://images.pexels.com/photos/69866/pexels-photo-69866.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                  alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 100%;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
  
                  <form role="form" method="post" enctype="multipart/form-data">
  
                    <div class="d-flex align-items-center mb-3 pb-1">
                        <img src="../assets/img/icon-ticket.png" alt="" width="70">
                        <span class="h1 fw-bold mb-0">&nbsp;&nbsp;Book Your Ticket</span>
                    </div>
                    <div class="form-outline mb-4">
                        <h5>From</h5>
                        <select class="form-select" name="departure" id="departure" required>
                            <option value="" disabled selected>Select your Departure</option>
                            <option value="Irosin">Irosin</option>
                        </select>
                    </div>
  
                    <div class="form-outline mb-4">
                        <h5>To</h5>
                        <select class="form-select" name="arrival" id="arrival" required>
                            <option value="" disabled selected>Select your Destination</option>
                            <option value="Pasay">Pasay</option>
                            <option value="Cubao">Cubao</option>
                        </select>
                    </div>

                    <h5>Date</h5>
                    <div class="form-outline mb-4 border p-2 rounded">

                        <input type="date" id="date" name="date" class="dropdown-item datepicker" min="<?php $date = date('Y-m-d'); 
                          $date = date("Y-m-d", strtotime($date. ' + 2 days')); echo $date;  ?>" required />
                    </div>

                    <div class="pt-1 mb-4">
                      <button class="btn hero-btn btn-lg btn-block" type="submit">Proceed</button>
                    </div>
                    
                    <span>NOTE: You can only reserve two days in advance</span>

                  </form>
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Hero Section - END -->
  <!-- Hero Section - END -->

    
</body>
</html>