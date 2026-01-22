<?php
  session_start();
  require __DIR__ . '/koneksi.php';
  require_once __DIR__ . '/fungsi.php';

  #cek method form, hanya izinkan POST
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('read_biodata_sang_pengunjung.php');
  }

  #validasi cid wajib angka dan > 0
  $cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
  ]);

  if (!$cid) {
    $_SESSION['flash_error'] = 'CID Tidak Valid.';
    redirect_ke('edit_biodata_sang_pengunjung.php?cid='. (int)$cid);
  }

  #ambil dan bersihkan (sanitasi) nilai dari form
  $kode_pengunjung  = bersihkan($_POST['txtkode_pengunjung']  ?? '');
  $nama_pengunjung = bersihkan($_POST['txtnama_pengunjung'] ?? '');
  $alamat_rumah = bersihkan($_POST['txtalamat_rumah'] ?? '');
  $tanggal_kunjungan = bersihkan($_POST['txttanggal_kunjungan'] ?? '');
  $hobi  = bersihkan($_POST['txthobi']  ?? '');
  $asal_slta = bersihkan($_POST['txtasal_slta'] ?? '');
  $pekerjaan = bersihkan($_POST['txtpekerjaan'] ?? '');
  $nama_orang_tua = bersihkan($_POST['txtnama_orang_tua'] ?? '');
  $nama_pacar  = bersihkan($_POST['txtnama_pacar']  ?? '');
  $nama_mantan = bersihkan($_POST['txtnama_mantan'] ?? '');

  #Validasi sederhana
  $errors = []; #ini array untuk menampung semua error yang ada

  if ($kode_pengunjung === '') {
    $errors['nim'] = 'Kode Pengunjung wajib diisi.';
}


  if ($nama_pengunjung === '') {
    $errors[] = 'Nama Pengunjung wajib diisi.';
  }

  if ($tanggal_kunjungan === '') {
    $errors[] = 'Tanggal Kunjungan wajib diisi.';
  }

  if ($alamat_rumah === '') {
    $errors[] = 'Alamat Rumah wajib diisi.';
  }

  if ($hobi === '') {
    $errors[] = 'Hobi wajib diisi.';
  }

  if ( $asal_slta === '') {
    $errors[] = 'Asal SLTA wajib diisi.';
  }

  if ($pekerjaan === '') {
    $errors[] = 'Pekerjaan wajib diisi.';
  }

  if ($nama_orang_tua === '') {
    $errors[] = 'Nama orang tua wajib diisi.';
  }

  if ($nama_pacar === '') {
    $errors[] = 'Nama Pacar wajib diisi.';
  }

  if ($nama_mantan === '') {
    $errors[] = 'Nama Mantan wajib diisi.';
  }

if ($kode_pengunjung !== '' && (mb_strlen($kode_pengunjung, 'UTF-8') < 3 || mb_strlen($kode_pengunjung, 'UTF-8') > 20)) {
    $errors[] = 'Kode pengunjung harus 3–20 karakter.';
}

if ($nama_pengunjung !== '' && mb_strlen($nama_pengunjung, 'UTF-8') < 5) {
    $errors[] = 'Nama pengunjung minimal 5 karakter.';
}

if ($alamat_rumah !== '' && mb_strlen($alamat_rumah, 'UTF-8') < 10) {
    $errors[] = 'Alamat rumah minimal 10 karakter.';
}

if ($tanggal_kunjungan !== '' && mb_strlen($tanggal_kunjungan, 'UTF-8') < 8) {
    $errors[] = 'Tanggal kunjungan tidak valid.';
}

if ($hobi !== '' && mb_strlen($hobi, 'UTF-8') > 100) {
    $errors[] = 'Hobi maksimal 100 karakter.';
}

if ($asal_slta !== '' && mb_strlen($asal_slta, 'UTF-8') < 3) {
    $errors[] = 'Asal SLTA minimal 3 karakter.';
}

if ($pekerjaan !== '' && mb_strlen($pekerjaan, 'UTF-8') < 3) {
    $errors[] = 'Pekerjaan minimal 3 karakter.';
}

if ($nama_orang_tua !== '' && mb_strlen($nama_orang_tua, 'UTF-8') < 3) {
    $errors[] = 'Nama orang tua minimal 3 karakter.';
}

if ($nama_pacar !== '' && mb_strlen($nama_pacar, 'UTF-8') < 3) {
    $errors[] = 'Nama pacar minimal 3 karakter.';
}

if ($nama_mantan !== '' && mb_strlen($nama_mantan, 'UTF-8') < 3) {
    $errors[] = 'Nama mantan minimal 3 karakter.';
}

  # jika ada error
if (!empty($errors)) {
    $_SESSION['old'] = [
        'kode_pengunjung' => $kode_pengunjung,
        'nama_pengunjung' => $nama_pengunjung,
        'alamat_rumah'    => $alamat_rumah,
        'tanggal_kunjungan'=> $tanggal_kunjungan,
        'hobi'            => $hobi,
        'asal_slta'       => $asal_slta,
        'pekerjaan'       => $pekerjaan,
        'nama_orang_tua'  => $nama_orang_tua,
        'nama_pacar'      => $nama_pacar,
        'nama_mantan'     => $nama_mantan,
    ];


    $_SESSION['flash_error'] = implode('<br>', $errors);
    redirect_ke('edit_biodata_sang_pengunjung.php?cid='. (int)$cid);
  }

  $stmt = mysqli_prepare(
    $conn,
    "UPDATE pengunjung
     SET kode_pengunjung = ?,
         nama_pengunjung = ?,
         alamat_rumah = ?,
         tanggal_kunjungan = ?,
         hobi = ?,
         asal_slta = ?,
         pekerjaan = ?,
         nama_orang_tua = ?,
         nama_pacar = ?,
         nama_mantan = ?
     WHERE cid = ?"
);

  if (!$stmt) {
    #jika gagal prepare, kirim pesan error (tanpa detail sensitif)
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('edit_biodata_sang_pengunjung.php?cid='. (int)$cid);
  }

  #bind parameter dan eksekusi (s = string, i = integer)
  mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssi",
    $kode_pengunjung,
    $nama_pengunjung,
    $alamat_rumah,
    $tanggal_kunjungan,
    $hobi,
    $asal_slta,
    $pekerjaan,
    $nama_orang_tua,
    $nama_pacar,
    $nama_mantan,
    $cid
);

  if (mysqli_stmt_execute($stmt)) { #jika berhasil, kosongkan old value
    unset($_SESSION['old']);
    
    $_SESSION['flash_sukses'] = 'Terima kasih, data Anda sudah diperbaharui.';
    redirect_ke('read.php'); #pola PRG: kembali ke data dan exit()
  } else { # jika gagal, simpan kembali old value dan tampilkan error umum
    $_SESSION['old'] = [
        'kode_pengunjung' => $kode_pengunjung,
        'nama_pengunjung' => $nama_pengunjung,
        'alamat_rumah'    => $alamat_rumah,
        'tanggal_kunjungan'=> $tanggal_kunjungan,
        'hobi'            => $hobi,
        'asal_slta'       => $asal_slta,
        'pekerjaan'       => $pekerjaan,
        'nama_orang_tua'  => $nama_orang_tua,
        'nama_pacar'      => $nama_pacar,
        'nama_mantan'     => $nama_mantan,
    ];

    $_SESSION['flash_error'] = 'Data gagal diperbaharui. Silakan coba lagi.';
    redirect_ke('edit_biodata_sang_pengunjung.php?cid='. (int)$cid);
  }
  #tutup statement
  mysqli_stmt_close($stmt);

  redirect_ke('edit_biodata_sang_pengunjung.php?cid='. (int)$cid);