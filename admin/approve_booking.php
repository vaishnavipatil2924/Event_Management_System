<?php
include '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    mysqli_query($conn,
        "UPDATE bookings SET status='Approved' WHERE id='$id'"
    );

    header("Location: dashboard.php");
    exit();
}
?>


$id = $_GET['id'];
mysqli_query($conn,
    "UPDATE bookings SET status='Approved' WHERE id='$id'");

header("Location: dashboard.php");
?>
