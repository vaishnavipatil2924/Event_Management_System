<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$success = "";

if (isset($_POST['submit'])) {

    $user_id = $_SESSION['user_id'];
    $event_type = $_POST['event_type'];
    $event_date = $_POST['event_date'];
    $user_address = mysqli_real_escape_string($conn, $_POST['user_address']);

    $custom_event = NULL;
    if ($event_type === 'Other' && !empty($_POST['custom_event'])) {
        $custom_event = mysqli_real_escape_string($conn, $_POST['custom_event']);
    }

    $query = "INSERT INTO bookings 
        (user_id, user_address, event_type, custom_event, event_date, status)
        VALUES 
        ('$user_id', '$user_address', '$event_type', '$custom_event', '$event_date', 'Pending')";

    if (mysqli_query($conn, $query)) {
        $success = "🎉 Event booked successfully!";

        header("Location: index.php");

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Book Event</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body style="background-image: url('assets/images/ring.jpg'); background-size:cover;">

<?php include '../includes/navbar.php'; ?>

<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-6">

<div class="card shadow">
<div class="card-header bg-primary text-white">
    <h4>Book Event</h4>
</div>

<div class="card-body">

<?php if ($success): ?>
<div class="alert alert-success"><?= $success ?></div>
<?php endif; ?>

<form method="post">

<div class="mb-3">
<label class="form-label">Event Type</label>
<select name="event_type" class="form-select" required onchange="toggleOther(this.value)">
    <option value="">-- Select Event --</option>
    <option value="Wedding">Wedding</option>
    <option value="Birthday">Birthday</option>
    <option value="Corporate Event">Corporate Event</option>
    <option value="Welcome Event">Welcome Event</option>
    <option value="Other">Other</option>
</select>
</div>

<div class="mb-3" id="otherBox" style="display:none;">
<label class="form-label">Custom Event Name</label>
<input type="text" name="custom_event" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Event Date</label>
<input type="date" name="event_date" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Event Address</label>
<textarea name="user_address" class="form-control" rows="3" required></textarea>
</div>

<button type="submit" name="submit" class="btn btn-success w-100">
    Book Event
</button>

</form>

</div>
</div>

</div>
</div>
</div>

<script>
function toggleOther(val) {
    document.getElementById('otherBox').style.display =
        (val === 'Other') ? 'block' : 'none';
}
</script>

</body>
</html>
