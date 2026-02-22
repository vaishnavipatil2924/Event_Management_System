<?php
include 'config/db.php';

if(!isset($_GET['id'])){
    header("Location: gallery.php");
}

$event_id = $_GET['id'];

$event = mysqli_fetch_assoc(mysqli_query($conn, 
        "SELECT * FROM event_media WHERE id='$event_id'"));

$media = mysqli_query($conn, 
        "SELECT * FROM event_media_files WHERE event_id='$event_id'");
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $event['event_name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="text-center"><?php echo $event['event_name']; ?></h2>
    <p class="text-center text-muted"><?php echo $event['event_date']; ?></p>
    <p class="text-center"><?php echo $event['description']; ?></p>

    <hr>

    <div class="row">

    <?php while($file = mysqli_fetch_assoc($media)){ ?>

        <div class="col-md-4 mb-4">
            <div class="card shadow p-2">

                <?php if($file['file_type'] == 'image'){ ?>
                    <img src="uploads/event_media/<?php echo $file['file_name']; ?>" 
                         class="img-fluid rounded">
                <?php } else { ?>
                    <video controls class="w-100 rounded">
                        <source src="uploads/event_media/<?php echo $file['file_name']; ?>">
                    </video>
                <?php } ?>

            </div>
        </div>

    <?php } ?>

    </div>

    <div class="text-center mt-4">
        <a href="gallery.php" class="btn btn-secondary">Back to Gallery</a>
    </div>

</div>

</body>
</html>
