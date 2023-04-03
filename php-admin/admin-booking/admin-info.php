<?php

include '../../connection.php';
if($_SESSION['username'] ==false)
{
    echo
    "<script>
            alert('You must log-in first...');
            window.location.href='../admin-index.php';
    </script>";
}
else 
{
    $seats_chosen = explode(",", $_COOKIE['seats_chosen']);
    $_SESSION['seats_chosen'] = implode(",", $seats_chosen);
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $valueArray = array();
        $passengerNames = array();
        $passengerDiscount = array();
        $discountedNames = array();

        foreach($_POST['passengerName'] as $names ) {
            array_push($passengerNames, $names);
        }

        $stringNames = implode(",", $passengerNames);
        $_SESSION['passengerNames'] = $stringNames;

        if (!empty($_POST['checkDiscount'])) { // if one are checked

            foreach ($_POST['checkDiscount'] as $value) {
                array_push($passengerDiscount, $value);
            }

            $valueString = implode(",", $passengerDiscount);
            $_SESSION['discountedSeats'] = $valueString;
            $_SESSION['discount_status'] = "TRUE";
            $_SESSION['reference_status'] = "TRUE";
            header("location: admin-discount.php");
        }
        else { // if none checked
            $_SESSION['discount_status'] = "FALSE";
            $_SESSION['reference_status'] = "TRUE";
            header("location: admin-upload.php");
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
      <a href="admin-departure.php" class="hero-btn rounded col-1 p-3 text-center float-end">Back</a>
  </div>
</div>
<!-- Header - END -->


<section>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-15">
            <div class="card" style="border-radius: 1rem;">
            <h1>Passenger Info</h1>
            <p>Kindly fill in the form.</p>
            <form role="form" method="post" enctype="multipart/form-data">
            <?php
            
            for ($i = 0; $i < sizeof($seats_chosen); $i++) {
                ?> 
                    <div class="row mb-4 ">
                        <div class="col-1 d-flex align-items-center">
                            <span class="fw-bold">Seat # <?php echo $seats_chosen[$i];?> :</span>
                        </div>
                        <div class="col-5 d-flex align-items-center">
                            <input type="text" class="form-control form-control-lg" name="passengerName[]" placeholder="Enter name here..." required/>       
                        </div>
                        <div class="col-3 d-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="checkDiscount[]" value="<?php echo $seats_chosen[$i];?>" id="">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <span style="color: red;">*</span>Check here if you are a Senior Citizen/Student/PWD.
                                </label>
                            </div>
                        </div>
                    </div>

                
                
                <?php
            }
            
            ?>
            
            <input type="submit" value="Submit" class="hero-btn rounded" style="background-color: green;">
            </form>
            </div>
        </div>
        </div>
    </div>
    </section>
    
</body>
</html>