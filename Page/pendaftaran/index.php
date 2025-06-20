<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pendaftaran Siswa Baru - SMA 01 Elit Harapan Bangsa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="../../styles.css" />

    <style>
      :root {
        --primary-color: #004080;
        --secondary-color: #27ae60;
        --light-color: #ecf0f1;
        --dark-color: #2c3e50;
        --shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        --transition: all 0.3s ease-in-out;
        --font-main: "Segoe UI", sans-serif;
      }

      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: var(--font-main);
      }

      body {
        background-color: #f5f5f5;
        color: #333;
        line-height: 1.6;
      }

      .container {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
      }

      /* Button Styles */
      .btn {
        background-color: var(--primary-color);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition);
      }

      .btn:hover {
        background-color: #1f6691;
      }

      /* Registration Header */
      .registration-header {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80");
        background-size: cover;
        background-position: center;
        color: white;
        text-align: center;
        padding: 100px 0;
        margin-bottom: 40px;
      }

      .registration-header h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
      }

      /* Registration Steps */
      .registration-steps {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-bottom: 40px;
        flex-wrap: wrap;
      }

      .step {
        background-color: var(--primary-color);
        color: white;
        width: 200px;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        position: relative;
      }

      .step.active {
        background-color: var(--secondary-color);
        transform: scale(1.05);
        box-shadow: var(--shadow);
      }

      .step-number {
        background-color: white;
        color: var(--primary-color);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin: 0 auto 15px;
      }

      .step.active .step-number {
        color: var(--secondary-color);
      }

      /* Registration Container */
      .registration-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
      }

      /* Form Styles */
      .form-section {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: var(--shadow);
        margin-bottom: 30px;
      }

      .form-section h2 {
        color: var(--primary-color);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--light-color);
      }

      .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
      }

      .form-group {
        flex: 1;
        margin-bottom: 15px;
      }

      .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--dark-color);
      }

      .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
        transition: var(--transition);
      }

      .form-control:focus {
        border-color: var(--primary-color);
        outline: none;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
      }

      .form-check {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
      }

      .form-check-input {
        margin-right: 10px;
      }

      .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
      }

      .btn-back {
        background-color: var(--light-color);
        color: var(--dark-color);
      }

      .btn-back:hover {
        background-color: #d5dbdb;
      }

      /* Requirements Box */
      .requirements {
        background-color: #f8f9fa;
        border-left: 4px solid var(--primary-color);
        padding: 20px;
        margin-bottom: 30px;
      }

      .requirements h3 {
        margin-top: 0;
        color: var(--primary-color);
      }

      .requirements ul {
        padding-left: 20px;
      }

      .requirements li {
        margin-bottom: 8px;
      }

      /* Registration Tabs */
      .registration-tabs {
        display: flex;
        margin-bottom: 20px;
        border-bottom: 1px solid #ddd;
      }

      .tab-btn {
        padding: 12px 24px;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark-color);
        position: relative;
        transition: var(--transition);
      }

      .tab-btn.active {
        color: var(--primary-color);
      }

      .tab-btn.active::after {
        content: "";
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--primary-color);
      }

      .tab-content {
        display: none;
      }

      .tab-content.active {
        display: block;
      }

      /* Table Styles */
      .search-filter {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        align-items: center;
      }

      .search-box {
        flex: 1;
        position: relative;
      }

      .search-box input {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border: 1px solid #ddd;
        border-radius: 6px;
      }

      .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #777;
      }

      .filter-dropdown {
        width: 200px;
      }

      .filter-dropdown select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
      }

      .registrants-table-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: var(--shadow);
        overflow-x: auto;
        margin-top: 20px;
      }

      .registrants-table {
        width: 100%;
        border-collapse: collapse;
      }

      .registrants-table th,
      .registrants-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
      }

      .registrants-table th {
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
      }

      .registrants-table tr:hover {
        background-color: #f9f9f9;
      }

      .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
      }

      .status-badge.verified {
        background-color: #d4edda;
        color: #155724;
      }

      .status-badge.pending {
        background-color: #fff3cd;
        color: #856404;
      }

      .status-badge.rejected {
        background-color: #f8d7da;
        color: #721c24;
      }

      .action-btn {
        padding: 5px 8px;
        border-radius: 4px;
        cursor: pointer;
        border: none;
        margin-right: 5px;
        transition: var(--transition);
      }

      .action-btn.view-btn {
        background-color: var(--primary-color);
        color: white;
      }

      .action-btn.edit-btn {
        background-color: #ffc107;
        color: #212529;
      }

      .action-btn.delete-btn {
        background-color: #dc3545;
        color: white;
      }

      .action-btn:hover {
        opacity: 0.8;
      }

      .table-pagination {
        display: flex;
        justify-content: center;
        padding: 20px;
        gap: 5px;
      }

      .btn-pagination {
        padding: 5px 12px;
        min-width: 40px;
      }

      .btn-pagination.active {
        background-color: var(--primary-color);
        color: white;
      }

      .btn-pagination:disabled {
        opacity: 0.5;
        cursor: not-allowed;
      }

      /* Responsive Styles */
      @media (max-width: 768px) {
        .header-container {
          flex-direction: column;
          text-align: center;
        }

        .logo {
          margin-bottom: 15px;
          justify-content: center;
        }

        nav ul {
          display: none;
          flex-direction: column;
          width: 100%;
          text-align: center;
        }

        nav ul.show {
          display: flex;
        }

        nav ul li {
          margin: 10px 0;
        }

        .mobile-menu-btn {
          display: block;
          margin-top: 15px;
        }

        .form-row {
          flex-direction: column;
          gap: 0;
        }

        .registration-steps {
          flex-direction: column;
          align-items: center;
          gap: 15px;
        }

        .step {
          width: 100%;
          max-width: 300px;
        }

        .registrants-table th,
        .registrants-table td {
          padding: 8px 10px;
          font-size: 0.9rem;
        }

        .action-btn {
          padding: 3px 5px;
          font-size: 0.8rem;
        }

        .search-filter {
          flex-direction: column;
        }

        .filter-dropdown {
          width: 100%;
        }

        .footer-container {
          grid-template-columns: 1fr;
        }
      }
    </style>
  </head>
  <body>
    <!-- Header Section -->
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
            <li><a href="../../index.html#home">Beranda</a></li>
            <li><a href="../../index.html#profile">Profil Sekolah</a></li>
            <li><a href="../../index.html#news">Berita</a></li>
            <li><a href="../../index.html#gallery">Galeri</a></li>
            <li><a href="../../index.html#calendar">Kalender</a></li>
            <li><a href="../../index.html#registration">Pendaftaran</a></li>
            <li><a href="../../index.html#blog">Blog</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <section class="registration-header">
      <div class="container">
        <h1>Formulir Pendaftaran Siswa Baru</h1>
        <p>Tahun Pelajaran 2025/2026</p>
      </div>
    </section>

    <!-- Registration Steps -->
    <div class="container">
      <div class="registration-steps">
        <div class="step active">
          <div class="step-number">1</div>
          <h3>Data Pribadi</h3>
          <p>Isi formulir data diri</p>
        </div>

        <div class="step">
          <div class="step-number"></div>
          <h3>Konfirmasi</h3>
          <p>Review & submit</p>
        </div>
      </div>
    </div>

    <!-- Registration Container with Tabs -->
    <div class="registration-container">
      <div class="registration-tabs">
        <button class="tab-btn active" data-tab="form">Form Pendaftaran</button>
        <button class="tab-btn" data-tab="list">Daftar Pendaftar</button>
      </div>

      <!-- Form Tab Content -->
      <div id="form-tab" class="tab-content active">
        <div class="requirements">
          <h3>Persyaratan Pendaftaran:</h3>
          <ul>
            <li>Usia maksimal 21 tahun pada tanggal 1 Juli 2023</li>
            <li>Fotokopi rapor SMP/sederajat semester 1-5</li>
            <li>Fotokopi ijazah SMP/sederajat (jika sudah lulus)</li>
            <li>Pas foto 3x4 (latar belakang merah) sebanyak 2 lembar</li>
            <li>Fotokopi akta kelahiran dan KK</li>
            <li>Sertifikat prestasi (jika ada)</li>
          </ul>
          <p><strong>Pendaftaran Gelombang 1:</strong> 1 Juni - 30 Juli 2023</p>
        </div>

        <form id="registrationForm" method="POST" action="pendaftaran.php">
          <!-- Personal Data Section -->
          <div class="form-section">
            <h2>Data Pribadi Calon Siswa</h2>

            <div class="form-row">
              <div class="form-group">
                <label for="fullName">Nama Lengkap</label>
                <input type="text" id="fullName" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="nickName">Nama Panggilan</label>
                <input type="text" id="nickName" class="form-control" required />
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="birthPlace">Tempat Lahir</label>
                <input type="text" id="birthPlace" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="birthDate">Tanggal Lahir</label>
                <input type="date" id="birthDate" class="form-control" required />
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="gender">Jenis Kelamin</label>
                <select id="gender" class="form-control" required>
                  <option value="">Pilih Jenis Kelamin</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="religion">Agama</label>
                <select id="religion" class="form-control" required>
                  <option value="">Pilih Agama</option>
                  <option value="Islam">Islam</option>
                  <option value="Kristen">Kristen</option>
                  <option value="Katolik">Katolik</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Buddha">Buddha</option>
                  <option value="Konghucu">Konghucu</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="address">Alamat Lengkap</label>
              <textarea id="address" class="form-control" rows="3" required></textarea>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="phone">Nomor Telepon/HP</label>
                <input type="tel" id="phone" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" required />
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="previousSchool">Asal Sekolah</label>
                <input type="text" id="previousSchool" class="form-control" required />
              </div>
              <div class="form-group">
                <label for="nisn">NISN (Nomor Induk Siswa Nasional)</label>
                <input type="text" id="nisn" class="form-control" required />
              </div>
            </div>

            <div class="form-group">
              <label for="program">Pilih Jurusan</label>
              <select id="program" class="form-control" required>
                <option value="">Pilih jurusan</option>
                <option value="IPA">Ilmu Pengetahuan Alam (IPA)</option>
                <option value="IPS">Ilmu Pengetahuan Sosial (IPS)</option>
                <option value="Bahasa">Ilmu Bahasa Indonesia dan Budaya</option>
              </select>
            </div>
          </div>

          <!-- Confirmation Section -->
          <div class="form-section">
            <h2>Konfirmasi Pendaftaran</h2>

            <div class="form-check">
              <input type="checkbox" id="agreeData" class="form-check-input" required />
              <label for="agreeData" class="form-check-label">Saya menyatakan bahwa data yang diisi adalah benar dan dapat dipertanggungjawabkan</label>
            </div>

            <div class="form-check">
              <input type="checkbox" id="agreeRules" class="form-check-input" required />
              <label for="agreeRules" class="form-check-label">Saya bersedia mematuhi semua peraturan dan tata tertib SMA 01 Elit Harapan Bangsa</label>
            </div>

            <div class="form-actions">
              <button type="button" class="btn btn-back">Kembali</button>
              <button type="submit" class="btn">Kirim Pendaftaran</button>
            </div>
          </div>
        </form>
      </div>

      <!-- List Tab Content -->
      <div id="list-tab" class="tab-content">
        <div class="search-filter">
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Cari pendaftar..." id="searchInput" />
          </div>
          <div class="filter-dropdown">
            <select id="filterProgram">
              <option value="">Semua Jurusan</option>
              <option value="IPA">IPA</option>
              <option value="IPS">IPS</option>
              <option value="Bahasa">Bahasa</option>
            </select>
          </div>
          <button class="btn" id="exportBtn"><i class="fas fa-download"></i> Export Data</button>
        </div>

        <div class="registrants-table-container">
          <table class="registrants-table">
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
              <?php
    $conn = new mysqli("localhost", "root", "", "db_sekolah");
    $result = $conn->query("SELECT * FROM pendaftar"); $no = 1; while ($row = $result->fetch_assoc()) { echo "
              <tr>
                <td>".$no++."</td>
                <td>".$row['nama_lengkap']."</td>
                <td>".$row['alamat']."</td>
                <td>".$row['jenis_kelamin']."</td>
                <td>".$row['agama']."</td>
                <td>".$row['asal_sekolah']."</td>
                <td>".$row['jurusan']."</td>
              </tr>
              "; } $conn->close(); ?>
            </tbody>
          </table>

          <div class="table-pagination">
            <button class="btn btn-pagination" disabled><i class="fas fa-chevron-left"></i></button>
            <button class="btn btn-pagination active">1</button>
            <button class="btn btn-pagination">2</button>
            <button class="btn btn-pagination">3</button>
            <button class="btn btn-pagination"><i class="fas fa-chevron-right"></i></button>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="footer-container">
          <div class="footer-col">
            <h3>Tentang Kami</h3>
            <p>SMA 01 ELITE HARAPAN BANGSA adalah sekolah unggulan yang berkomitmen untuk memberikan pendidikan terbaik bagi generasi penerus bangsa.</p>
            <div class="social-links">
              <a target="_blank" href="https://www.facebook.com/univmercubuana/"><i class="fab fa-facebook-f"></i></a>
              <a target="_blank" href="https://www.linkedin.com/school/universitas-mercu-buana/posts/?feedView=all"><i class="fab fa-linkedin"></i></a>
              <a target="_blank" href="https://www.instagram.com/univmercubuana/"><i class="fab fa-instagram"></i></a>
              <a target="_blank" href="https://www.youtube.com/@mercutvofficial"><i class="fab fa-youtube"></i></a>
            </div>
          </div>

          <div class="footer-col">
            <h3>Link Cepat</h3>
            <ul class="footer-links">
              <li><a href="#home">Beranda</a></li>
              <li><a href="#profile">Profil Sekolah</a></li>
              <li><a href="#news">Berita</a></li>
              <li><a href="#gallery">Galeri</a></li>
              <li><a href="#calendar">Kalender</a></li>
              <li><a href="#registration">Pendaftaran</a></li>
              <li><a href="#blog">Blog</a></li>
            </ul>
          </div>

          <div class="footer-col">
            <h3>Kontak Kami</h3>
            <p><i class="fas fa-map-marker-alt"></i> Jl elite. Pendidikan No. 123, Kota jakarta elite</p>
            <p><i class="fas fa-phone"></i> (021) 1234567</p>
            <p><i class="fas fa-envelope"></i> info@sma01elite.sch.id</p>
            <p><i class="fas fa-clock"></i> Senin-Jumat: 07.00 - 16.00 WIB</p>
          </div>

          <div class="footer-col">
            <h3>Peta Lokasi</h3>
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613507864!3d-6.194741395493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5390917b759%3A0x6b45e839560a85ab!2sMonumen%20Nasional!5e0!3m2!1sen!2sid!4v1623836333171!5m2!1sen!2sid"
              width="100%"
              height="200"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
            ></iframe>
          </div>
        </div>

        <div class="footer-bottom">
          <p>&copy; 2025 SMA 01 ELITE HARAPAN BANGSA. Semua Hak Dilindungi.</p>
        </div>
      </div>
    </footer>

    <script>
      // Mobile Menu Toggle
      document.getElementById("mobileMenuBtn").addEventListener("click", function () {
        const nav = document.getElementById("mainNav").querySelector("ul");
        nav.classList.toggle("show");
      });

      // Tab functionality
      const tabBtns = document.querySelectorAll(".tab-btn");
      const tabContents = document.querySelectorAll(".tab-content");

      tabBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
          const tabId = this.getAttribute("data-tab");

          // Remove active class from all buttons and contents
          tabBtns.forEach((btn) => btn.classList.remove("active"));
          tabContents.forEach((content) => content.classList.remove("active"));

          // Add active class to clicked button and corresponding content
          this.classList.add("active");
          document.getElementById(`${tabId}-tab`).classList.add("active");
        });
      });

      // Search functionality
      const searchInput = document.getElementById("searchInput");
      searchInput.addEventListener("keyup", function () {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll(".registrants-table tbody tr");

        rows.forEach((row) => {
          const name = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
          const school = row.querySelector("td:nth-child(6)").textContent.toLowerCase();

          if (name.includes(searchTerm) || school.includes(searchTerm)) {
            row.style.display = "";
          } else {
            row.style.display = "none";
          }
        });
      });

      // Filter functionality
      const filterProgram = document.getElementById("filterProgram");
      filterProgram.addEventListener("change", function () {
        const selectedProgram = this.value;
        const rows = document.querySelectorAll(".registrants-table tbody tr");

        rows.forEach((row) => {
          const program = row.querySelector("td:nth-child(7)").textContent;

          if (selectedProgram === "" || program === selectedProgram) {
            row.style.display = "";
          } else {
            row.style.display = "none";
          }
        });
      });

      // Export button functionality
      document.getElementById("exportBtn").addEventListener("click", function () {
        alert("Data berhasil diekspor dalam format CSV");
        // In a real implementation, this would generate and download a CSV file
      });

      // Form submission
      document.getElementById("registrationForm").addEventListener("submit", function (e) {
        e.preventDefault();
        alert("Formulir pendaftaran berhasil dikirim!");
      });
    </script>
  </body>
</html>
