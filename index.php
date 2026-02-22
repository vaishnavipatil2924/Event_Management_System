<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Event Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="assets/style.css" rel="stylesheet">
</head>

<body style="background-image: url('assets/images/bg-home.jpg');">
<?php include 'includes/navbar.php'; ?>

<div class="overlay">

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
  </div>
</nav>

<!-- HERO -->
 <style>
.hero {
    background: url('assets/images/bg-home.jpg.jpg') no-repeat center center/cover;
    height: 80vh;
    display: flex;
    align-items: center;
    color: white;
}
.hero-overlay {
    background: rgba(0,0,0,0.6);
    width: 100%;
    padding: 60px;
}
</style>

<div class="hero">
  <div class="hero-overlay text-center">
      <h1 class="display-4 fw-bold">Make Your Events Memorable</h1>
      <p class="lead">Weddings • Birthdays • Corporate • Custom Events</p>
      <a href="register.php" class="btn btn-warning btn-lg">Book Your Event</a>
  </div>
</div><br>



<div id="eventCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

  <!-- Indicators -->
<div class="container mt-5">
  <div class="shadow-lg p-1 bg-white rounded-1">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="2"></button>
  </div>

  <div class="carousel-inner rounded shadow-lg">

    <!-- Slide 1 -->
    <div class="carousel-item active">
      <img src="assets/images/event1.jpg" class="d-block w-100 carousel-img">
      <div class="carousel-caption">
        <h2>Make Your Event Memorable</h2>
        <p>Professional Event Management Services</p>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <img src="assets\images\event3.jpg" class="d-block w-100 carousel-img">
      <div class="carousel-caption">
        <h2>Wedding & Engagement</h2>
        <p>Celebrate Your Special Moments</p>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <img src="assets/images/event4.jpg" class="d-block w-100 carousel-img">
      <div class="carousel-caption">
        <h2>Corporate & Birthday Events</h2>
        <p>We Plan. You Celebrate.</p>
      </div>
    </div>

  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>

</div>
 </div>
</div>



<!-- SERVICES -->
<div class="container mt-5">
<h2 id="services" class="section-title text-center">Our Services</h2>
<div class="row text-center">
    <div class="col-md-4">
        <div class="card p-3">
            <h4>🎊 Decoration</h4>
            <p>Theme-based stage, lighting & floral decor.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h4>🍽 Catering</h4>
            <p>Custom veg & non-veg menus.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h4>🎶 DJ & Music</h4>
            <p>Professional DJ & sound system.</p>
        </div>
    </div>
</div>
</div>

<!-- GALLERY -->
<div class="container mt-5 gallery">
<h2 id="gallery" class="section-title text-center">Our Attended Events</h2>
<div class="row g-3">
    <div class="col-md-4"><img src="assets/images/event4.jpg" class="img-fluid rounded"></div>
    <div class="col-md-4"><img src="assets/images/ring.jpg.jpg" class="img-fluid rounded"></div>
    <div class="col-md-4"><img src="assets/images/event1.jpg" class="img-fluid rounded"></div>
</div>
</div>

<!-- TESTIMONIALS -->
<div class="container mt-5">
<h2 class="section-title text-center">What Our Clients Say</h2>
<div class="row">
    <div class="col-md-4">
        <div class="testimonial">
            <p>"Amazing wedding planning! Everything was perfect."</p>
            <strong>- Rahul Patil</strong>
        </div>
    </div>
    <div class="col-md-4">
        <div class="testimonial">
            <p>"Best birthday event my family ever had."</p>
            <strong>- Sneha Kulkarni</strong>
        </div>
    </div>
    <div class="col-md-4">
        <div class="testimonial">
            <p>"Professional corporate event management."</p>
            <strong>- TechCorp Pvt Ltd</strong>
        </div>
    </div>
</div>
</div>

<!-- FOOTER -->
<footer class="mt-5">
<div class="container">
<div class="row">

<div class="col-md-4">
    <h5>Event Management</h5>
    <p>We plan, manage and execute events professionally.</p>
</div>

<div class="col-md-4">
    <h5>Quick Links</h5>
    <ul class="list-unstyled">
        <li><a href="index.php">Home</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>

    </ul>
</div>

<div class="col-md-4">
    <h5>Contact Us</h5>
    <p>Email: events@gmail.com</p>
    <p>Phone: +91 9876543210</p>
</div>

<hr class="mt-4">

<div class="text-center">
    <p class="mb-0">© 2026 Event Management System | Final Year Project</p>
</div>

</div>
</div>
</footer>

</div>
</body>
</html>
