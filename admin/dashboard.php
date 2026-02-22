<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

$query = "
SELECT 
    bookings.id AS booking_id,
    users.name AS user_name,
    bookings.event_type,
    bookings.custom_event,
    bookings.event_date,
    bookings.status
FROM bookings
JOIN users ON bookings.user_id = users.id
ORDER BY bookings.id DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>All Bookings</h3>

    <a href="logout.php" 
       class="btn btn-outline-danger"
       onclick="return confirm('Do you want to logout?')">
        Logout
    </a>
</div>



<table class="table table-bordered table-striped shadow">
<thead class="table-dark">
<tr>
    <th>Booking ID</th>
    <th>User Name</th>
    <th>Event Name</th>
    <th>Event Date</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
<?php
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        // Event name logic
        $eventName = ($row['event_type'] === 'Other' && !empty($row['custom_event']))
            ? $row['custom_event']
            : $row['event_type'];

        // Status color
        $color = 'secondary';
        if ($row['status'] == 'Pending') $color = 'warning';
        if ($row['status'] == 'Approved') $color = 'success';
        if ($row['status'] == 'Rejected') $color = 'danger';
?>
<tr>
    <td><?= $row['booking_id'] ?></td>
    <td><?= htmlspecialchars($row['user_name']) ?></td>
    <td><?= htmlspecialchars($eventName) ?></td>
    <td><?= $row['event_date'] ?></td>

    <td>
        <span class="badge bg-<?= $color ?>">
            <?= $row['status'] ?>
        </span>
    </td>

    <td>
        <?php if ($row['status'] == 'Pending') { ?>
            <a href="update_booking.php?id=<?= $row['booking_id'] ?>&status=Approved"
               class="btn btn-sm btn-success">
                Approve
            </a>

            <a href="update_booking.php?id=<?= $row['booking_id'] ?>&status=Rejected"
               class="btn btn-sm btn-danger"
               onclick="return confirm('Are you sure?')">
                Reject
            </a>
        <?php } else { ?>
            <span class="text-muted">No Action</span>
        <?php } ?>
    </td>
</tr>
<?php
    }
} else {
?>
<tr>
    <td colspan="6" class="text-center">No bookings found</td>
</tr>
<?php } ?>
</tbody>
</table>

</div>

</body>
</html>
