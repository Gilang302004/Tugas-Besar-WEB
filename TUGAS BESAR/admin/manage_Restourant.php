<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../auth/login.php');
    exit;
}
include '../includes/db.php';

// Tambah, Edit, atau Hapus data berdasarkan request.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    if (isset($_POST['add'])) {
        $query = $conn->prepare("INSERT INTO restaurants (name, description, location) VALUES (?, ?, ?)");
        $query->bind_param("sss", $name, $description, $location);
        $query->execute();
    }
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $query = $conn->prepare("DELETE FROM restaurants WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
    }
}

$restaurants = $conn->query("SELECT * FROM restaurants");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kelola Restoran</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Kelola Restoran</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Nama Restoran" required>
        <textarea name="description" placeholder="Deskripsi" required></textarea>
        <input type="text" name="location" placeholder="Lokasi" required>
        <button type="submit" name="add">Tambah</button>
    </form>
    <h2>Daftar Restoran</h2>
    <table>
        <tr>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $restaurants->fetch_assoc()): ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['description'] ?></td>
            <td><?= $row['location'] ?></td>
            <td>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" name="delete">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="dashboard.php">Kembali</a>
</body>
</html>
s