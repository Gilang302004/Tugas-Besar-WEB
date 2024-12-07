<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header('Location: ../auth/login.php');
    exit;
}
include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard User</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Dashboard User</h1>
    <a href="profile.php">Profil Saya</a>
    <a href="../auth/logout.php">Logout</a>
</body>
</html>
