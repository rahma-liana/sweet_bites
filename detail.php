<?php
require_once "config/database.php";

$id = isset($_GET['id'])
    ? (int)$_GET['id']
    : 0;

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     WHERE id = $id"
);

$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    die("Produk tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produk['nama']); ?> - Sweet Bites</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="navbar">
    <div class="container nav-inner">
        <a class="brand" href="index.php">Sweet Bites</a>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="produk.php">Menu</a>
            <a href="tentang.php">About Us</a>
        </div>
    </div>
</div>

<div class="container section-space">
    <div class="detail-card card">
        <?php if ($produk['gambar']): ?>
            <img src="uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>" class="detail-image" alt="<?= htmlspecialchars($produk['nama']); ?>">
        <?php endif; ?>
        <div class="detail-info">
            <span class="tag"><?= htmlspecialchars($produk['kategori']); ?></span>
            <h1><?= htmlspecialchars($produk['nama']); ?></h1>
            <p class="detail-description"><?= nl2br(htmlspecialchars($produk['deskripsi'])); ?></p>
            <h2>Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></h2>
            <p class="stock">Available stock: <strong><?= $produk['stok']; ?></strong></p>
            <a href="produk.php" class="btn">← Back to Menu</a>
        </div>
    </div>
</div>
</body>
</html>
