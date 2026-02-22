<?php
include '../config/db.php'; // database connection

if(isset($_POST['submit'])){

    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $description = $_POST['description'];

    // Insert into event_media table
    $insert_event = "INSERT INTO event_media (event_name, event_date, description) 
                     VALUES ('$event_name', '$event_date', '$description')";

    if(mysqli_query($conn, $insert_event)){

        $event_id = mysqli_insert_id($conn); // Get last inserted event ID

        $target_dir = "../uploads/event_media/";

        foreach($_FILES['media']['name'] as $key => $file_name){

            $tmp_name = $_FILES['media']['tmp_name'][$key];
            $file_type = pathinfo($file_name, PATHINFO_EXTENSION);

            // Check file type
            if(in_array($file_type, ['jpg','jpeg','png','gif'])){
                $type = "image";
            } elseif(in_array($file_type, ['mp4','webm','ogg'])){
                $type = "video";
            } else {
                continue; // skip invalid file
            }

            $new_file_name = time() . "_" . $file_name;

            // move_uploaded_file($tmp_name, $target_dir . $new_file_name);

            // Insert into event_media_files table
            $insert_file = "INSERT INTO event_media_files (event_id, file_name, file_type) 
                            VALUES ('$event_id', '$new_file_name', '$type')";

            mysqli_query($conn, $insert_file);
        }

        echo "<script>alert('Event Media Added Successfully!');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Event Media</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

<h2>Add Event Media</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Event Name:</label><br>
    <input type="text" name="event_name" required><br><br>

    <label>Event Date:</label><br>
    <input type="date" name="event_date" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Upload Images / Videos:</label><br>
    <input type="file" name="media[]" multiple required><br><br>

    <button type="submit" name="submit">Add Event</button>

</form>

</body>
</html>
