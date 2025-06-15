<?php
// user/book.php - Handle booking
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}
include '../includes/db_connect.php';

$user_id = $_SESSION['user_id'];
if (isset($_GET['id'])) {
    $slot_id = intval($_GET['id']);
    // Check if slot is still available
    $res = mysqli_query($conn, "SELECT status FROM parking_slots WHERE id=$slot_id");
    if ($slot = mysqli_fetch_assoc($res)) {
        if ($slot['status'] == 0) {
            // Book the slot
            mysqli_query($conn, "INSERT INTO bookings (user_id, slot_id) VALUES ($user_id, $slot_id)");
            mysqli_query($conn, "UPDATE parking_slots SET status=1 WHERE id=$slot_id");
        }
    }
}
header("Location: dashboard.php");
exit;
?>
