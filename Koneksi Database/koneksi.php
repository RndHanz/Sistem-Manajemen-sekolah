<?php
$host = "localhost";     // Ganti dengan host database kamu, biasanya "localhost"
$user = "root";          // Ganti dengan username database kamu
$password = "";          // Ganti dengan password database kamu
$database = "nama_database"; // Ganti dengan nama database yang ingin dikoneksikan

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $password, $database);

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// echo "Koneksi berhasil!";
?>
