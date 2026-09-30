<?php
require_once "../includes/auth.php";
require_once "../config/database.php";

$total_produk = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM produk"
);
$data_produk = mysqli_fetch_assoc($total_produk);

$total_kategori = mysqli_query(
    $conn,
    "SELECT COUNT(DISTINCT kategori) AS total FROM produk"
);
$data_kategori = mysqli_fetch_assoc($total_kategori);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sweet Bites</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="navbar">
    <div class="container nav-inner">
        <a class="brand" href="index.php">Sweet Bites Admin</a>
        <div class="nav-links">
            <a href="index.php">Dashboard</a>
            <a href="produk.php">Products</a>
            <a href="../index.php">Website</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>

<div class="container section-space">
    <div class="page-title">
        <span class="eyebrow">ADMIN PANEL</span>
        <h1>Dashboard</h1>
        <p class="muted">Selamat datang, <strong><?= htmlspecialchars($_SESSION['admin_nama']); ?></strong>.</p>
    </div>

    <div class="grid stats-grid">
        <div class="card stat-card">
            <span class="muted">Total Products</span>
            <h2><?= $data_produk['total']; ?></h2>
        </div>
        <div class="card stat-card">
            <span class="muted">Categories</span>
            <h2><?= $data_kategori['total']; ?></h2>
        </div>
        <div class="card stat-card">
            <span class="muted">Store Status</span>
            <h2>Active</h2>
        </div>
    </div>

    <div class="card">
        <span class="eyebrow">CATALOG MANAGEMENT</span>
        <h2>Manage Sweet Bites Menu</h2>
        <p class="muted">Tambah, edit, cari, atau hapus produk dari katalog.</p>
        <a href="produk.php" class="btn">Manage Products</a>
    </div>
</div>
</body>
</html>
