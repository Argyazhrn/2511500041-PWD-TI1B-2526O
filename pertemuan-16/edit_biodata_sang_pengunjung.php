<?php
  session_start();
  require 'koneksi.php';
  require 'fungsi.php';

  $cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
  ]);

  if (!$cid) {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('read_biodata_sang_pengunjung.php');
  }

  $stmt = mysqli_prepare($conn, "SELECT cid, kode_pengunjung, nama_pengunjung, alamat_rumah, tanggal_kunjungan, Hobi, asal_slta, pekerjaan, nama_orang_tua, nama_pacar, nama_mantan
                                    FROM biodata_sang_pengunjung WHERE cid = ? LIMIT 1");
  if (!$stmt) {
    $_SESSION['flash_error'] = 'Query tidak benar.';
    redirect_ke('read_biodata_sang_pengunjung.php');
  }

  mysqli_stmt_bind_param($stmt, "i", $cid);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($res);
  mysqli_stmt_close($stmt);

  if (!$row) {
    $_SESSION['flash_error'] = 'Record tidak ditemukan.';
    redirect_ke('read_biodata_sang_pengunjung.php');
  }

  #Nilai awal (prefill form)
  $kode_pengunjung    = $row['kode_pengunjung'] ?? '';
  $nama_pengunjung    = $row['nama_pengunjung'] ?? '';
  $alamat_rumah       = $row['alamat_rumah'] ?? '';
  $tanggal_kunjungan  = $row['tanggal_kunjungan'] ?? '';
  $hobi               = $row['hobi'] ?? '';
  $asal_slta          = $row['asal_slta'] ?? '';
  $pekerjaan          = $row['pekerjaan'] ?? '';
  $nama_orang_tua     = $row['nama_orang_tua'] ?? '';
  $nama_pacar         = $row['nama_pacar'] ?? '';
  $nama_mantan        = $row['nama_mantan'] ?? '';


  #Ambil error dan nilai old input kalau ada
  $flash_error = $_SESSION['flash_error'] ?? '';
  $old = $_SESSION['old'] ?? [];
  unset($_SESSION['flash_error'], $_SESSION['old']);
  
  if (!empty($old)) {
  $kode_pengunjung   = $old['kode_pengunjung'] ?? '';
  $nama_pengunjung   = $old['nama_pengunjung'] ?? '';
  $alamat_rumah      = $old['alamat_rumah'] ?? '';
  $tanggal_kunjungan = $old['tanggal_kunjungan'] ?? '';
  $hobi              = $old['hobi'] ?? '';
  $asal_slta         = $old['asal_slta'] ?? '';
  $pekerjaan         = $old['pekerjaan'] ?? '';
  $nama_orang_tua    = $old['nama_orang_tua'] ?? '';
  $nama_pacar        = $old['nama_pacar'] ?? '';
  $nama_mantan       = $old['nama_mantan'] ?? '';
  }
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Judul Halaman</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <h1>Ini Header</h1>
      <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
        &#9776;
      </button>
      <nav>
        <ul>
          <li><a href="#home">Beranda</a></li>
          <li><a href="#about">Tentang</a></li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
      </nav>
    </header>

    <main>
      <section id="contact">
        <h2>Edit Buku Tamu</h2>
        <?php if (!empty($flash_error)): ?>
          <div style="padding:10px; margin-bottom:10px; 
            background:#f8d7da; color:#721c24; border-radius:6px;">
            <?= $flash_error; ?>
          </div>
        <?php endif; ?>
        <form action="update_biodata_sang_pengunjung.php" method="POST">

          <input type="text" name="cid" value="<?= (int)$cid; ?>">

          <label for="txtkode_pengunjung"><span>Kode Pengunjung:</span>
          <input type="text" id="txtkode_pengunjung" name="txtkode_pengunjung"
       value="<?= htmlspecialchars($kode_pengunjung); ?>"
       placeholder="Masukkan Kode Pengunjung" required readonly>
        </label>

        <label for="txtnama_pengunjung"><span>Nama Pengunjung:</span>
          <input type="text" id="txtnama_pengunjung" name="txtnama_pengunjung"
         value="<?= htmlspecialchars($nama_pengunjung); ?>"
         placeholder="Masukkan Nama pengunjung" required>
        </label>

        <label for="txtalamat_rumah"><span>Alamat Rumah:</span>
          <input type="text" id="txtalamat_rumah" name="txtalamat_rumah"
         value="<?= htmlspecialchars($alamat_rumah); ?>"
         placeholder="Masukkan Alamat Rumah" required>
        </label>

        <label for="txttanggal_kunjungan"><span>Tanggal Kunjungan:</span>
          <input type="text" id="txttanggal_kunjungan" name="txttanggal_kunjungan"
         value="<?= htmlspecialchars($tanggal_kunjungan); ?>"
         placeholder="Masukkan Tanggal kunjungan" required>
        </label>

        <label for="txtHobi"><span>Hobi:</span>
          <input type="text" id="txthobi" name="txthobi"
         value="<?= htmlspecialchars($hobi); ?>"
         placeholder="Masukkan Hobi" required>
        </label>

        <label for="txtasal_slta"><span>Asal SLTA:</span>
          <input type="text" id="txtasal_slta" name="txtasal_slta"
         value="<?= htmlspecialchars($asal_slta); ?>"
         placeholder="Masukkan Asal SLTA" required>
        </label>

        <label for="txtpekerjaan"><span>Pekerjaan:</span>
          <input type="text" id="txtpekerjaan" name="txtpekerjaan"
         value="<?= htmlspecialchars($pekerjaan); ?>"
         placeholder="Masukkan Pekerjaan" required>
        </label>

        <label for="txtnama_orang_tua"><span>Nama Orang Tua:</span>
          <input type="text" id="txtnama_orang_tua" name="txtnama_orang_tua"
         value="<?= htmlspecialchars($nama_orang_tua); ?>"
         placeholder="Masukkan Nama Orang Tua" required>
        </label>

        <label for="txtnama_pacar"><span>Nama Pacar:</span>
          <input type="text" id="txtnama_pacar" name="txtnama_pacar"
         value="<?= htmlspecialchars($nama_pacar); ?>"
         placeholder="Masukkan Nama pacar" required>
        </label>

        <label for="txtnama_mantan"><span>Nama Mantan:</span>
          <input type="text" id="txtnama_mantan" name="txtnama_mantan"
         value="<?= htmlspecialchars($nama_mantan); ?>"
         placeholder="Masukkan Nama Mantan" required>
        </label>

          <button type="submit">Kirim</button>
          <button type="reset">Batal</button>
          <a href="edit_biodata_sang_pengunjung.php" class="reset">Kembali</a>
        </form>
      </section>
    </main>

    <script src="script.js"></script>
  </body>
</html>