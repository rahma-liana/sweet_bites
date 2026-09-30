<?php
require_once "config/database.php";

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     ORDER BY id DESC
     LIMIT 6"
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Bites - Sweet Snack & Dessert</title>
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

<section class="hero">
    <div class="container hero-content">
        <span class="eyebrow">TINY TREATS, BIG HAPPINESS</span>
        <h1>Sweet Bites</h1>
        <p>Temukan camilan manis yang dibuat untuk menemani setiap cerita, dari coffee break sampai hadiah untuk orang tersayang.</p>
        <a href="produk.php" class="btn">Explore Our Bites</a>
    </div>
</section>

<div class="container section-space">
    <div class="section-heading">
        <div>
            <span class="eyebrow">FRESH FROM OUR KITCHEN</span>
            <h2>Our Latest Bites</h2>
        </div>
        <a href="produk.php" class="text-link">View all →</a>
    </div>

    <div class="grid">
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <div class="card product-card">
            <?php if ($row['gambar']): ?>
                <img src="uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" class="product-image" alt="<?= htmlspecialchars($row['nama']); ?>">
            <?php endif; ?>
            <div class="product-info">
                <span class="tag"><?= htmlspecialchars($row['kategori']); ?></span>
                <h3><?= htmlspecialchars($row['nama']); ?></h3>
                <p class="muted"><?= htmlspecialchars($row['deskripsi']); ?></p>
                <div class="product-bottom">
                    <strong>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></strong>
                    <a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-small">Details</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<footer>
    <div class="container footer-inner">
        <strong>Sweet Bites</strong>
        <span>Made with love, one bite at a time.</span>
    </div>
</footer>
</body>
</html>
