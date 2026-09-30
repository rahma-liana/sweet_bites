<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    header("Location: ../admin/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sweet Bites</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="login-page">
<div class="container">
    <div class="card login-card">
        <span class="eyebrow">SWEET BITES ADMIN</span>
        <h1>Welcome Back</h1>
        <p class="muted">Silakan login untuk mengelola katalog Sweet Bites.</p>

        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <form action="proses_login.php" method="POST">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit" class="btn">Login</button>
        </form>
        <br>
        <a href="../index.php" class="text-link">← Back to website</a>
    </div>
</div>
</body>
</html>
