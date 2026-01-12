<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

$cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);

if (!$cid) {
    $_SESSION['flash_error_bio'] = 'CID Tidak Valid.';
    redirect_ke('read_biodata_sang_mahasiswa.php');
    exit;
}

$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM biodata_sang_mahasiswa WHERE cid = ?"
);
if (!$stmt) {
    $_SESSION['flash_error_bio'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('read_biodata_sang_mahasiswa.php');
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $cid);

if (mysqli_stmt_execute($stmt)) {
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $_SESSION['flash_sukses'] = 'Terima kasih, data Anda sudah dihapus.';
    } else {
        $_SESSION['flash_error'] = 'Data dengan CID tersebut tidak ditemukan.';
    }
} else {
    $_SESSION['flash_error'] = 'Data gagal dihapus. Silakan coba lagi.';
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

redirect_ke('read_biodata_sang_mahasiswa.php');
exit;
