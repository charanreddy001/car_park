<?php
// includes/db_connect.php
$host = 'localhost';
$user = 'root';
$password = '';        // XAMPP default
$dbname = 'parking_db';
$port = 3307;          // <-- Must match your MySQL port

$conn = mysqli_connect($host, $user, $password, $dbname, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
