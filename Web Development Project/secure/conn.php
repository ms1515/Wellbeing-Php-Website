<?php
//connect to the local MySQL database using PHP

$passw="password";
$webserver="dbServer";
$user="root";
$db="wellbeing";

//connect to the DB
$conn = new mysqli($webserver, $user, $passw, $db);

if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
}
    
?>
