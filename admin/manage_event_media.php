<?php
include '../config/db.php';

// Delete Event
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    // First get files to delete from folder
    $files = mysqli_query($conn, "SELECT file_name FROM event_media_files WHERE event_id='$id'");

    while($row = mysqli_fetch_assoc($files)){
        $file_path = "../uploads/event_media/" . $row['file_name'];
        if(file_exists($file_path)){
            unlink($file_path);
        }
    }

    // Delete event (media files auto delete due to CASCADE)
    mysqli_query($conn, "DELETE FROM event_media WHERE id='$id'");

    echo "<script>alert('Event Deleted Successfully'); window.location='manage_event_media.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Event Media</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #f2f2f2;
        }
        a {
            text-decoration: none;
            padding: 5px 10px;
            background: red;
            color: white;
        }
        .view-btn {
            background: green;
        }
    </style>
</head>
<body>

<h2>Manage Event Media</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Event Name</th>
        <th>Date</th>
        <th>Total Media</th>
        <th>Action</th>
    </tr>

<?php
$events = mysqli_query($conn, "SELECT * FROM event_media ORDER BY id DESC");

while($event = mysqli_fetch_assoc($events)){

    $event_id = $event['id'];

    $count_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM event_media_files WHERE event_id='$event_id'");
    $count = mysqli_fetch_assoc($count_query)['total'];
?>

<tr>
    <td><?php echo $event['id']; ?></td>
    <td><?php echo $event['event_name']; ?></td>
    <td><?php echo $event['event_date']; ?></td>
    <td><?php echo $count; ?></td>
    <td>
        <a href="../event_media_details.php?id=<?php echo $event_id; ?>" class="view-btn">View</a>
        <a href="manage_event_media.php?delete=<?php echo $event_id; ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </td>
</tr>

<?php } ?>

</table>

</body>
</html>
