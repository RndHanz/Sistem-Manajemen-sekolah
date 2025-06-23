<?php
session_start();

// 1. Cek apakah user sudah login. Jika belum, tendang ke halaman login.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}

// 2. Ambil data user dari session dan koneksi ke DB
$user_id = $_SESSION['user_id'];
$conn = new mysqli("localhost", "root", "", "db_sekolah");
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// 3. Query data dari tabel 'pendaftar' berdasarkan user_id
$stmt = $conn->prepare("SELECT * FROM pendaftar WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$data_siswa = $result->fetch_assoc();

$stmt->close();
$conn->close();

// Jika data siswa tidak ditemukan (seharusnya tidak terjadi jika pendaftaran benar)
if (!$data_siswa) {
    // Bisa logout atau tampilkan pesan error
    die("Data pendaftaran untuk akun ini tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Siswa - <?php echo htmlspecialchars($data_siswa['nama_lengkap']); ?></title>
    <link rel="stylesheet" href="../../styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        /* Tambahkan style untuk halaman profil di sini */
        .profile-container { max-width: 800px; margin: 40px auto; padding: 30px; background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .profile-header { text-align: center; margin-bottom: 30px; }
        .profile-header h1 { color: var(--primary-color); }
        .profile-data table { width: 100%; border-collapse: collapse; }
        .profile-data th, .profile-data td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        .profile-data th { width: 30%; background-color: #f9f9f9; font-weight: 600; }
        .profile-actions { margin-top: 30px; display: flex; justify-content: space-between; }
        .alert {
    padding: 15px 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    color: white;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.alert.success { background-color: #2ecc71; } /* Hijau untuk sukses */
.alert.error { background-color: #e74c3c; }   /* Merah untuk gagal */

.alert-close {
    font-size: 24px;
    font-weight: bold;
    color: white;
    cursor: pointer;
    background: none;
    border: none;
}
    </style>
</head>
<body>
    <header>
  <div class="container header-container">
    <div class="logo">
      <img src="../../img/Logo 1.png" alt="School Logo" />
      <div class="logo-text">
        <h1>SMA 01 ELITE HARAPAN BANGSA</h1>
        <p>Sekolah Berprestasi, Berkarakter, dan Berwawasan Global</p>
      </div>
    </div>

    <button class="mobile-menu-btn" id="mobileMenuBtn">☰</button>

    <nav id="mainNav">
      <ul>
        <li><a href="../../index.php#home">Beranda</a></li>
        <li><a href="../../index.php#profile">Profil Sekolah</a></li>
        <li><a href="../../index.php#news">Berita</a></li>
        <li><a href="../../index.php#gallery">Galeri</a></li>
        <li><a href="../../index.php#calendar">Kalender</a></li>
        <li><a href="../../index.php#registration">Pendaftaran</a></li>
        <li><a href="../../index.php#blog">Blog</a></li>

        <?php if (isset($_SESSION['user_id'])): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" id="dropdownToggle">
              <i class="fas fa-user-circle"></i> Halo, <?php echo htmlspecialchars(strtok($_SESSION['user_nama'], ' ')); ?> <i class="fas fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu" id="dropdownMenu">
              <li><a href="profile.php">Profil Saya</a></li>
              <li><a href="../../logout.php">Logout</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li><a href="../../login.php" class="btn-login">Login</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>

    <main style="padding-top: 100px;">
        <div class="profile-container">

             <?php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            $message = '';
            $alert_type = '';

            if ($status == 'updatesuccess') {
                $message = '<strong>Sukses!</strong> Data profil Anda telah berhasil diperbarui.';
                $alert_type = 'success';
            } elseif ($status == 'updatefailed') {
                $message = '<strong>Gagal!</strong> Terjadi kesalahan saat memperbarui data.';
                $alert_type = 'error';
            }

            if ($message) {
                echo "<div class='alert {$alert_type}'>
                        <span>{$message}</span>
                        <button class='alert-close' onclick='this.parentElement.style.display=\"none\";'>&times;</button>
                      </div>";
            }
        }
        ?>

            <div class="profile-header">
                <h1>Profil Pendaftaran Siswa</h1>
                <p>Selamat datang, <strong><?php echo htmlspecialchars($data_siswa['nama_lengkap']); ?></strong>!</p>
            </div>

            <div class="profile-data">
                <table>
                    <tr><th>Nama Lengkap</th><td><?php echo htmlspecialchars($data_siswa['nama_lengkap']); ?></td></tr>
                    <tr><th>Nama Panggilan</th><td><?php echo htmlspecialchars($data_siswa['nama_panggilan']); ?></td></tr>
                    <tr><th>Email</th><td><?php echo htmlspecialchars($data_siswa['email']); ?></td></tr>
                    <tr><th>Tempat, Tanggal Lahir</th><td><?php echo htmlspecialchars($data_siswa['tempat_lahir'] . ', ' . $data_siswa['tanggal_lahir']); ?></td></tr>
                    <tr><th>Jenis Kelamin</th><td><?php echo htmlspecialchars($data_siswa['jenis_kelamin']); ?></td></tr>
                    <tr><th>Agama</th><td><?php echo htmlspecialchars($data_siswa['agama']); ?></td></tr>
                    <tr><th>Alamat</th><td><?php echo htmlspecialchars($data_siswa['alamat']); ?></td></tr>
                    <tr><th>Telepon</th><td><?php echo htmlspecialchars($data_siswa['telepon']); ?></td></tr>
                    <tr><th>Asal Sekolah</th><td><?php echo htmlspecialchars($data_siswa['asal_sekolah']); ?></td></tr>
                    <tr><th>NISN</th><td><?php echo htmlspecialchars($data_siswa['nisn']); ?></td></tr>
                    <tr><th>Jurusan Pilihan</th><td><?php echo htmlspecialchars($data_siswa['jurusan']); ?></td></tr>
                </table>
            </div>

            <div class="profile-actions">
                <a href="edit_data.php?id=<?php echo $data_siswa['id']; ?>" class="btn">Edit Data</a>
                <a href="hapus_data.php?id=<?php echo $data_siswa['id']; ?>" class="btn" style="background-color: #e74c3c;" onclick="return confirm('Apakah Anda yakin ingin menghapus data pendaftaran Anda? Tindakan ini tidak bisa dibatalkan.');">Hapus Data</a>
            </div>
        </div>
    </main>

    <footer>
        </footer>
        <script src="../../script.js" defer></script>
</body>
</html>