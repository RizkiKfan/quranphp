<!doctype html>
<html lang="en">
  <head>
      <link rel="icon" type="image/jpg" href="assets/logo.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Al-Qur'an Digital</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> 
      @font-face {
        font-family: 'uthmani';
        src: url('assets/font/UthmanicHafs1Ver09.otf') format('truetype');      
      }

      body {
        background: linear-gradient(to bottom right, #e6f2ff, #fefefe);
        font-family: 'Segoe UI', sans-serif;
        color: #333;
      }

      .arabic {
        font-family: 'uthmani', serif;
        font-size: 26px;
        direction: rtl;
        color: #2c3e50;
      }

      .latin {
        font-family: 'Georgia', serif;
        font-size: 17px;
        direction: ltr;
        color: #444;
      }

      .arabic_number {
        font-size: 22px;
        color: #28a745;
        margin-left: 10px;
      }

      .surah-title {
        background: linear-gradient(to right, #0d6efd, #4dabf7);
        color: white;
        padding: 14px 20px;
        border-radius: 12px;
        text-align: center;
        margin: 20px 0;
        font-weight: bold;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      }

      .ayat-card {
        background: #ffffff;
        border: 1px solid #dbeafe;
        border-left: 6px solid #0d6efd;
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 18px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        transition: transform 0.2s ease, box-shadow 0.3s ease;
      }

      .ayat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        border-left-color: #0dcaf0;
      }

      .btn-outline-primary {
        border-radius: 30px;
        padding: 8px 16px;
        font-weight: 500;
      }
      .welcome-bannertf{
    background: rgb(24, 26, 25);
  border-radius: 16px;
  animation: fadeIn 1s ease-in-out;
  }

    </style>
  </head>
  <body>
    <div class="container py-4">
      <?php
        include 'koneksi.php';

        if (isset($_GET['surah']) || isset($_GET['nama_surah'])) {
            $surah = $_GET['surah'];
            $nama_surah = $_GET['nama_surah'];
            $keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';

            echo '<a href="index.php" class="btn btn-outline-primary mb-3">⬅ Kembali ke Index</a>';
            echo '<div class="surah-title h4">' . htmlspecialchars($nama_surah) . '</div>';

            // Form pencarian
            echo '<form method="GET" class="mb-4">';
            echo '<input type="hidden" name="surah" value="' . htmlspecialchars($surah) . '">';
            echo '<input type="hidden" name="nama_surah" value="' . htmlspecialchars($nama_surah) . '">';
            echo '<input type="text" name="keyword" class="form-control" placeholder="Cari kata dalam terjemahan atau ayat..." value="' . htmlspecialchars($keyword) . '">';
            echo '</form>';

            // Query
            $query = "SELECT a.text as arabic, b.text as indonesia 
                      FROM arabicquran a 
                      LEFT OUTER JOIN indonesianquran b ON a.index = b.index 
                      WHERE a.surah = $surah";

            if (!empty($keyword)) {
                $query .= " AND (a.text LIKE '%$keyword%' OR b.text LIKE '%$keyword%')";
            }

            $tampil = mysqli_query($koneksi, $query);

            if (mysqli_num_rows($tampil) == 0) {
                echo '<div class="alert alert-warning">Tidak ditemukan ayat yang mengandung kata <strong>' . htmlspecialchars($keyword) . '</strong>.</div>';
            }

            $ayat = 1;
            while ($data = mysqli_fetch_array($tampil)) {
                $str = $data['arabic'];
                echo '<div class="ayat-card">';
                echo '<p class="arabic">' . $str . format_arabic_number($ayat) . '</p>';
                echo '<p class="latin">[' . $ayat . '] ' . $data['indonesia'] . '</p>';
                echo '</div>';
                $ayat++;
            }
        }

        function format_arabic_number($number) {
            $arabic_number = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
            $jum_karakter = strlen($number);
            $temp = "";
            for ($i = 0; $i < $jum_karakter; $i++) {
                $char = substr($number, $i, 1);
                $temp .= $arabic_number[$char];
            }
            return '<span class="arabic_number">' . $temp . '</span>';
        }
      ?>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
    <!-- Modal Tentang Aplikasi -->
<div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="aboutModalLabel">Tentang Al-Qur'an Digital</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Al-Qur'an Digital</strong> adalah aplikasi web sederhana yang dirancang untuk memudahkan pencarian dan eksplorasi surah dalam Al-Qur'an. Aplikasi ini dilengkapi dengan fitur pencarian cepat, tampilan responsif, dan pengalaman pengguna yang nyaman.</p>
        <p>Dikembangkan oleh <strong>Rizky Kurnia Fajri Nur</strong> sebagai bagian dari eksplorasi teknologi web dan dakwah digital. Semoga bermanfaat dan menjadi amal jariyah.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Kontak -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="contactModalLabel">Saran & Masukan</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="mailto:rizkinur047@gmail.com" method="post" enctype="text/plain">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Anda</label>
            <input type="text" class="form-control" id="nama" name="Nama" required>
          </div>
          <div class="mb-3">
            <label for="pesan" class="form-label">Pesan / Saran</label>
            <textarea class="form-control" id="pesan" name="Pesan" rows="4" required></textarea>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-success">Kirim</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </form>
        <div class="mt-3 text-center small text-muted">
          Atau hubungi via <a href="https://instagram.com/rizki_kfan" target="_blank">@rizki_kfan</a>
        </div>
      </div>
    </div>
  </div>
</div>

<footer>
  <div class="welcome-bannertf text-white text-center rounded shadow-sm p-4 mt-4">
    <h6 class="mb-2">Copyright © Rizky Kurnia Fajri Nur 2025</h6>
    <div class="d-flex justify-content-center gap-2 mt-2 flex-wrap">
      <button type="button" class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#aboutModal">
        Tentang Aplikasi
      </button>
      <button type="button" class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#contactModal">
        Saran & Masukan
      </button>
    </div>
  </div>
</footer>

  </footer>
</html>
