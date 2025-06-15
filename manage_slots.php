<?php
// =======================================================
// manage_slots.php — Admin: Add / View / Delete / Toggle Slots
// =======================================================

// 1) Turn on error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2) Include helper functions & check that the user is an admin
include 'includes/functions.php';
check_admin();   // if not admin, redirects to login.php

// 3) Include the database connection (port 3307)
include 'includes/db_connect.php';

// -------------------------------------------------------
// 4) Handle “Add New Slot” form submission (via POST)
// -------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['slot_name'])) {
    $slotName = mysqli_real_escape_string($conn, trim($_POST['slot_name']));
    if ($slotName !== '') {
        // Insert the new slot (default status = 0 → available)
        $insertSql = "INSERT INTO parking_slots (slot_name) VALUES ('$slotName')";
        mysqli_query($conn, $insertSql);
    }
    // Redirect to avoid resubmitting the form on refresh
    header("Location: manage_slots.php");
    exit;
}

// -------------------------------------------------------
// 5) Handle “Delete Slot” (via GET ?del_id=…)
// -------------------------------------------------------
if (isset($_GET['del_id'])) {
    $delId = intval($_GET['del_id']);
    // Delete that slot (any related bookings will cascade if FK is set)
    mysqli_query($conn, "DELETE FROM parking_slots WHERE id = $delId");
    header("Location: manage_slots.php");
    exit;
}

// -------------------------------------------------------
// 6) Handle “Toggle Status” (via GET ?toggle_id=…)
// -------------------------------------------------------
if (isset($_GET['toggle_id'])) {
    $toggleId = intval($_GET['toggle_id']);
    // Fetch current status (0 or 1)
    $res = mysqli_query($conn, "SELECT status FROM parking_slots WHERE id = $toggleId");
    if ($row = mysqli_fetch_assoc($res)) {
        $newStatus = ($row['status'] == 0) ? 1 : 0;
        mysqli_query($conn, "UPDATE parking_slots SET status = $newStatus WHERE id = $toggleId");
    }
    header("Location: manage_slots.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin: Manage Parking Slots</title>
  <!-- Bootstrap 5 CSS (CDN) -->
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

  <!-- Main Container -->
  <div class="container mt-4">
    <h3>Manage Parking Slots</h3>

    <!-- Add New Slot Form -->
    <form method="POST" class="row g-3 mb-4">
      <div class="col-md-8">
        <input 
          type="text" 
          name="slot_name" 
          class="form-control" 
          placeholder="Enter New Slot Name (e.g. A1)" 
          required 
        />
      </div>
      <div class="col-md-4">
        <button type="submit" class="btn btn-success w-100">Add Slot</button>
      </div>
    </form>

    <!-- Slots Table -->
    <table class="table table-bordered table-striped">
      <thead class="table-primary">
        <tr>
          <th>ID</th>
          <th>Slot Name</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Fetch all slots from DB
        $slotsResult = mysqli_query($conn, "SELECT * FROM parking_slots ORDER BY id ASC");
        while ($slot = mysqli_fetch_assoc($slotsResult)):
        ?>
          <tr>
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
              <!-- Toggle status link -->
              <a 
                href="?toggle_id=<?php echo $slot['id']; ?>" 
                class="btn btn-sm btn-outline-warning"
              >
                <?php echo ($slot['status'] == 0) ? 'Mark Booked' : 'Mark Free'; ?>
              </a>
              <!-- Delete link -->
              <a 
                href="?del_id=<?php echo $slot['id']; ?>" 
                class="btn btn-sm btn-danger"
                onclick="return confirm('Are you sure you want to delete this slot?');"
              >
                Delete
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap 5 JS (Bundle includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
