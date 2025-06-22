<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$db = "db_sekolah";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form (name harus sesuai form dan kolom database)
$nama_lengkap     = $_POST['nama_lengkap'];
$nama_panggilan   = $_POST['nama_panggilan'];
$tempat_lahir     = $_POST['tempat_lahir'];
$tanggal_lahir    = $_POST['tanggal_lahir'];
$jenis_kelamin    = $_POST['jenis_kelamin'];
$agama            = $_POST['agama'];
$alamat           = $_POST['alamat'];
$telepon          = $_POST['telepon'];
$email            = $_POST['email'];
$asal_sekolah     = $_POST['asal_sekolah'];
$nisn             = $_POST['nisn'];
$jurusan          = $_POST['jurusan'];

// Simpan ke database
$sql = "INSERT INTO pendaftar (
    nama_lengkap, nama_panggilan, tempat_lahir, tanggal_lahir,
    jenis_kelamin, agama, alamat, telepon, email,
    asal_sekolah, nisn, jurusan
) VALUES (
    '$nama_lengkap', '$nama_panggilan', '$tempat_lahir', '$tanggal_lahir',
    '$jenis_kelamin', '$agama', '$alamat', '$telepon', '$email',
    '$asal_sekolah', '$nisn', '$jurusan'
)";

if ($conn->query($sql) === TRUE) {
  // Redirect ke halaman utama setelah berhasil
  header("Location: index.php");
  exit();
} else {
  echo "Gagal menyimpan data: " . $conn->error;
}

$conn->close();
?>
