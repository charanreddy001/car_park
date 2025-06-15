<?php
// user/get_slots.php - Return slot data as JSON
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    // Not authorized
    echo json_encode([]);
    exit;
}
include '../includes/db_connect.php';

$slots = [];
$res = mysqli_query($conn, "SELECT * FROM parking_slots ORDER BY id");
while ($row = mysqli_fetch_assoc($res)) {
    $slots[] = $row;
}
echo json_encode($slots);
?>
