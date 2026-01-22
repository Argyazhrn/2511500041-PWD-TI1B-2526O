<?php
  session_start();
  require 'koneksi.php';
  require 'fungsi.php';

  $sql = "SELECT * FROM biodata_sang_pengunjung ORDER BY cid DESC";
  $q = mysqli_query($conn, $sql);
  if (!$q) {
    die("Query error: " . mysqli_error($conn));
  }
?>

<?php
  $flash_sukses = $_SESSION['flash_sukses'] ?? ''; #jika query sukses
  $flash_error  = $_SESSION['flash_error'] ?? ''; #jika ada error
  #bersihkan session ini
  unset($_SESSION['flash_sukses'], $_SESSION['flash_error']); 
?>

<?php if (!empty($flash_sukses)): ?>
        <div style="padding:10px; margin-bottom:10px; 
          background:#d4edda; color:#155724; border-radius:6px;">
          <?= $flash_sukses; ?>
        </div>
<?php endif; ?>

<?php if (!empty($flash_error)): ?>
        <div style="padding:10px; margin-bottom:10px; 
          background:#f8d7da; color:#721c24; border-radius:6px;">
          <?= $flash_error; ?>
        </div>
<?php endif; ?>

<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>No</th>
    <th>Aksi</th>
    <th>ID</th>
    <th>kode Pengunjung</th>
    <th>Nama Pengunjung</th>
    <th>Alamat Rumah</th>
    <th>Tanggal Kunjungan</th>
    <th>Hobi</th>
    <th>Asal SLTA</th>
    <th>Pekerjaan</th>
    <th>Nama orang Tua</th>
    <th>Nama Pacar</th>
    <th>Nama Mantan</th>
    <th>Created At</th>
  </tr>
  <?php $i = 1; ?>
  <?php while ($row = mysqli_fetch_assoc($q)): ?>
    <tr>
      <td><?= $i++ ?></td>
      <td>
        <a href="edit_biodata_sang_pengunjung.php?cid=<?= (int)$row['cid']; ?>">Edit</a>
        <a onclick="return confirm('Hapus <?= htmlspecialchars($row['kode_pengunjung']); ?>?')" href="delete_biodata_sang_pengunjung.php?cid=<?= (int)$row['cid']; ?>">Delete</a>
     </td>
      <td><?= $row['cid']; ?></td>
      <td><?= htmlspecialchars($row['kode_pengunjung']); ?></td>
      <td><?= htmlspecialchars($row['nama_pengunjung']); ?></td>
      <td><?= htmlspecialchars($row['alamat_rumah']); ?></td>
      <td><?= htmlspecialchars($row['tanggal_kunjungan']); ?></td>
      <td><?= htmlspecialchars($row['hobi']); ?></td>
      <td><?= htmlspecialchars($row['asal_slta']); ?></td>
      <td><?= htmlspecialchars($row['pekerjaan']); ?></td>
      <td><?= htmlspecialchars($row['nama_orang_tua']); ?></td>
      <td><?= htmlspecialchars($row['nama_pacar']); ?></td>
      <td><?= htmlspecialchars($row['nama_mantan']); ?></td>
      <td><?= formatTanggal($row['created_at'] ?? ''); ?></td>
    </tr>
  <?php endwhile; ?>
</table>