<?php
// view_logs.php – Admin: View all bookings
include 'includes/functions.php';
check_admin();
include 'includes/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Booking Logs - Admin</title>
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
        <span class="navbar-text me-3"><?php echo $_SESSION['name']; ?></span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <h3>Booking Logs</h3>
    <table class="table table-bordered table-striped">
      <thead class="table-primary">
        <tr>
          <th>#</th>
          <th>User Name</th>
          <th>Email</th>
          <th>Slot Name</th>
          <th>Booked At</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "
          SELECT b.id, u.name AS user_name, u.email, s.slot_name, b.booking_time
          FROM bookings b
          JOIN users u ON b.user_id = u.id
          JOIN parking_slots s ON b.slot_id = s.id
          ORDER BY b.booking_time DESC
        ";
        $logs = mysqli_query($conn, $sql);
        while ($log = mysqli_fetch_assoc($logs)): ?>
          <tr>
            <td><?php echo $log['id']; ?></td>
            <td><?php echo htmlspecialchars($log['user_name']); ?></td>
            <td><?php echo htmlspecialchars($log['email']); ?></td>
            <td><?php echo htmlspecialchars($log['slot_name']); ?></td>
            <td><?php echo $log['booking_time']; ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
