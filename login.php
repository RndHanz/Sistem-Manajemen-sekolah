<?php
session_start();
// Jika pengguna sudah login, arahkan ke halaman utama (index.php)
if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Diubah dari Page/profile/profile.php
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SMA 01 ELITE HARAPAN BANGSA</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body { display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f5f5f5; }
        .login-container { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .login-container h1 { text-align: center; color: var(--primary-color); margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
        .btn { width: 100%; margin-top: 10px; }
        .error-msg { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; }
        /* Tambahkan style untuk pesan sukses */
        .success-msg { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; }
        .register-link { text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login Siswa</h1>
        <?php
        // Menampilkan pesan error
        if (isset($_GET['error'])) {
            echo '<div class="error-msg">' . htmlspecialchars($_GET['error']) . '</div>';
        }
        // Menampilkan pesan sukses logout
        if (isset($_GET['status']) && $_GET['status'] == 'logout_success') {
            echo '<div class="success-msg">Anda telah berhasil logout.</div>';
        }
        ?>
        <form action="proses_login.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <div class="register-link">
            <p>Belum punya akun? <a href="Page/pendaftaran/index.php">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>