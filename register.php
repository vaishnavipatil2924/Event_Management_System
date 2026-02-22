<?php
include 'config/db.php';

$success = "";
$error = "";

if (isset($_POST['submit'])) {

    // Validate inputs
    if (
        empty($_POST['name']) ||
        empty($_POST['email']) ||
        empty($_POST['password']) ||
        empty($_POST['contact_number'])
    ) {
        $error = "All fields are required";
    } else {

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact_number']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
              $error = "Email already registered";
}

        $query = "INSERT INTO users (name, email, contact_number, password)
                  VALUES ('$name', '$email', '$contact', '$password')";

        if (mysqli_query($conn, $query)) {
            $user_id = mysqli_insert_id($conn);

        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;

         $success = "Account created successfully. Please login.";

        header("Location: index.php");
    

        
        } else {
            $error = "Database Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
</head>

<body style="background-image: url('assets/images/bg-register.jpg'); background-size:cover;">
<?php include 'includes/navbar.php'; ?>

<div class="overlay d-flex justify-content-center align-items-center" style="min-height:100vh;">

<div class="card shadow p-4" style="width: 380px;">
<h4 class="text-center mb-3">Create Account</h4>

<?php if ($success): ?>
<div class="alert alert-success"><?= $success ?></div>
<?php endif; ?>

<?php if ($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post">

<input type="text" name="name" class="form-control mb-3"
       placeholder="Full Name" required>

<input type="email" name="email" class="form-control mb-3"
       placeholder="Email" required>

<input type="password" name="password" class="form-control mb-3"
       placeholder="Password" required>

<input type="text" name="contact_number"
       pattern="[0-9]{10}"
       title="Enter 10 digit number"
       class="form-control mb-3"
       placeholder="Contact Number"
       required>

<button type="submit" name="submit" class="btn btn-primary w-100">
    Register
</button>

</form>

</div>
</div>

</body>
</html>
