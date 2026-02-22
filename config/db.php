<?php
$host = "localhost";
$user = "root";      // your DB username
$pass = "";          // your DB password
$db   = "event_management";   // your database name

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die("Database connection failed: " . mysqli_connect_error());
}
?>
