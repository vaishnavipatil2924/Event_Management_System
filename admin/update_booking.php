<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'], $_GET['status'])) {

    $booking_id = intval($_GET['id']);
    $status = $_GET['status'];

    if ($status !== 'Approved' && $status !== 'Rejected') {
        die("Invalid status");
    }

    mysqli_query($conn, "UPDATE bookings SET status='$status' WHERE id='$booking_id'");
    header("Location: dashboard.php");
    exit();
}
?>
