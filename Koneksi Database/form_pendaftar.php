<?php
include 'koneksi.php';

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

$query = "INSERT INTO pendaftar (nama_lengkap, nama_panggilan, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat, no_hp, email, asal_sekolah, nisn, jurusan)
VALUES ('$fullName', '$nickName', '$birthPlace', '$birthDate', '$gender', '$religion', '$address', '$phone', '$email', '$previousSchool', '$nisn', '$program')";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Pendaftaran berhasil!'); window.location.href='../../Page/pendaftaran/pendaftaran.php';</script>";
} else {
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
}
?>
