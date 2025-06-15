<?php
// user/dashboard.php - User view of parking slots
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}
include '../includes/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard - Car Parking System</title>
    <!-- Bootstrap CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- User NavBar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="dashboard.php">Parking Slots</a>
      <div class="ms-auto">
        <span class="navbar-text me-3">Hello, <?php echo $_SESSION['name']; ?></span>
        <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <h3>Available Parking Slots</h3>
    <p>Click "Book Now" to reserve a slot. This list updates automatically every few seconds.</p>

    <!-- Slots table -->
    <table class="table table-bordered table-striped">
      <thead class="table-primary">
        <tr>
          <th>ID</th>
          <th>Slot Name</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="slot_table_body">
        <?php
        // Initial load of slots
        $result = mysqli_query($conn, "SELECT * FROM parking_slots ORDER BY id");
        while ($slot = mysqli_fetch_assoc($result)): ?>
          <tr id="slot-<?php echo $slot['id']; ?>">
            <td><?php echo $slot['id']; ?></td>
            <td><?php echo htmlspecialchars($slot['slot_name']); ?></td>
            <td>
              <?php if ($slot['status'] == 0): ?>
                <span class="badge bg-success">Available</span>
              <?php else: ?>
                <span class="badge bg-danger">Booked</span>
              <?php endif; ?>
            </td>
            <td>
              <?php if ($slot['status'] == 0): ?>
                <a href="book.php?id=<?php echo $slot['id']; ?>" class="btn btn-primary btn-sm">Book Now</a>
              <?php else: ?>
                <button class="btn btn-secondary btn-sm" disabled>Booked</button>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- JavaScript for real-time updates -->
  <script src="../js/main.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
