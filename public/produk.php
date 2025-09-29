<?php include "../templates/header.php"; ?>

<div class="container my-5">
  <div class="d-flex justify-content-center align-items-center mb-4">
    <h2>Produk Kami</h2>
    <!-- <a href="tambah_produk.php" class="btn btn-primary">+ Tambah Produk</a> -->
  </div>

  <div class="row g-4 justify-content-center">
    <?php
    $result = $conn->query("SELECT * FROM produk ORDER BY created_at DESC");
    while ($row = $result->fetch_assoc()) {
      echo '
      <div class="col-md-2" style="width: 10rem;">
        <div class="card h-100">
          <img src="uploads/'.$row['gambar'].'" class="card-img-top" alt="'.$row['nama'].'">
          <div class="card-body">
            <h5 class="card-title">'.$row['nama'].'</h5>
          </div>
        </div>
      </div>';
    }
    ?>
  </div>
</div>

<?php include "../templates/footer.php"; ?>