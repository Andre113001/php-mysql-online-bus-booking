<?php 
session_start();

date_default_timezone_set('Hongkong');

$servername = "localhost";
$user = "root";
$pass = ".Marcus113001";
$db = "irosin-elavil-db";

$conn = mysqli_connect($servername, $user, $pass, $db);


// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

?>