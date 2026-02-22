<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM bookings WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
<title>My Bookings</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body  >

<?php include '../includes/navbar.php'; ?>

<div class="container mt-5">
<h3 class="mb-4">My Booked Events</h3>

<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
    <th>Event Name</th>
    <th>Date</th>
    <th>Address</th>
    <th>Status</th>
</tr>
</thead>

<tbody>
<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $eventName = ($row['event_type'] === 'Other')
            ? $row['custom_event']
            : $row['event_type'];
?>
<tr>
    <td><?= $eventName ?></td>
    <td><?= $row['event_date'] ?></td>
    <td><?= $row['user_address'] ?></td>
    <td>
        <span class="badge bg-info"><?= $row['status'] ?></span>
    </td>
</tr>
<?php
    }
} else {
?>
<tr>
<td colspan="4" class="text-center">No bookings found</td>
</tr>
<?php } ?>
</tbody>
</table>

</div>
</body>
</html>
