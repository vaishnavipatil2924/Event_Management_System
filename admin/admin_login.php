<?php
session_start();
include '../config/db.php';

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM admin WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if ($password === trim($row['password'])) {

            $_SESSION['admin_id'] = $row['id'];
            header("Location: dashboard.php");
            exit();

        } else {
            $error = "Wrong Password!";
        }

    } else {
        $error = "Admin not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-4">

<div class="card shadow p-4">
<h4 class="text-center mb-3">Admin Login</h4>

<form method="post">

<input type="email" name="email" class="form-control mb-3"
       placeholder="Admin Email" required>

<input type="password" name="password" class="form-control mb-3"
       placeholder="Password" required>

<button type="submit" name="login" class="btn btn-primary w-100">
    Login
</button>

</form>

<?php if (isset($error)) { ?>
<div class="alert alert-danger mt-3">
    <?= $error ?>
</div>
<?php } ?>

</div>

</div>
</div>
</div>

</body>
</html>



