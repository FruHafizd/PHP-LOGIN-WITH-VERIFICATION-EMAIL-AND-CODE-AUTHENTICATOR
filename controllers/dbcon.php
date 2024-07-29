<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db = "dummyloginphp";

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
?>