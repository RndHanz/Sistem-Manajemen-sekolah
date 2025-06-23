<?php
session_start();

// 1. Cek otentikasi: Apakah user sudah login?
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}

$user_id_session = $_SESSION['user_id'];
$pendaftar_id = $_GET['id'] ?? 0; // Ambil ID pendaftar dari URL

if ($pendaftar_id == 0) {
    die("Error: ID Pendaftar tidak valid.");
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "db_sekolah");
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Ambil data pendaftar dari database
$stmt = $conn->prepare("SELECT * FROM pendaftar WHERE id = ?");
$stmt->bind_param("i", $pendaftar_id);
$stmt->execute();
$result = $stmt->get_result();
$data_siswa = $result->fetch_assoc();
$stmt->close();

// 2. Cek Otorisasi: Apakah data yang mau diedit adalah milik user yang sedang login?
// Ini adalah bagian keamanan yang paling KRUSIAL!
if (!$data_siswa || $data_siswa['user_id'] != $user_id_session) {
    $conn->close();
    die("<h1>Akses Ditolak!</h1><p>Anda tidak memiliki izin untuk mengedit data ini.</p>");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pendaftaran</title>
    <link rel="stylesheet" href="../../styles.css" />
    <style>
        body { background-color: #f5f5f5; }
        .form-container { max-width: 800px; margin: 40px auto; padding: 30px; background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: var(--primary-color); margin-bottom: 30px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
        .form-actions { display: flex; justify-content: space-between; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Edit Data Pendaftaran</h1>
        <form action="update_data.php" method="POST">
            <input type="hidden" name="pendaftar_id" value="<?php echo $data_siswa['id']; ?>">

            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo htmlspecialchars($data_siswa['nama_lengkap']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nama_panggilan">Nama Panggilan</label>
                <input type="text" id="nama_panggilan" name="nama_panggilan" value="<?php echo htmlspecialchars($data_siswa['nama_panggilan']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email (tidak dapat diubah)</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($data_siswa['email']); ?>" readonly disabled>
            </div>
            
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" value="<?php echo htmlspecialchars($data_siswa['tempat_lahir']); ?>" required />
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo htmlspecialchars($data_siswa['tanggal_lahir']); ?>" required />
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required>
                  <option value="Laki-laki" <?php if($data_siswa['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                  <option value="Perempuan" <?php if($data_siswa['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($data_siswa['alamat']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="telepon">Nomor Telepon/HP</label>
                <input type="tel" id="telepon" name="telepon" value="<?php echo htmlspecialchars($data_siswa['telepon']); ?>" required />
            </div>
            <div class="form-group">
                <label for="asal_sekolah">Asal Sekolah</label>
                <input type="text" id="asal_sekolah" name="asal_sekolah" value="<?php echo htmlspecialchars($data_siswa['asal_sekolah']); ?>" required />
            </div>
             <div class="form-group">
                <label for="jurusan">Pilih Jurusan</label>
                <select id="jurusan" name="jurusan" required>
                    <option value="IPA" <?php if($data_siswa['jurusan'] == 'IPA') echo 'selected'; ?>>Ilmu Pengetahuan Alam (IPA)</option>
                    <option value="IPS" <?php if($data_siswa['jurusan'] == 'IPS') echo 'selected'; ?>>Ilmu Pengetahuan Sosial (IPS)</option>
                    <option value="Bahasa" <?php if($data_siswa['jurusan'] == 'Bahasa') echo 'selected'; ?>>Ilmu Bahasa Indonesia dan Budaya</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Simpan Perubahan</button>
                <a href="profile.php" class="btn" style="background-color: #7f8c8d;">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
<?php
$conn->close();
?>