<?php
session_start();

// Cek otentikasi
if (!isset($_SESSION['user_id'])) {
    die("Akses ditolak. Silakan login terlebih dahulu.");
}

$user_id_session = $_SESSION['user_id'];
$pendaftar_id = $_GET['id'] ?? 0;

if ($pendaftar_id == 0) {
    die("Error: ID Pendaftar tidak valid.");
}

$conn = new mysqli("localhost", "root", "", "db_sekolah");
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Lakukan Pengecekan Otorisasi KEPEMILIKAN sebelum DELETE
$stmt_check = $conn->prepare("SELECT user_id FROM pendaftar WHERE id = ?");
$stmt_check->bind_param("i", $pendaftar_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$data_check = $result_check->fetch_assoc();
$stmt_check->close();

if (!$data_check || $data_check['user_id'] != $user_id_session) {
    $conn->close();
    die("<h1>Akses Ditolak!</h1><p>Anda tidak berhak menghapus data ini.</p>");
}

// Jika otorisasi lolos, lanjutkan proses DELETE
// Hapus data dari tabel 'pendaftar'
$stmt_delete_pendaftar = $conn->prepare("DELETE FROM pendaftar WHERE id = ?");
$stmt_delete_pendaftar->bind_param("i", $pendaftar_id);
$stmt_delete_pendaftar->execute();
$stmt_delete_pendaftar->close();

// Hapus data dari tabel 'users'
$stmt_delete_user = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt_delete_user->bind_param("i", $user_id_session);
$stmt_delete_user->execute();
$stmt_delete_user->close();

$conn->close();

// Hancurkan sesi (logout)
session_unset();
session_destroy();

// Redirect ke halaman utama dengan pesan sukses
header("Location: ../../index.php?status=deletesuccess");
exit();
?>