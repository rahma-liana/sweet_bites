<?php
session_start();
require_once "../includes/auth.php";
require_once "../config/database.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
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
    <title>Edit Product - Sweet Bites</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="navbar">
    <div class="container nav-inner">
        <a class="brand" href="index.php">Sweet Bites Admin</a>
        <div class="nav-links">
            <a href="index.php">Dashboard</a>
            <a href="produk.php">Products</a>
        </div>
    </div>
</div>
<div class="container section-space">
    <div class="card form-card">
        <span class="eyebrow">UPDATE MENU ITEM</span>
        <h1>Edit Product</h1>
        <?php include "../includes/flash.php"; ?>
        <form action="proses_produk.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="aksi" value="edit">
            <input type="hidden" name="id" value="<?= $produk['id']; ?>">
            <label>Product Name</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($produk['nama']); ?>" required>
            <label>Category</label>
            <select name="kategori" required>
                <option value="Cookies" <?= $produk['kategori'] == 'Cookies' ? 'selected' : ''; ?>>Cookies</option>
                <option value="Pudding" <?= $produk['kategori'] == 'Pudding' ? 'selected' : ''; ?>>Pudding</option>
                <option value="Dessert Box" <?= $produk['kategori'] == 'Dessert Box' ? 'selected' : ''; ?>>Dessert Box</option>
            </select>
            <label>Description</label>
            <textarea name="deskripsi" rows="5" required><?= htmlspecialchars($produk['deskripsi']); ?></textarea>
            <label>Price</label>
            <input type="number" name="harga" value="<?= $produk['harga']; ?>" required>
            <label>Stock</label>
            <input type="number" name="stok" value="<?= $produk['stok']; ?>" required>
            <label>Change Image</label>
            <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp">
            <?php if ($produk['gambar']): ?>
                <p class="muted">Current image:</p>
                <img src="../uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>" class="preview-image" alt="">
            <?php endif; ?>
            <br><br>
            <button type="submit" class="btn">Update Product</button>
            <a href="produk.php" class="btn btn-light">Back</a>
        </form>
    </div>
</div>
</body>
</html>
