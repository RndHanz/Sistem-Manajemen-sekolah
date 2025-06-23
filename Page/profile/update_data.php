<?php
session_start();

// Cek otentikasi
if (!isset($_SESSION['user_id'])) {
    die("Akses ditolak. Silakan login terlebih dahulu.");
}

// Cek apakah request adalah POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Metode tidak diizinkan.");
}

$user_id_session = $_SESSION['user_id'];

// Ambil semua data dari form
$pendaftar_id   = $_POST['pendaftar_id'];
$nama_lengkap   = $_POST['nama_lengkap'];
$nama_panggilan = $_POST['nama_panggilan'];
$tempat_lahir   = $_POST['tempat_lahir'];
$tanggal_lahir  = $_POST['tanggal_lahir'];
$jenis_kelamin  = $_POST['jenis_kelamin'];
$alamat         = $_POST['alamat'];
$telepon        = $_POST['telepon'];
$asal_sekolah   = $_POST['asal_sekolah'];
$jurusan        = $_POST['jurusan'];

$conn = new mysqli("localhost", "root", "", "db_sekolah");
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Lakukan lagi Pengecekan Otorisasi KEPEMILIKAN sebelum UPDATE
$stmt_check = $conn->prepare("SELECT user_id FROM pendaftar WHERE id = ?");
$stmt_check->bind_param("i", $pendaftar_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$data_check = $result_check->fetch_assoc();
$stmt_check->close();

if (!$data_check || $data_check['user_id'] != $user_id_session) {
    $conn->close();
    die("<h1>Akses Ditolak!</h1><p>Anda tidak berhak mengubah data ini.</p>");
}

// Jika otorisasi lolos, lanjutkan proses UPDATE
$stmt_update = $conn->prepare("UPDATE pendaftar SET 
    nama_lengkap = ?, nama_panggilan = ?, tempat_lahir = ?, tanggal_lahir = ?,
    jenis_kelamin = ?, alamat = ?, telepon = ?, asal_sekolah = ?, jurusan = ?
    WHERE id = ?");

$stmt_update->bind_param("sssssssssi", 
    $nama_lengkap, $nama_panggilan, $tempat_lahir, $tanggal_lahir, 
    $jenis_kelamin, $alamat, $telepon, $asal_sekolah, $jurusan,
    $pendaftar_id
);

if ($stmt_update->execute()) {
    // Jika berhasil, redirect kembali ke halaman profil
    header("Location: profile.php?status=updatesuccess");
} else {
    // Jika gagal
    header("Location: profile.php?status=updatefailed");
}

$stmt_update->close();
$conn->close();
exit();
?>