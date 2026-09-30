<?php
require_once "config/database.php";

$keyword = $_GET['keyword'] ?? '';

if ($keyword != '') {
    $keyword_safe = mysqli_real_escape_string($conn, $keyword);
    $query = mysqli_query(
        $conn,
        "SELECT * FROM produk
         WHERE nama LIKE '%$keyword_safe%'
         ORDER BY id DESC"
    );
} else {
    $query = mysqli_query(
        $conn,
        "SELECT * FROM produk
         ORDER BY id DESC"
    );
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Sweet Bites</title>
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
    <div class="page-title">
        <span class="eyebrow">OUR COLLECTION</span>
        <h1>Find Your Favorite Bite</h1>
        <p class="muted">Snack box, cookies, pudding, dan dessert kecil untuk hari yang lebih manis.</p>
    </div>

    <div class="card search-card">
        <form method="GET" class="search-form">
            <input type="text" name="keyword" placeholder="Search your favorite bite..." value="<?= htmlspecialchars($keyword); ?>">
            <button type="submit" class="btn">Search</button>
        </form>
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
