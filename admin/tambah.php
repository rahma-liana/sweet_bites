<?php
session_start();
require_once "../includes/auth.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Sweet Bites</title>
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
        <span class="eyebrow">NEW MENU ITEM</span>
        <h1>Add Product</h1>
        <?php include "../includes/flash.php"; ?>
        <form action="proses_produk.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="aksi" value="tambah">
            <label>Product Name</label>
            <input type="text" name="nama" required>
            <label>Category</label>
            <select name="kategori" required>
                <option value="">Choose category</option>
                <option value="Cookies">Cookies</option>
                <option value="Pudding">Pudding</option>
                <option value="Dessert Box">Dessert Box</option>
            </select>
            <label>Description</label>
            <textarea name="deskripsi" rows="5" required></textarea>
            <label>Price</label>
            <input type="number" name="harga" min="0" required>
            <label>Stock</label>
            <input type="number" name="stok" min="0" required>
            <label>Product Image</label>
            <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp">
            <br>
            <button type="submit" class="btn">Save Product</button>
            <a href="produk.php" class="btn btn-light">Back</a>
        </form>
    </div>
</div>
</body>
</html>
