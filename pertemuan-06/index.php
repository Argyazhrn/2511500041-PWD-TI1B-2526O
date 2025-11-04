<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>saya fdfdfd</title>
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
    <section id="home">
      <h2>Selamat Datang</h2>
      <p>Ini contoh paragraf HTML.</p>
      <?php
        echo "<p>Halo Dunia</p>";
        echo "<p>Nama saya Argya Zahran Dwiputra Sodikin</p>";
      ?>
    </section>

    <section id="about">
      <h2>About Argya Zahran Dwiputra Sodikin</h2>
    <?php
      $NIM            = "2511500041";
      $Nama           = "Argya Zahran Dwiputra Sodikin";
      $Tempat_Lahir   = "Bandung";
      $Tanggal_Lahir  = "18 Agustus 2006";
      $Pekerjaan      = "Mahasiswa";
      $Pasangan       = "Tidak ada";
      $Nama_Ayah      = "Ace Sodikin";
      $Nama_Ibu       = "Reni Nurhayati";
      $Nama_Kakak     = "Arya Putra Purnama Sodikin";
      $Nama_Adik      = "Nasya Lovelia Putri Sodikin";
    ?>

      <p><strong>NIM:</strong> <?php echo $NIM; ?></p>
      <p><strong>Nama:</strong> <?php echo $Nama; ?></p>
      <p><strong>Tempat Lahir:</strong> <?php echo $Tempat_Lahir; ?></p>
      <p><strong>Tanggal Lahir:</strong> <?php echo $Tanggal_Lahir; ?></p>
      <p><strong>Pekerjaan:</strong> <?php echo $Pekerjaan; ?></p>
      <p><strong>Pasangan:</strong> <?php echo $Pasangan; ?> &times;</p>
      <p><strong>Nama Ayah:</strong> <?php echo $Nama_Ayah; ?></p>
      <p><strong>Nama Ibu:</strong> <?php echo $Nama_Ibu; ?></p>
      <p><strong>Nama Kakak:</strong> <?php echo $Nama_Kakak; ?></p>
      <p><strong>Nama Adik:</strong> <?php echo $Nama_Adik; ?> &#128512;</p>
    </section>
    
    <section id="ipk">
      <h2>Nilai Saya</h2>
      <?php

       $namaMatkul1 = "Algoritma dan Struktur Data";
    $sksMatkul1 = 4;
    $nilaiHadir1 = 83;
    $nilaiTugas1 = 75;
    $nilaiUTS1 = 85;
    $nilaiUAS1 = 80;

    $namaMatkul2 = "Agama";
    $sksMatkul2 = 2;
    $nilaiHadir2 = 85;
    $nilaiTugas2 = 79;
    $nilaiUTS2 = 88;
    $nilaiUAS2 = 83;

    $namaMatkul3 = "Aplikasi Perkantoran";
    $sksMatkul3 = 3;
    $nilaiHadir3 = 87;
    $nilaiTugas3 = 75;
    $nilaiUTS3 = 90;
    $nilaiUAS3 = 89;

    $namaMatkul4 = "Logika Informatika";
    $sksMatkul4 = 4;
    $nilaiHadir4 = 88;
    $nilaiTugas4 = 75;
    $nilaiUTS4 = 80;
    $nilaiUAS4 = 95;

    $namaMatkul5 = "Pemrograman Web Dasar";
    $sksMatkul5 = 3;
    $nilaiHadir5 = 77;
    $nilaiTugas5 = 75;
    $nilaiUTS5 = 79;
    $nilaiUAS5 = 86;

    $namaMatkul6 = "Konsep Berbasis Data";
    $sksMatkul6 = 4;
    $nilaiHadir6 = 90;
    $nilaiTugas6 = 85;
    $nilaiUTS6 = 95;
    $nilaiUAS6 = 89;

    $matkul = [
     1 => ['nama' => $namaMatkul1, 'sks' => $sksMatkul1, 'hadir' => $nilaiHadir1, 'tugas' => $nilaiTugas1, 'uts' => $nilaiUTS1, 'uas' => $nilaiUAS1],
     2 => ['nama' => $namaMatkul2, 'sks' => $sksMatkul2, 'hadir' => $nilaiHadir2, 'tugas' => $nilaiTugas2, 'uts' => $nilaiUTS2, 'uas' => $nilaiUAS2],
     3 => ['nama' => $namaMatkul3, 'sks' => $sksMatkul3, 'hadir' => $nilaiHadir3, 'tugas' => $nilaiTugas3, 'uts' => $nilaiUTS3, 'uas' => $nilaiUAS3],
     4 => ['nama' => $namaMatkul4, 'sks' => $sksMatkul4, 'hadir' => $nilaiHadir4, 'tugas' => $nilaiTugas4, 'uts' => $nilaiUTS4, 'uas' => $nilaiUAS4],
     5 => ['nama' => $namaMatkul5, 'sks' => $sksMatkul5, 'hadir' => $nilaiHadir5, 'tugas' => $nilaiTugas5, 'uts' => $nilaiUTS5, 'uas' => $nilaiUAS5]
    ];

    $totalBobot = 0;
    $totalSKS = 0;
      
    for ($i = 1; $i <= 5; $i++) {
    $nama = $matkul[$i]['nama'];
    $sks = $matkul[$i]['sks'];
    $hadir = $matkul[$i]['hadir'];
    $tugas = $matkul[$i]['tugas'];
    $uts = $matkul[$i]['uts'];
    $uas = $matkul[$i]['uas'];

    $nilaiAkhir = (0.1 * $hadir) + (0.2 * $tugas) + (0.3 * $uts) + (0.4 * $uas);

     if ($hadir < 70) {
         $grade = 'E';
     } else {
        if ($nilaiAkhir >= 85) {
            $grade = 'A';
        } elseif ($nilaiAkhir >= 80) {
            $grade = 'A-';
        } elseif ($nilaiAkhir >= 75) {
            $grade = 'B+';
        } elseif ($nilaiAkhir >= 70) {
            $grade = 'B';
        } elseif ($nilaiAkhir >= 65) {
            $grade = 'B-';
        } elseif ($nilaiAkhir >= 60) {
            $grade = 'C+';
        } elseif ($nilaiAkhir >= 55) {
            $grade = 'C';
        } elseif ($nilaiAkhir >= 50) {
            $grade = 'C-';
        } elseif ($nilaiAkhir >= 45) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }
      }

       switch ($grade) {
        case 'A':
          $mutu = 4.00;
          break;
        case 'A-':
          $mutu = 3.70;
          break;
        case 'B+':
          $mutu = 3.30;
          break;
        case 'B':
          $mutu = 3.00;
          break;
        case 'B-':
          $mutu = 2.70;
          break;
        case 'C+':
          $mutu = 2.30;
          break;
        case 'C':
          $mutu = 2.00;
          break;
        case 'C-':
          $mutu = 1.70;
          break;
        case 'D':
          $mutu = 1.00;
          break;
        case 'E':
          $mutu = 0.00;
          break;
        default:
          $mutu = 0.00;
      }

      $bobot = $mutu * $sks;
      $status = (in_array($grade, ['A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-'])) ? 'LULUS' : 'GAGAL';

      $totalBobot += $bobot;
      $totalSKS += $sks;

      echo "<div class='matkul-item'>";
      echo "<p><span class='label'>Nama Matakuliah ke-$i :</span> <span class='value'>
      $nama</span></p>";
      echo "<p><span class='label'>SKS :</span> <span class='value'>$sks</span></p>";
      echo "<p><span class='label'>Kehadiran :</span> <span class='value'>$hadir</span></p>";
      echo "<p><span class='label'>Tugas :</span> <span class='value'>$tugas</span></p>";
      echo "<p><span class='label'>UTS :</span> <span class='value'>$uts</span></p>";
      echo "<p><span class='label'>UAS :</span> <span class='value'>$uas</span></p>";
      echo "<p><span class='label'>Nilai Akhir :</span> <span class='value'>".
      number_format($nilaiAkhir, 0) . "</span></p>";
       echo "<p><span class='label'>Grade :</span> <span class='value'>$grade</span></p>";
       echo "<p><span class='label'>Angka Mutu :</span> <span class='value'>". 
       number_format($mutu, 2) . "</span></p>";
       number_format($bobot, 2) . "</span></p>";
        echo "<p><span class='label'>Status :</span> <span class='value'>$status</span></p>";
        echo "<hr>";
         echo "</div>";
    }

    $IPK = ($totalSKS > 0) ? $totalBobot / $totalSKS : 0;

    echo "<div class='total-section'>";
    echo "<p><span class='label'>Total Bobot :</span> <span class='value'>";
    number_format($totalBobot, 2) . "</span></p>";
    echo "<p><span class='label'>Total SKS :</span> <span class='value'>$totalSKS</span></p>";
    echo "<p><span class='label'>IPK :</span> <span class='value'>" . number_format($IPK, 2) . "</
    span></p>";
    echo "</div>";
     ?>
 </section>
    <section id="contact">
      <h2>Kontak Kami</h2>
      <form action="" method="GET">
        <label for="txtNama">Nama:</label>
        <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan Nama" required autocomplete="name">

        <label for="txtEmail">Email:</label>
        <input type="text" id="txtEmail" name="txtEmail" placeholder="Masukkan Email" required autocomplete="email">

        <label for="txtPesan">Pesan:</label>
        <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..." required></textarea>
        <small id="charCount">0/200 karakter</small>

        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Argya Zahran Dwiputra Sodikin [2511500041]</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
