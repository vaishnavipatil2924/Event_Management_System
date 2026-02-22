<?php
include 'config/db.php';

<img src="uploads/event_media/<?= $row['file_name']; ?>" 
     class="gallery-img shadow">

?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Event Gallery</h2>

    <div class="row">

    <?php
    $query = mysqli_query($conn, "SELECT * FROM event_media ORDER BY id DESC");

    while($row = mysqli_fetch_assoc($query)){
    ?>

        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $row['event_name']; ?></h5>
                    <p class="card-text"><?php echo $row['event_date']; ?></p>
                    <a href="event_media_details.php?id=<?php echo $row['id']; ?>" 
                       class="btn btn-primary">View Gallery</a>
                </div>
            </div>
        </div>

    <?php } ?>

    </div>
</div>

</body>
</html>
