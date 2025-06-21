<?php
include 'koneksi.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data_pendaftar.csv"');

$output = fopen("php://output", "w");
fputcsv($output, ['No', 'Nama Lengkap', 'Alamat', 'Jenis Kelamin', 'Agama', 'Asal Sekolah', 'Jurusan']);

$no = 1;
$result = mysqli_query($koneksi, "SELECT * FROM pendaftar");
while ($row = mysqli_fetch_assoc($result)) {
  fputcsv($output, [$no++, $row['nama_lengkap'], $row['alamat'], $row['jenis_kelamin'], $row['agama'], $row['asal_sekolah'], $row['jurusan']]);
}
fclose($output);
exit;
?>
