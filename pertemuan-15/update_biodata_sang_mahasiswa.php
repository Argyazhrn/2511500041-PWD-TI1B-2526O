<?php
  session_start();
  require __DIR__ . '/koneksi.php';
  require_once __DIR__ . '/fungsi.php';

  #cek method form, hanya izinkan POST
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('read_biodata_sang_mahasiswa');
  }

  #validasi cid wajib angka dan > 0
  $cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
  ]);

  if (!$cid) {
    $_SESSION['flash_error'] = 'CID Tidak Valid.';
    redirect_ke('edit_biodata_sang_mahasiswa.php?cid='. (int)$cid);
  }

   #ambil dan bersihkan (sanitasi) nilai dari form
  $nim  = bersihkan($_POST['txtnim']  ?? '');
  $nama_lengkap = bersihkan($_POST['txtnama_lengkap'] ?? '');
  $tempat_lahir = bersihkan($_POST['txttempat_lahir'] ?? '');
  $tanggal_lahir = bersihkan($_POST['txttanggal_lahir'] ?? '');
  $hobi  = bersihkan($_POST['txthobi']  ?? '');
  $pasangan = bersihkan($_POST['txtpasangan'] ?? '');
  $pekerjaan = bersihkan($_POST['txtpekerjaan'] ?? '');
  $nama_orang_tua = bersihkan($_POST['txtnama_orang_tua'] ?? '');
  $nama_kakak  = bersihkan($_POST['txtnama_kakak']  ?? '');
  $nama_adik = bersihkan($_POST['txtnama_adik'] ?? '');
  
  #Validasi sederhana
  $errors = [];

if ($nim === '') {
    $errors['nim'] = 'Nim wajib diisi.';
}


  if ($nama_lengkap === '') {
    $errors[] = 'Nama lengkap wajib diisi.';
  }

  if ($tempat_lahir === '') {
    $errors[] = 'Tempat lahir wajib diisi.';
  }

  if ($tanggal_lahir === '') {
    $errors[] = 'Tanggal lahir wajib diisi.';
  }

  if ($hobi === '') {
    $errors[] = 'Hobi wajib diisi.';
  }

  if ($pasangan === '') {
    $errors[] = 'Pasangan wajib diisi.';
  }

  if ($pekerjaan === '') {
    $errors[] = 'Pekerjaan wajib diisi.';
  }

  if ($nama_orang_tua === '') {
    $errors[] = 'Nama orang tua wajib diisi.';
  }

  if ($nama_kakak === '') {
    $errors[] = 'Nama kakak wajib diisi.';
  }

  if ($nama_adik === '') {
    $errors[] = 'Nama adik wajib diisi.';
  }

  if ($nim !== '' && (mb_strlen($nim, 'UTF-8') < 6 || mb_strlen($nim, 'UTF-8') > 20)) {
  $errors[] = 'NIM harus 6–15 karakter.';
}


if ($nama_lengkap !== '' && mb_strlen($nama_lengkap, 'UTF-8') < 5) {
  $errors[] = 'Nama lengkap minimal 5 karakter.';
}


if ($tempat_lahir !== '' && mb_strlen($tempat_lahir, 'UTF-8') < 3) {
  $errors[] = 'Tempat lahir minimal 3 karakter.';
}

if ($tanggal_lahir !== '' && mb_strlen($tanggal_lahir, 'UTF-8') < 3) {
  $errors[] = 'Tanggal lahir minimal 3 karakter.';
}

if ($hobi !== '' && mb_strlen($hobi, 'UTF-8') > 100) {
  $errors[] = 'Hobi maksimal 100 karakter.';
}

if ($pasangan !== '' && mb_strlen($pasangan, 'UTF-8') < 3) {
  $errors[] = 'Pasangan minimal 3 karakter.';
}

if ($pekerjaan !== '' && mb_strlen($pekerjaan, 'UTF-8') < 3) {
  $errors[] = 'Pekerjaan minimal 3 karakter.';
}

if ($nama_orang_tua !== '' && mb_strlen($nama_orang_tua, 'UTF-8') < 3) {
  $errors[] = 'Tempat lahir minimal 3 karakter.';
}

if ($nama_kakak !== '' && mb_strlen($nama_kakak, 'UTF-8') < 3) {
  $errors[] = 'Nama kakak minimal 3 karakter.';
}

if ($nama_adik !== '' && mb_strlen($nama_adik, 'UTF-8') < 3) {
  $errors[] = 'Nama adik minimal 3 karakter.';
}

# jika ada error
if (!empty($errors)) {
  $_SESSION['old'] = [
    'nim'            => $nim,
    'nama_lengkap'   => $nama_lengkap,
    'tempat_lahir'   => $tempat_lahir,
    'tanggal_lahir'  => $tanggal_lahir,
    'hobi'           => $hobi,
    'pasangan'       => $pasangan,
    'pekerjaan'      => $pekerjaan,
    'nama_orang_tua' => $nama_orang_tua,
    'nama_kakak'     => $nama_kakak,
    'nama_adik'      => $nama_adik,
  ];

  $_SESSION['flash_error'] = implode('<br>', $errors);
  redirect_ke('edit_biodata_sang_mahasiswa.php?cid=' . (int)$cid);
}

 #menyiapkan query UPDATE dengan prepared statement 
  $stmt = mysqli_prepare($conn, "UPDATE biodata_sang_mahasiswa 
                                SET nim = ?, nama_lengkap = ?, tempat_lahir = ?, tanggal_lahir = ?, hobi = ?, pasangan = ?, pekerjaan = ?, nama_orang_tua = ?, nama_kakak = ?, nama_adik = ?
                                WHERE cid = ?");

if (!$stmt) {
    #jika gagal prepare, kirim pesan error (tanpa detail sensitif)
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('edit_biodata_sang_mahasiswa.php?cid='. (int)$cid);
  }

  #bind parameter dan eksekusi (s = string, i = integer)
  mysqli_stmt_bind_param($stmt, "ssssssssssi", $nim, $nama_lengkap, $tempat_lahir, $tanggal_lahir, $hobi, $pasangan, $pekerjaan, $nama_orang_tua, $nama_kakak, $nama_adik, $cid);

  if (mysqli_stmt_execute($stmt)) { #jika berhasil, kosongkan old value
    unset($_SESSION['old']);
    /*Redirect balik ke read.php dan tampilkan info sukses.
    */
    $_SESSION['flash_sukses'] = 'Terima kasih, data Anda sudah diperbaharui.';
    redirect_ke('read_biodata_sang_mahasiswa.php'); #pola PRG: kembali ke data dan exit()
  } else {
    $_SESSION['old'] = [
    'nim'            => $nim,
    'nama_lengkap'   => $nama_lengkap,
    'tempat_lahir'   => $tempat_lahir,
    'tanggal_lahir'  => $tanggal_lahir,
    'hobi'           => $hobi,
    'pasangan'       => $pasangan,
    'pekerjaan'      => $pekerjaan,
    'nama_orang_tua' => $nama_orang_tua,
    'nama_kakak'     => $nama_kakak,
    'nama_adik'      => $nama_adik,
  ];

  $_SESSION['flash_error'] = 'Data gagal diperbaharui. Silakan coba lagi.';
    redirect_ke('edit_biodata_sang_mahasiswa.php?cid='. (int)$cid);
  }

  mysqli_stmt_close($stmt);