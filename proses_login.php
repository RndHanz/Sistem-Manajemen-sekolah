<?php
session_start();
$conn = new mysqli("localhost", "root", "", "db_sekolah");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil URL redirect dari form modal
$redirect_url = $_POST['redirect_url'] ?? 'index.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    // Kembali ke halaman sebelumnya dengan error jika form kosong
    header("Location: " . $redirect_url . "?error=Email dan password harus diisi");
    exit();
}

$stmt = $conn->prepare("SELECT id, password, nama FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        // Password benar, buat session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $email;
        $_SESSION['user_nama'] = $user['nama'];

        // =======================================================
        // PERUBAHAN UTAMA ADA DI SINI
        // Redirect ke halaman utama (index.php) setelah berhasil login
        // =======================================================
        header("Location: index.php");
        exit();

    } else {
        // Password salah, kembali ke halaman sebelumnya dengan error
        header("Location: " . $redirect_url . "?error=Password salah");
        exit();
    }
} else {
    // Email tidak ditemukan, kembali ke halaman sebelumnya dengan error
    header("Location: " . $redirect_url . "?error=Email tidak ditemukan");
    exit();
}

$stmt->close();
$conn->close();
?>