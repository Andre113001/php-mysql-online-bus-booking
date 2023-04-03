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
    
    $booking_id = strval(getName($n)). "-" .strval(getName($n)).'-'.strval(getName($n));
    $date = $_SESSION['date'];
    $customer_gender = $_SESSION['customer_gender'];
    $bus_type = $_SESSION['bus_type'];
    $bus_arrival = $_SESSION['arrival'];
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
    <link rel="icon" href="../../assets/img/icon-bus.png">
    <title>Irosin Elavil Bus Reservation</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    
    <!-- CSS -->
    <link rel="stylesheet" href="../../css/style.css">

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    
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
                                <span>Taken</span>
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
                            <input type="button" class="hero-btn rounded" id="btnShowNew" value="Proceed" style="background-color: green;" />        
                        </form>
                    </div>
                </div>
            </div>
            
            </div>
        </div>
        </div>
    </div>
</section>


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
                window.location.href='admin-info.php';
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