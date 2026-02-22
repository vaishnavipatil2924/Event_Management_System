<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/event_management/index.php">
        🎉 Event Management
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <!-- Always Visible -->
        <li class="nav-item">
          <a class="nav-link" href="/event_management/index.php">Home</a>
        </li>
 <li class="nav-item">
<a class="nav-link" href="/event_management/register.php">Register</a>
</li>


            <li class="nav-item">

              <a class="nav-link" href="/event_management/login.php">Login</a>

            </li>


        <li class="nav-item">
          <a class="nav-link" href="/event_management/contact.php">Contact</a>
        </li>

        <?php if (!isset($_SESSION['user_id'])) { ?>
            <!-- Guest -->
            <li class="nav-item">
              <a class="nav-link" href="/event_management/register.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/event_management/login.php">Login</a>
            </li>
        <?php } else { ?>

            <!-- Logged in user -->
            <li class="nav-item">
              <a class="nav-link" href="/event_management/user/book_event.php">Book Event</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/event_management/user/my_bookings.php">My Bookings</a>
            </li>

            <?php if ($_SESSION['role'] === 'admin') { ?>
                <li class="nav-item">
                  <a class="nav-link text-warning" href="/event_management/admin/dashboard.php">
                    Admin
                  </a>
                </li>
            <?php } ?>

            <li class="nav-item">
              <a class="nav-link text-danger" href="/event_management/logout.php">Logout</a>
            </li>

        <?php } ?>

      </ul>
    </div>
  </div>
</nav>
