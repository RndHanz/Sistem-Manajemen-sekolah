<?php
// koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$db = "db_sekolah"; // ganti sesuai nama database kamu

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// ambil data dari form
$fullName = $_POST['fullName'];
$nickName = $_POST['nickName'];
$birthPlace = $_POST['birthPlace'];
$birthDate = $_POST['birthDate'];
$gender = $_POST['gender'];
$religion = $_POST['religion'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$previousSchool = $_POST['previousSchool'];
$nisn = $_POST['nisn'];
$program = $_POST['program'];

// simpan ke database
$sql = "INSERT INTO pendaftar (nama_lengkap, nama_panggilan, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat, telepon, email, asal_sekolah, nisn, jurusan)
        VALUES ('$fullName', '$nickName', '$birthPlace', '$birthDate', '$gender', '$religion', '$address', '$phone', '$email', '$previousSchool', '$nisn', '$program')";

if ($conn->query($sql) === TRUE) {
  header("Location: pendaftar.html"); // redirect balik ke form
  exit();
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
