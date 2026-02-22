<?php
session_start();
include 'config/db.php';

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: user/book_event.php");
            }
            exit();

        } else {
            $error = "Invalid password";
        }

    } else {
        $error = "User not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
</head>

<body style="background-image: url('assets/images/baloondecor.jpg');">
<?php include 'includes/navbar.php'; ?>

<div class="overlay d-flex justify-content-center align-items-center">

<div class="card shadow p-4" style="width: 350px;">
<h4 class="text-center mb-3">User Login</h4>


<?php if (isset($error)) { ?>
<div class="alert alert-danger">
    <?= $error ?>
</div>
<?php } ?>

<form method="post">
    <input type="email" name="email" class="form-control mb-3" placeholder="Email">
    <input type="password" name="password" class="form-control mb-3" placeholder="Password">
    <button type="submit" name="login" class="btn btn-success w-100">Login</button>
</form>

</div>
</div>

</body>
</html>
