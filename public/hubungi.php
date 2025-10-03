<?php
include '../config/database.php';

// Proses simpan pesan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama    = $conn->real_escape_string($_POST['nama']);
    $telepon = $conn->real_escape_string($_POST['telepon']);
    $email   = $conn->real_escape_string($_POST['email']);
    $pesan   = $conn->real_escape_string($_POST['pesan']);

    $sql = "INSERT INTO kontak (nama, telepon, email, pesan) 
            VALUES ('$nama', '$telepon', '$email', '$pesan')";

    if ($conn->query($sql) === TRUE) {
        $success = "Pesan berhasil dikirim!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<?php include "../templates/header.php"; ?>

  <!-- Contact Section -->
  <section class="contact-section">
    <div class="container">
      <div class="row align-items-center">
        
        <!-- Gambar -->
        <div class="col-md-6 mb-4 mb-md-0">
          <div class="contact-img shadow">
            <img src="assets/img/hubungi.webp" alt="Hubungi Kami" loading="lazy" class="img-fluid">
          </div>
        </div>

        <!-- Form -->
        <div class="col-md-6">
          <h2 class="mb-4">Hubungi Kami</h2>
          <?php if (isset($success)): ?>
            <div class="alert alert-success"><?= $success; ?></div>
          <?php elseif (isset($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
          <?php endif; ?>

          <form method="POST">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="telepon" class="form-label">Telepon</label>
              <input type="tel" class="form-control" id="telepon" name="telepon">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="pesan" class="form-label">Pesan</label>
              <textarea class="form-control" id="pesan" name="pesan" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Kirim</button>
          </form>
        </div>

      </div>
    </div>
  </section>

  <br><br><br>

<?php include "../templates/footer.php"; ?>