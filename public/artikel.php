<?php include "../templates/header.php"; ?>

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Artikel Kabis</h2>
    <!-- <a href="tambah_artikel.php" class="btn btn-primary">+ Tambah Artikel</a> -->
  </div>

  <div class="row g-4">
    <?php
    $result = $conn->query("SELECT * FROM artikel ORDER BY created_at DESC");
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="col-md-3">
          <div class="card h-100">
            <img src="uploads/'.$row['gambar'].'" class="card-img-top" alt="'.$row['judul'].'">
            <div class="card-body">
              <h5 class="card-title">'.$row['judul'].'</h5>
              <p class="card-text">'.substr(strip_tags($row['konten']), 0, 100).'...</p>
              </div>
              <a href="artikel_detail.php?id='.$row['id'].'" class="btn btn-link">Baca Selengkapnya</a>
          </div>
        </div>';
      }
    } else {
      echo "<p>Belum ada artikel.</p>";
    }
    ?>
  </div>
</div>

<?php include "../templates/footer.php"; ?>