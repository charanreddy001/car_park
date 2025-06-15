<?php
// booking.php – Handle a user booking request
include 'includes/functions.php';
check_user();
include 'includes/db_connect.php';

$user_id = $_SESSION['user_id'];

// Check if slot ID is passed
if (isset($_GET['id'])) {
    $slot_id = intval($_GET['id']);

    // Verify slot is still available
    $res = mysqli_query($conn, "SELECT status FROM parking_slots WHERE id=$slot_id");
    if ($row = mysqli_fetch_assoc($res)) {
        if ($row['status'] == 0) {
            // Insert booking record
            mysqli_query($conn, "INSERT INTO bookings (user_id, slot_id) VALUES ($user_id, $slot_id)");
            // Mark slot as booked
            mysqli_query($conn, "UPDATE parking_slots SET status=1 WHERE id=$slot_id");
        }
    }
}

// Redirect back to dashboard (JS will refresh the table)
header("Location: dashboard.php");
exit;
?>
