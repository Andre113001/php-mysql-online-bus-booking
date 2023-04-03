<?php

include '../connection.php';

$admin_active = $_SESSION['username'];

if($admin_active == false) {
    echo
    "<script>
            alert('You must log-in first...');
            window.location.href='admin-index.php';
    </script>";
}
else {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Initialize
        $bus_code = $_POST['bus_code'];
        $bus_platenum = $_POST['bus_platenum'];
        $bus_schedule = $_POST['bus_schedule'];
        $bus_type = $_POST['bus_type'];
        $bus_driver = $_POST['bus_driver'];
        $bus_conductor = $_POST['bus_conductor'];
        $bus_departureTime = $_POST['bus_departureTime'];
        $bus_arrivalTime = $_POST['bus_arrivalTime'];
        $bus_fare = $_POST['bus_fare'];
        $bus_seats = 60;
        $bus_departure = $_POST['bus_departure'];
        $bus_arrival = $_POST['bus_arrival'];

        //upload to database
        $sql = "INSERT INTO bus_details (bus_code, bus_platenum, bus_type, bus_driver, bus_conductor, bus_seats, bus_schedule, bus_departureTime, bus_arrivalTime, bus_fare, bus_departure, bus_arrival) 
                VALUES ('$bus_code', '$bus_platenum', '$bus_type', '$bus_driver', '$bus_conductor', '$bus_seats', '$bus_schedule', '$bus_departureTime', '$bus_arrivalTime', '$bus_fare', '$bus_departure', '$bus_arrival')";
        $result = mysqli_query($conn, $sql) or die("Data Upload Failed!");

        if ($result) {
            echo 
            "<script>
                    alert('Bus Added Successfully!');
                    window.location.href='admin-busdetail.php';
            </script>";
        }
        else {
            echo 
            "<script>
                    alert('Bus Detail Upload Failed!');
                    window.location.href='admin-addbus.php';
            </script>";
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
    <title>Admin - Add New Bus</title>

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
                <a href="admin-busdetail.php" class="hero-btn rounded float-end">Back</a>
            </div>
        </div>
        <!-- Header - END -->

        <!-- Hero Section - START -->
        <section class="vh-100">
            <div class="container py-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="card-body p-4 p-lg-1 text-black">
            
                            <form role="form" method="post" enctype="multipart/form-data">

                               <div class="d-flex align-items-center mb-3 pb-1">
                                    <span class="h1 fw-bold mb-0" style="font-size: 2rem;">
                                        <img src="../assets/img/icon-bus.png" width="50px" alt="">&nbsp;&nbsp;Add New Bus</span>
                                </div>  
                                
                                <div class="row">
                                    <h3>General</h3>
                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <input type="text" id="bus_code" name="bus_code" autocomplete="off" class="form-control form-control-lg" required/>
                                            <label class="form-label" for="bus_code">Bus Code</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <input type="text" id="bus_platenum" name="bus_platenum" autocomplete="off" class="form-control form-control-lg" required/>
                                            <label class="form-label" for="bus_platenum">Plate Number</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <select class="form-select form-select-lg" name="bus_type" id="bus_type" required>
                                                <option value="" disabled selected></option>
                                                <option value="Aircon">Aircon</option>
                                                <option value="Ordinary">Ordinary</option>
                                            </select>
                                            <label class="form-label" for="bus_type">Bus Type</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <input type="text" id="bus_driver" name="bus_driver" autocomplete="off" class="form-control form-control-lg" required/>
                                            <label class="form-label" for="bus_driver">Driver's Name</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <input type="text" id="bus_conductor" name="bus_conductor" autocomplete="off" class="form-control form-control-lg" required/>
                                            <label class="form-label" for="bus_conductor">Conductor's Name</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    
                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <input type="number" value=60 placeholder=60 id="bus_seats" name="bus_seats" autocomplete="off" class="form-control form-control-lg" disabled/>
                                            <label class="form-label" for="bus_seats">Number of Seats</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-outline mb-4">
                                                <select class="form-select form-select-lg" name="bus_schedule" id="bus_schedule" required>
                                                <option value="" disabled selected></option>
                                                <option value="Monday">Monday</option>
                                                <option value="Tuesday">Tuesday</option>
                                                <option value="Wednesday">Wednesday</option>
                                                <option value="Thursday">Thursday</option>
                                                <option value="Friday">Friday</option>
                                                <option value="Saturday">Saturday</option>
                                                <option value="Sunday">Sunday</option>
                                            </select>
                                            <label class="form-label" for="bus_schedule">Scheduled Day</label>
                                        </div>
                                    </div>
                                        
                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <input type="number" id="bus_fare" name="bus_fare" autocomplete="off" class="form-control form-control-lg" required/>
                                            <label class="form-label" for="bus_fare">Bus fare (per seat)</label>
                                        </div>
                                    </div>
                                        
                                    </div>
        
                                </div>

                                <div class="row">
                                    <h3>Route</h3>
                                    <div class="col">
                                        <div class="form-outline mb-4">
                                        <select class="form-select form-select-lg" name="bus_departure" id="bus_departure" required>
                                                <option value="" disabled selected></option>
                                                <option value="Irosin">Irosin</option>
                                            </select>
                                            <label class="form-label" for="bus_departure">Departure</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <select class="form-select form-select-lg" name="bus_arrival" id="bus_arrival" required>
                                                <option value="" disabled selected></option>
                                                <option value="Pasay">Pasay</option>
                                                <option value="Cubao">Cubao</option>
                                            </select>
                                            <label class="form-label" for="bus_arrivalTime">Arrival</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <h3>Duration</h3>
                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <input type="time" id="bus_departureTime" name="bus_departureTime" autocomplete="off" class="form-control form-control-lg" required/>
                                            <label class="form-label" for="bus_departureTime">Departure time</label>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-outline mb-4">
                                            <input type="time" id="bus_arrivalTime" name="bus_arrivalTime" autocomplete="off" class="form-control form-control-lg" required/>
                                            <label class="form-label" for="bus_arrivalTime">Arrival time</label>
                                        </div>
                                    </div>

                                </div>

                                
                                <div class="mb-4 text-center">
                                    <button class="btn hero-btn btn-lg btn-block px-5 py-3" style="background-color: green;" type="submit">Submit</button>
                                </div>
                            </form>
            
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </section>
        <!-- Hero Section - END -->
    </div>
      
</body>
</html>