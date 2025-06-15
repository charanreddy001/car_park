<?php
// includes/functions.php
// Reusable functions: check if user/admin is logged in

function check_login() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
}

function check_admin() {
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: login.php");
        exit;
    }
}

function check_user() {
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
        header("Location: login.php");
        exit;
    }
}
?>
