<?php
session_start();
require_once "../includes/auth.php";
require_once "../config/database.php";

$keyword = $_GET['keyword'] ?? '';
$kategori = $_GET['kategori'] ?? '';

$where = [];

if ($keyword != '') {
    $keyword_safe = mysqli_real_escape_string($conn, $keyword);
    $where[] = "nama LIKE '%$keyword_safe%'";
}

if ($kategori != '') {
    $kategori_safe = mysqli_real_escape_string($conn, $kategori);
    $where[] = "kategori = '$kategori_safe'";
}

$where_sql = "";
if (count($where) > 0) {
    $where_sql = "WHERE " . implode(" AND ", $where);
}

$per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $per_page;

$count_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM produk $where_sql"
);
$count_data = mysqli_fetch_assoc($count_query);
$total_data = $count_data['total'];
$total_page = ceil($total_data / $per_page);

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     $where_sql
     ORDER BY id DESC
     LIMIT $per_page OFFSET $offset"
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Sweet Bites</title>
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
        </div>
    </div>
</div>

<div class="container section-space">
    <div class="page-title">
        <span class="eyebrow">CATALOG</span>
        <h1>Manage Products</h1>
    </div>

    <?php include "../includes/flash.php"; ?>

    <a href="tambah.php" class="btn">+ Add Product</a>
    <br><br>

    <div class="card">
        <form method="GET" class="admin-filter">
            <div>
                <label>Search Product</label>
                <input type="text" name="keyword" placeholder="Product name" value="<?= htmlspecialchars($keyword); ?>">
            </div>
            <div>
                <label>Category</label>
                <select name="kategori">
                    <option value="">All Categories</option>
                    <option value="Cookies" <?= $kategori == 'Cookies' ? 'selected' : ''; ?>>Cookies</option>
                    <option value="Pudding" <?= $kategori == 'Pudding' ? 'selected' : ''; ?>>Pudding</option>
                    <option value="Dessert Box" <?= $kategori == 'Dessert Box' ? 'selected' : ''; ?>>Dessert Box</option>
                </select>
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn">Search</button>
                <a href="produk.php" class="btn btn-light">Reset</a>
            </div>
        </form>
    </div>

    <div class="card table-wrap">
        <table>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
            <?php $no = $offset + 1; ?>
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td>
                    <?php if ($row['gambar']): ?>
                        <img src="../uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" class="table-image" alt="">
                    <?php else: ?>
                        No image
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['nama']); ?></td>
                <td><?= htmlspecialchars($row['kategori']); ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= $row['stok']; ?></td>
                <td class="actions">
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                    <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus produk?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="pagination">
        <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <a href="?page=<?= $i; ?>&keyword=<?= urlencode($keyword); ?>&kategori=<?= urlencode($kategori); ?>"><?= $i; ?></a>
        <?php endfor; ?>
    </div>
</div>
</body>
</html>
