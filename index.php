<!doctype html>
<html lang="en">
  <head>
  <link rel="icon" type="image/jpg" href="assets/logo.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Al-Quran Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      @font-face {
        font-family: 'uthmani';
        src: url('assets/font/UthmanicHafs1Ver09.otf') format('truetype');
      }

      body {
        background: #f5f7fa;
        font-family: 'Segoe UI', sans-serif;
      }

      .arabic {
        font-family: 'uthmani', serif;
        font-size: 20px;
        direction: rtl;
        color: #2c3e50;
      }

      h3 {
        background: linear-gradient(to right, #00b894, #0984e3);
        color: white;
        padding: 20px;
        border-radius: 12px;
        margin-top: 20px;
      }

      .table th {
        background-color: #74b9ff;
        color: white;
      }

      .table-striped tbody tr:nth-of-type(odd) {
        background-color: #dfe6e9;
      }

      .table-striped tbody tr:hover {
        background-color: #b2bec3;
        transition: 0.3s;
      }

      .btn-primary {
        background-color: #00cec9;
        border: none;
      }

      .btn-primary:hover {
        background-color: #0984e3;
      }

      .btn-danger {
        background-color: #d63031;
        border: none;
      }

      .btn-danger:hover {
        background-color: #e17055;
      }

      .input-group {
        margin-bottom: 20px;
      }

      .form-control {
        border-radius: 12px;
      }

      .container {
        margin-top: 30px;
        margin-bottom: 50px;
      }

      a {
        text-decoration: none;
        font-weight: bold;
        color: #2d3436;
      }

      a:hover {
        color: #00b894;
      }
      .welcome-banner {
  background: linear-gradient(to right, #00b894, #0984e3);
  border-radius: 16px;
  animation: fadeIn 1s ease-in-out;
  
}
.welcome-bannertf{
    background: linear-gradient(to right,rgb(24, 26, 25),rgb(155, 221, 1));
  border-radius: 16px;
  animation: fadeIn 1s ease-in-out;
  }

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

    </style>
  </head>
  <body>
    <div class="container">
      <div class="welcome-banner p-4 mb-4 text-white rounded shadow-sm text-center">
  <h4 class="fw-bold mb-2">🌿 Selamat Datang di Al-Quran Digital</h4>
  <p class="mb-0">Menelusuri petunjuk hidup dalam setiap ayat. Temukan makna dan ketenangan dalam Kalamullah yang mulia.</p>
</div>

      <hr>

      <form method="POST">
        <div class="input-group">
          <input type="text" name="tcari" value="" class="form-control" placeholder="Cari Surah...">
          <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
          <button class="btn btn-danger" name="breset" type="submit">Reset</button>
        </div>
      </form>

      <table class="table table-striped table-bordered rounded shadow-sm">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Surah</th>
            <th scope="col">Arti</th>
            <th scope="col">Jumlah Ayat</th>
            <th scope="col">Tempat Turun</th>
            <th scope="col">Urutan Pewahyuan</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            include "koneksi.php";
            if(isset($_POST['bcari'])){
              $keyword = $_POST['tcari'];
              $q = "SELECT * FROM daftarsurah 
                    WHERE arti LIKE '%$keyword%' 
                    OR surah_indonesia LIKE '%$keyword%' 
                    OR tempat_turun LIKE '%$keyword%' 
                    ORDER BY `index` ASC";
            } else {
              $q = "SELECT * FROM daftarsurah ORDER BY `index` ASC";
            }

            $tampil = mysqli_query($koneksi, $q);
            while ($data = mysqli_fetch_array($tampil)):
          ?>
          <tr>
            <td><?= $data['index'] ?></td>
            <td>
              <a href="detail.php?surah=<?= $data['index'] ?>&nama_surah=<?= $data['surah_indonesia'] ?>">
                <?= $data['surah_indonesia'] ?>
              </a>
              <span class="arabic">(<?= $data['surah_arab'] ?>)</span>
            </td>
            <td><?= $data['arti'] ?></td>
            <td><?= $data['jumlah_ayat'] ?></td>
            <td><?= $data['tempat_turun'] ?></td>
            <td><?= $data['urutan_pewahyuan'] ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

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



</html>
