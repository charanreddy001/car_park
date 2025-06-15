<?php
// index.php – Home/Landing Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Car Parking System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <i class="bi bi-car-front-fill"></i> Car Parking
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header / Banner -->
  <header class="bg-light text-center py-5">
    <div class="container">
      <h1 class="display-4 text-primary">Welcome to Car Parking System</h1>
      <p class="lead">Book and manage parking slots online with ease.</p>
      <a href="login.php" class="btn btn-primary btn-lg mx-2">Login</a>
      <a href="register.php" class="btn btn-outline-primary btn-lg mx-2">Register</a>
    </div>
  </header>

  <!-- Features Section -->
  <section class="py-5">
    <div class="container">
      <div class="row text-center">
        <!-- Feature: Real-Time Status -->
        <div class="col-md-4 mb-4">
          <i class="bi bi-speedometer2 display-4 text-primary"></i>
          <h4 class="mt-3">Real-Time Status</h4>
          <p>See which slots are available instantly on your dashboard.</p>
        </div>
        <!-- Feature: Online Booking -->
        <div class="col-md-4 mb-4">
          <i class="bi bi-calendar-check display-4 text-primary"></i>
          <h4 class="mt-3">Online Booking</h4>
          <p>Book a parking slot in advance from anywhere.</p>
        </div>
        <!-- Feature: Secure Login -->
        <div class="col-md-4 mb-4">
          <i class="bi bi-shield-lock-fill display-4 text-primary"></i>
          <h4 class="mt-3">Secure Login</h4>
          <p>User authentication keeps your bookings safe and secure.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-primary text-white text-center py-3">
    &copy; <?php echo date('Y'); ?> Car Parking System
  </footer>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
