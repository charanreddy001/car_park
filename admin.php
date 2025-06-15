<?php
// admin.php – Admin Dashboard
include 'includes/functions.php';
check_admin();            // Ensures only admins reach this page
include 'includes/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard - Car Parking System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="admin.php">Admin Panel</a>
      <div class="ms-auto">
        <span class="navbar-text me-3">Hello, <?php echo $_SESSION['name']; ?></span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <h2>Welcome, Admin</h2>
    <p>Use the links below to manage parking slots or view booking logs.</p>

    <div class="d-grid gap-2 col-md-6 mx-auto">
      <a href="manage_slots.php" class="btn btn-success">Manage Parking Slots</a>
      <a href="view_logs.php" class="btn btn-secondary">View Booking Logs</a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
