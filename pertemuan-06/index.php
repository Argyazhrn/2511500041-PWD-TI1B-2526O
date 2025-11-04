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
      echo "<p>Halo Dunia</p>",
      echo "<p>Nama saya Argya Zahran Dwiputra Sodikin</p>",
      ?>
    </section>

    <?php
    $NIM              = "2511500041"
    $Nama             = "Argya Zahran Dwiputra Sodikin"
    $Tempat_Lahir     = "Bandung"
    $Tanggal_Lahir    = "18 Agustus 2006"
    $Pekerjaan        = "Mahasiswa"
    $Pasangan         = "Tidak ada"
    $Nama_Ayah        = "Ace Sodikin"
    $Nama_Ibu         = "Reni Nurhayati"
    $Nama_Kakak       = "Arya Putra Purnama Sodikin"
    $Nama_Adik        = "Nasya Lovelia Putri Sodikin"

    <section id="about">
      <h2>About Argya Zahran Dwiputra Sodikin</h2>
      <p><strong>NIM:</strong> <?php echo $NIM; ?></p>
      <p><strong>Nama:</strong> <?php echo $Nama; ?></p>
      <p><strong>Tempat Lahir:</strong> <?php echo $Tempat_Lahir; ?></p>
      <p><strong>Tanggal Lahir:</strong> <?php echo $Tanggal_Lahir; ?></p>
      <p><strong>Pekerjaan:</strong> <?php echo $Pekerjaan; ?></p>
      <p><strong>Pasangan:</strong> <?php echo $Pasangan &times; ?></p>
      <p><strong>Nama Ayah:</strong> <?php echo $Nama_Ayah; ?></p>
      <p><strong>Nama Ibu:</strong> <?php echo $Nama_Ibu; ?></p>
      <p><strong>Nama Kakak:</strong> <?php echo $Nama_Kakak; ?></p>
      <p><strong>Nama Adik:</strong> <?php echo $Nama_Adik; &#128512; ?></p>
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
      </label>

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