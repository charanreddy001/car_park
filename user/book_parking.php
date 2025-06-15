<?php
// Start session and protect page
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}

include '../db/config.php';

// Get user info
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $slot_id = intval($_POST['slot_id']);

    // 1) Insert into bookings
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, slot_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $slot_id);
    $stmt->execute();
    $stmt->close();

    // 2) Update the slot status to 'booked'
    $conn->query("UPDATE slots SET status='booked' WHERE id = $slot_id");

    // 3) Fetch slot_number for logging
    $stmt = $conn->prepare("SELECT slot_number FROM slots WHERE id = ?");
    $stmt->bind_param("i", $slot_id);
    $stmt->execute();
    $stmt->bind_result($slot_number);
    $stmt->fetch();
    $stmt->close();

    // 4) Insert into logs
    $action = "User [$username] booked Slot [$slot_number]";
    $stmt = $conn->prepare("INSERT INTO logs (action) VALUES (?)");
    $stmt->bind_param("s", $action);
    $stmt->execute();
    $stmt->close();

    // 5) Redirect back to dashboard with a success message
    $_SESSION['msg'] = "Successfully booked slot $slot_number.";
    header("Location: dashboard.php");
    exit();
}

// On GET: fetch all AVAILABLE slots
$avail = $conn->query("SELECT * FROM slots WHERE status='available' ORDER BY slot_number ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Parking Slot - Car Parking System</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Book a Parking Slot</h2>

    <?php
    // Show success message if set
    if (isset($_SESSION['msg'])) {
        echo "<p style='color: green;'>" . htmlspecialchars($_SESSION['msg']) . "</p>";
        unset($_SESSION['msg']);
    }
    ?>

    <?php if ($avail->num_rows > 0): ?>
        <form method="POST">
            <label for="slot_id">Choose an available slot:</label><br>
            <select name="slot_id" id="slot_id" required>
                <option value="" disabled selected>-- Select Slot --</option>
                <?php while ($row = $avail->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>">
                        <?= htmlspecialchars($row['slot_number']) ?>
                    </option>
                <?php endwhile; ?>
            </select><br><br>

            <button type="submit">Book Now</button>
        </form>
    <?php else: ?>
        <p style="color: red;">No slots are currently available.</p>
    <?php endif; ?>

    <br>
    <p><a href="dashboard.php">← Back to Dashboard</a></p>
</body>
</html>
