<?php

include "../../connection.php";

function exitTicket() {
    header('location: ../admin-paidPassenger.php');
}

if (isset($_GET['exit']))
{
    exitTicket();
}


if($_SESSION['username'] == false) {
    echo
    "<script>
            alert('You must book tickets first...');
            window.location.href='../admin-index.php';
    </script>";
}
else {
    $booking_id = $_SESSION['booking_id'];
    $sql = mysqli_query($conn,"SELECT * FROM bus_booking WHERE booking_id = '$booking_id'");
    $result = mysqli_fetch_array($sql) or die("Data Retrieval Failed.");

    if ($result['booking_status'] != "PAID")
    {
        $disabled = "disabled";
        $color = "grey";
    }
    else
    {
        $disabled="";
        $color="";
    }

    $get_discount = mysqli_query($conn, "SELECT * FROM admin_queue_discount WHERE discount_ticketID = '$booking_id' and discount_status = 'TRUE'");
    $fetch_discount = mysqli_fetch_assoc($get_discount);

    $getTotal_passengers = $result['booking_seatChosen'];
    $getTotal_passengers = explode(",", $getTotal_passengers);
    $total_passengers = sizeof($getTotal_passengers);
    
    $farePrice = $result['booking_seatFare'] / $total_passengers;

    if (mysqli_num_rows($get_discount) > 0)
    {
        $actualPrice = $result['booking_seatFare'];
        $type = $fetch_discount['discount_type'];


        $getDiscounted_passengers = $type;
        $getDiscounted_passengers = explode(",", $getDiscounted_passengers);
        $totalDiscount = sizeof($getDiscounted_passengers);

        $discount = $farePrice * 0.2;
        
        for ($i = 0; $i < $totalDiscount; $i++) {
            $actualPrice -= $discount;
        }

        $reveal_discount = "";

    }
    else {
        $actualPrice = $result['booking_seatFare'];
        $type = "NONE";
        $reveal_discount = "hidden";
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
    <title>Ticket</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script type="text/javascript" src="/assets/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    
    <!-- CSS -->
    <link rel="stylesheet" href="../../css/style.css">

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    
</head>
<body>
<!-- ====== Header ====== -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-sm d-flex align-items-center justify-content-between brand">
        <!-- Navigation bar logo -->
        &nbsp;

        <nav id="navbar" class="navbar">
            <div class="lc-block d-grid gap-2 d-md-flex justify-content-md-start">
                <input type="button" class="hero-btn rounded" <?php echo $disabled;?> id="print" onclick="printToPdf()" style="background-color: <?php echo $color;?>;" value="Print"/>
                <a href="admin-ticket.php?exit=true"><button class="hero-btn rounded">Exit</button></a>
            </div>
        </nav> 
        <!-- END nav -->
    </div>
</header> <!--END Header-->
    
<section class="vh-100">
    <div class="container py-5 h-100" >
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-15">
          <div class="card border-0" style="border-radius: 1rem;" id="content">
            <div class="row">
                <div class="col">
                    <div class="logo d-flex align-items-center">
                        <img src="../../assets/img/icon-bus.png"  alt="">
                        <h2 style="font-size: 4rem;">Irosin Elavil Tours PH.</h2>
                    </div>
                    <h3 class='mx-2'>Departure date: <?php echo $result['booking_date'];?></h3>
                </div>

                <div class="col-3">
                    <h4 class="text-center">Bus Ticket: <br><span> <?php echo $result['booking_id']; ?> </span></h4>
                </div>
                
            </div>

            <div class="row container mb-4 mt-3">
            <h6>Reminder:</h6>    
            <span>Present this ticket in <b>HARD COPY</b> and you <b>VALID ID</b> to the ticket booth</span>
            <span>Any cargo or baggage exceeding <b>20 kilos</b> will be charged an additional "overweight" or "oversized" fee. </span>
            
            </div>
            <div class="row container mb-2">
                <div class="col">
                    <h5>Departure:</h5>
                    <span> <?php echo $result['booking_departure']; ?> </span>
                </div>
                    
                <div class="col">
                    <h5>Arrival: </h5>
                    <span><?php echo $result['booking_arrival']; ?></span>
                </div>
            </div>

            <div class="row container mb-2">
                <div class="col">
                    <h5>Departure Time: </h5>
                    <span><?php echo date('h:i A', strtotime($result['booking_departureTime'])); ?></span>
                </div>
                <div class="col">
                    <h5>Arrival Time: </h5>
                    <span><?php echo date('h:i A', strtotime($result['booking_arrivalTime']));  ?></span>
                </div>
            </div>

            <div class="row container mb-2">
                <div class="col">
                    <h5>Seat #: </h5>
                    <span><?php echo $result['booking_seatChosen'] ; ?></span>
                </div>
                <div class="col">
                    <h5>Bus Type: </h5>
                    <span><?php echo $result['booking_busType']; ?></span>
                </div>
            </div>

            <div class="row container mb-2">
                <div class="col">
                    <h5>Bus Code </h5>
                    <span><?php echo $result['booking_busCode']; ?></span>
                </div>
                <div class="col">
                    <h5>Fare per Seat</h5>
                    <span><?php echo $farePrice; ?></span>
                </div>
            </div>

            <div class="row container mb-2">
                
            </div>

            <div class="row container mb-2 mt-3">
                <h2>Passenger Info</h2>
            </div>

            <div class="row container mb-2">
                <div class="col m-2">
                    <h5>Passenger Name/s: </h5>
                    <span><?php echo $result['booking_passengers']; ?></span>
                </div>
                <div class="col m-2">
                    <h5>CustomerName: </h5>
                    <span><?php echo $result['booking_customerName']; ?></span>
                </div>
                <div class="col m-2">
                    <h5>Contact Number: </h5>
                    <span><?php echo $result['booking_customerContact']; ?></span>
                </div>
            </div>

            <div class="row container mb-5">
                <div class="col m-2">
                    <h5>Email: </h5>
                    <span><?php echo $result['booking_customerEmail']; ?></span>
                </div>
                <div class="col m-2">
                    <h5>Gender: </h5>
                    <span><?php echo $result['booking_gender']; ?></span>
                </div>
                <div class="col m-2">
                    <h5>Discount: </h5>
                    <span><?php echo $type; ?></span>
                </div>
            </div>

            <div class="row container">
                <h2>Total Amount:</h2>
                <span <?php echo $reveal_discount;?>>Discount: 20%</span>
                <span <?php echo $reveal_discount; ?>>Original Price: <?php echo $result['booking_seatFare'];?></span>
                <h1>PHP <?php echo $actualPrice;?></h1>
            </div>

          </div>
        </div>
      </div>
    </div>
</section>

  

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function printToPdf() {
        
        let element = document.getElementById('content');
        var opt = {
        filename:     "Irosin-Elavil-Ticket.pdf",
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 1 },
        jsPDF:        { unit: 'in', format: 'A4', orientation: 'portrait' }
        };

        // New Promise-based usage:
        html2pdf().set(opt).from(element).save();
        html2pdf(element, opt);
    }

</script>

</html>
