<?php
include 'koneksi.php';

$result = mysqli_query($koneksi, "SELECT * FROM pendaftar");
?>

<table border="1" cellpadding="8">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Lengkap</th>
      <th>Alamat</th>
      <th>Jenis Kelamin</th>
      <th>Agama</th>
      <th>Sekolah Asal</th>
      <th>Jurusan</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $row['nama_lengkap'] ?></td>
      <td><?= $row['alamat'] ?></td>
      <td><?= $row['jenis_kelamin'] ?></td>
      <td><?= $row['agama'] ?></td>
      <td><?= $row['asal_sekolah'] ?></td>
      <td><?= $row['jurusan'] ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
