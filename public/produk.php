<?php include "../templates/header.php"; ?>

<div class="container my-5">
  <div class="d-flex justify-content-center align-items-center mb-4">
    <h2>Produk Kami</h2>
    <!-- <a href="tambah_produk.php" class="btn btn-primary">+ Tambah Produk</a> -->
  </div>

  <div class="row g-4 justify-content-center">
    <?php
    $result = $conn->query("SELECT * FROM produk ORDER BY created_at DESC");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '
          <div class="col-6 col-md-3 col-lg-2">
            <div class="card h-100">
              <img src="uploads/'.$row['gambar'].'" class="card-img-top" alt="'.$row['nama'].'">
              <div class="card-body">
                <h5 class="card-title">'.$row['nama'].'</h5>
              </div>
              <div class="text-center">
                <a href="detail_produk.php?id='.$row['id'].'" class="stretched-link">Detail Produk</a>
              </div>
            </div>
          </div>';
        }
    } else {
        echo "<p class='text-center'>Belum ada produk.</p>";
    }
    ?>
  </div>
</div>

<?php include "../templates/footer.php"; ?>