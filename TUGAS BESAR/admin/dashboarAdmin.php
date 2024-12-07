<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../auth/login.php');
    exit;
}
include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Dashboard Admin</h1>
    <a href="manage_restaurants.php">Kelola Restoran</a>
    <a href="../auth/logout.php">Logout</a>
</body>
</html>
