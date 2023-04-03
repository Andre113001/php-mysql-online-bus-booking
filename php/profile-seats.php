<?php

include '../connection.php';
if($_SESSION['customer_id'] ==false)
{
    echo
    "<script>
            alert('You must log-in first...');
            window.location.href='landing-index.php';
    </script>";
}
else 
{
  $n=3;
  function getName($n) {
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';
  
      for ($i = 0; $i < $n; $i++) {
          $index = rand(0, strlen($characters) - 1);
          $randomString .= $characters[$index];
      }
  
      return $randomString;
  }
    $defaultStatus = "ON QUEUE";
    
    $seats_chosen = $_COOKIE['seats_chosen']; 
    $separate = explode(',', $seats_chosen); 
    $bus_passengers = count($separate);
    $totalFare = $_SESSION['bus_fare'] * $bus_passengers;
    
    $booking_id = strval(getName($n)). "-" .strval(getName($n)).'-'.strval(getName($n));
    $date = $_SESSION['date'];
    $customer_name = $_SESSION['customer_name'];
    $customer_contactnum = $_SESSION['customer_contactnum'];
    $customer_email = $_SESSION['customer_email'];
    $customer_gender = $_SESSION['customer_gender'];
    $bus_type = $_SESSION['bus_type'];
    $bus_code = $_SESSION['bus_code'];
    $bus_departure = $_SESSION['departure'];
    $bus_departureTime = date("G:i", strtotime($_SESSION['bus_departureTime']));
    $bus_arrival = $_SESSION['arrival'];
    $bus_arrivalTime = date("G:i", strtotime($_SESSION['bus_arrivalTime']));
    $_SESSION['booking_id'] = $booking_id;
                
    // $sql = "INSERT INTO bus_booking 
    // VALUES ('$booking_id', '$date', '$bus_code', '$bus_type', '$seats_chosen', '$totalFare', '$customer_name', '$customer_email', '$customer_contactnum', '$customer_gender', '$bus_departure', '$bus_departureTime', '$bus_arrival', '$bus_arrivalTime', '$defaultStatus')";
    // $result = mysqli_query($conn, $sql) or die("Registration Failed!");

    

    // header('location: profile-ticket.php');
    
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $sql = "INSERT INTO bus_booking 
    //     VALUES ('$booking_id', '$date', '$bus_code', '$bus_type', '$seats_chosen', '$totalFare', '$customer_name', '$customer_email', '$customer_contactnum', '$customer_gender', '$bus_departure', '$bus_departureTime', '$bus_arrival', '$bus_arrivalTime', '$defaultStatus')";
    //     $result = mysqli_query($conn, $sql) or die("Registration Failed!");

    //     $_SESSION['booking_id'] = $booking_id;

    //     header('location: profile-ticket.php');
    // }

    
    $sql = "SELECT * FROM bus_booking where booking_date = '$date' and booking_busType = '$bus_type' and booking_arrival = '$bus_arrival'";
    $result = mysqli_query($conn, $sql) or die("Data Retrieval Failed.");
    $reserved = array();
    $i = 0;

    while ($row = mysqli_fetch_assoc($result)) 
    {
      $reserved[$i] = $row['booking_seatChosen'];
      $i += 1;
    }

    $arraySeats = implode(",", $reserved);


    // $newReserved = implode(',',$reserved);

    if ($arraySeats != "")
    {
      $display =  "var bookedSeats = [". $arraySeats ."]; init(bookedSeats);";
    }
    else 
    {
      $display = "init();";
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

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    
</head>
<body>

<!-- ====== Header ====== -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-sm d-flex align-items-center justify-content-between brand">
        <!-- Navigation bar logo -->
        <a href="#" class="logo d-flex align-items-center">
            <img src="../assets/img/icon-bus.png" alt="">
            <span>Irosin Elavil Tours Ph.</span>
        </a>

        <nav id="navbar" class="navbar">
            <div class="lc-block d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="profile-dashboard.php" class="mx-5">Home</a>
                <a href="profile-new.php" class="mx-5">New Booking</a>
                <a href="profile-view.php" class="mx-5">View Booking</a>
                <a href="profile-logout.php" class="mx-5">Logout</a>
            </div>
        </nav> 
        <!-- END nav -->
    </div>
</header> <!--END Header-->

<div class="hero-image" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.pexels.com/photos/846350/pexels-photo-846350.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
    <section class="vh-100">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-7">
              <div class="card" style="border-radius: 1rem;">
                <h1 class="mb-5">Choose Seats</h1>
                
                <div class="container">
                    <div id="holder"> 
                        <ul  id="place"></ul>    
                    </div>
                    <div style="float: left;"> 
                        <ul id="seatDescription">
                            <div class="row">
                                <div class="col-1">
                                    <li style="background: lightblue;"></li>
                                </div>
                                <div class="col-2 d-flex align-items-center">
                                    <span class="text-start">Available</span>
                                </div>

                                <div class="col-1">
                                    <li style="background: red;"></li>
                                </div>
                                <div class="col-2 d-flex align-items-center">
                                    <span>Taken / Pending</span>
                                </div>

                                <div class="col-1">
                                    <li style="background: greenyellow;"></li>
                                </div>
                                <div class="col-1 d-flex align-items-center">
                                    <span>Selected</span>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <div class="col">
                        <div style="clear:both;width:100%">
                            <form action="" method="post">  
                                <input type="button" class="hero-btn rounded" onclick="window.location.href='profile-departure.php'" value="Back"/>   
                                <input type="button" class="hero-btn rounded" id="btnShowNew" value="Finish" style="background-color: green;" />        
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
  <!-- Hero Section - END -->

<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
  <section class="d-flex justify-content-center justify-content-lg-between p-4 -bottom">
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
            Here you can use rows and columns to organize your footer content. Lorem ipsum
            dolor sit amet, consectetur adipisicing elit.
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
    </div>
  </section>
  <!-- Section: Links  -->


  <script type="text/javascript">

    var settings = {
               rows: 5,
               cols: 12,
               rowCssPrefix: 'row-',
               colCssPrefix: 'col-',
               seatWidth: 41,
               seatHeight: 35,
               seatCss: 'seat',
               selectedSeatCss: 'selectedSeat',
               selectingSeatCss: 'selectingSeat'
    };

    
    var init = function (reservedSeat) {
                var str = [], seatNo, className;
                for (i = 0; i < settings.rows; i++) {
                    for (j = 0; j < settings.cols; j++) {
                        seatNo = (i + j * settings.rows + 1);
                        className = settings.seatCss + ' ' + settings.rowCssPrefix + i.toString() + ' ' + settings.colCssPrefix + j.toString();
                        if ($.isArray(reservedSeat) && $.inArray(seatNo, reservedSeat) != -1) {
                            className += ' ' + settings.selectedSeatCss;
                        }
                        str.push('<li class="' + className + '"' +
                                  'style="top:' + (i * settings.seatHeight).toString() + 'px;left:' + (j * settings.seatWidth).toString() + 'px">' +
                                  '<a title="' + seatNo + '">' + seatNo + '</a>' +
                                  '</li>');
                    }
                }
                $('#place').html(str.join(''));
            };
        //case I: Show from starting
        // init();

        //Case II: If already booked
        // var bookedSeats = [5, 10, 25];
        // init(bookedSeats);

        <?php echo $display; ?>

        $('.' + settings.seatCss).click(function () {
        if ($(this).hasClass(settings.selectedSeatCss)){
            alert('You cannot pick this seat...');
        }
        else{
            $(this).toggleClass(settings.selectingSeatCss);
            }
        });
        
        // $('#btnShow').click(function () {
        //     var seats= [];
        //     $.each($('#place li.' + settings.selectedSeatCss + ' a, #place li.'+ settings.selectingSeatCss + ' a'), function (index, value) {
        //         seats.push($(this).attr('title'));
        //     });
        //     seats_selected = seats.join(',');
        //     document.cookie="seats_chosen="+seats_selected;
        //     alert("You have chosen seats: " + seats_selected);
        // })
        
        $('#btnShowNew').click(function () {
            var str = [], item;
            $.each($('#place li.' + settings.selectingSeatCss + ' a'), function (index, value) {
                item = $(this).attr('title');                   
                str.push(item);                   
            });
            
            if (str == "")
            {
              alert('Pick a seat first...');
            }
            else
            {
              if(confirm("Your have chosen seat: " + str.join(',')) == true) {
                document.cookie="seats_chosen="+str;
                window.location.href='profile-info.php';
              }
            }
            
        })                                                                                
  </script>



  <style>

    #holder{    
    height:200px;    
    width: 550px;;
    background-color:#F5F5F5;
    border:1px solid #A4A4A4;
    border-radius: 30px;
    margin-left:10px;   
    }
    #place {
    position:relative;
    margin:9px;
    margin-left: 40px;
    }
    #place a{   
    font-size: 0.6em;
    }
    #place li
    {
    list-style: none outside none;
    position: absolute;   
    }    
    #place li:hover
    {
    background-color:yellow;      
    } 
    #place .seat{
    background: lightblue;
    height:33px;
    width:33px;
    display:block;   
    }
    #place .selectedSeat
    { 
    background: red;
    }
    #place .selectingSeat
    { 
    background: yellowgreen;     
    }
    #place .row-3, #place .row-4{
    margin-top:10px;
    }
    #seatDescription li{
    text-align: center; 
    list-style: none outside none;
    padding-left:35px;
    height:35px;
    margin: 20px;
    margin-left: 40px;
    }
    #seatDescription span {
      margin-left: 30px;
      font-size: 0.7rem;
      float: left;
    }

  </style>
</body>
</html>