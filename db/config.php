<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // use your MySQL password if you set one
$db   = 'car_parking_system';
$port = 3307;

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
