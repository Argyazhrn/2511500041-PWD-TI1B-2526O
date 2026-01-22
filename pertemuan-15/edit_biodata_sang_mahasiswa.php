<?php
  session_start();
  require 'koneksi.php';
  require 'fungsi.php';

  $cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
  ]);

  if (!$cid) {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('edit_biodata_sang_mahasiswa.php');
  }

  $stmt = mysqli_prepare($conn, "SELECT nim, nama_lengkap, tempat_lahir, tanggal_lahir, hobi, pasangan, pekerjaan, nama_orang_tua, nama_kakak, nama_adik
                                FROM biodata_sang_mahasiswa
                                WHERE cid = ? LIMIT 1");
                                     

   if (!$stmt) {
    $_SESSION['flash_error'] = 'Query tidak benar.';
    redirect_ke('read_biodata_sang_mahasiswa.php');
  }

  mysqli_stmt_bind_param($stmt, "i", $cid);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($res);
  mysqli_stmt_close($stmt);

  if (!$row) {
    $_SESSION['flash_error'] = 'Record tidak ditemukan.';
    redirect_ke('edit_biodata_sang_mahasiswa.php');
  }

  #Nilai awal (prefill form)
  $nim            = $row['nim'] ?? '';
  $nama_lengkap   = $row['nama_lengkap'] ?? '';
  $tempat_lahir   = $row['tempat_lahir'] ?? '';
  $tanggal_lahir  = $row['tanggal_lahir'] ?? '';
  $hobi           = $row['hobi'] ?? '';
  $pasangan       = $row['pasangan'] ?? '';
  $pekerjaan      = $row['pekerjaan'] ?? '';
  $nama_orang_tua = $row['nama_orang_tua'] ?? '';
  $nama_kakak     = $row['nama_kakak'] ?? '';
  $nama_adik      = $row['nama_adik'] ?? '';

  #Ambil error dan nilai old input kalau ada
  $flash_error = $_SESSION['flash_error'] ?? '';
  $old = $_SESSION['old'] ?? [];
  unset($_SESSION['flash_error'], $_SESSION['old']);

  if (!empty($old)) {
  $nim            = $old['nim']            ?? $nim;
  $nama_lengkap   = $old['nama_lengkap']   ?? $nama_lengkap;
  $tempat_lahir   = $old['tempat_lahir']   ?? $tempat_lahir;
  $tanggal_lahir  = $old['tanggal_lahir']  ?? $tanggal_lahir;
  $hobi           = $old['hobi']           ?? $hobi;
  $pasangan       = $old['pasangan']       ?? $pasangan;
  $pekerjaan      = $old['pekerjaan']      ?? $pekerjaan;
  $nama_orang_tua = $old['nama_orang_tua'] ?? $nama_orang_tua;
  $nama_kakak     = $old['nama_kakak']     ?? $nama_kakak;
  $nama_adik      = $old['nama_adik']      ?? $nama_adik;
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
        <form action="update_biodata_sang_mahasiswa.php" method="POST">

          <input type="text" name="cid" value="<?= (int)$cid; ?>">

        <label for="txtNim"><span>NIM:</span>
          <input type="text" id="txtnim" name="txtnim"
       value="<?= htmlspecialchars($nim); ?>"
       placeholder="Masukkan NIM" required readonly>
        </label>

        <label for="txtnama_lengkap"><span>Nama Lengkap:</span>
          <input type="text" id="txtnama_lengkap" name="txtnama_lengkap"
         value="<?= htmlspecialchars($nama_lengkap); ?>"
         placeholder="Masukkan Nama Lengkap" required>
        </label>

        <label for="txttempat_lahir"><span>Tempat Lahir:</span>
          <input type="text" id="txttempat_lahir" name="txttempat_lahir"
         value="<?= htmlspecialchars($tempat_lahir); ?>"
         placeholder="Masukkan Tempat Lahir" required>
        </label>

        <label for="txttanggal_lahir"><span>Tanggal Lahir:</span>
          <input type="text" id="txttanggal_lahir" name="txttanggal_lahir"
         value="<?= htmlspecialchars($tanggal_lahir); ?>"
         placeholder="Masukkan Tanggal Lahir" required>
        </label>

        <label for="txtHobi"><span>Hobi:</span>
          <input type="text" id="txthobi" name="txthobi"
         value="<?= htmlspecialchars($hobi); ?>"
         placeholder="Masukkan Hobi" required>
        </label>

        <label for="txtPasangan"><span>Pasangan:</span>
          <input type="text" id="txtpasangan" name="txtpasangan"
         value="<?= htmlspecialchars($pasangan); ?>"
         placeholder="Masukkan Pasangan" required>
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

        <label for="txtnama_kakak"><span>Nama Kakak:</span>
          <input type="text" id="txtnama_kakak" name="txtnama_kakak"
         value="<?= htmlspecialchars($nama_kakak); ?>"
         placeholder="Masukkan Nama Kakak" required>
        </label>

        <label for="txtnama_adik"><span>Nama Adik:</span>
          <input type="text" id="txtnama_adik" name="txtnama_adik"
         value="<?= htmlspecialchars($nama_adik); ?>"
         placeholder="Masukkan Nama Adik" required>
        </label>

    <button type="submit">Kirim</button>
    <button type="reset">Batal</button>
        <a href="edit_biodata_sang_mahasiswa.php" class="reset">Kembali</a>
  </form>
</section>
</main>

    <script src="script.js"></script>
  </body>
</html>