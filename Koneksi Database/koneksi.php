<?php
$host = "localhost";      // Server database
$user = "root";           // Username MySQL (default XAMPP: root)
$pass = "";               // Password MySQL (default XAMPP: kosong)
$db   = "db_sekolah";        // Nama database

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
  die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>
