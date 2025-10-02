<?php include "../templates/header.php"; ?>

<!-- Section 1: Carousel -->
<?php include "../templates/carousel.php"; ?>

<!-- Section 2: Tentang Kami -->
<section id="tentang" class="bg-light py-5">
  <div class="container text-center">
    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-4">Tentang Kami</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam debitis illum quia incidunt officia, provident natus adipisci omnis, quas vel exercitationem sapiente. Atque ratione asperiores blanditiis voluptate ea labore deserunt unde! Animi at ducimus earum tempore odit dolor expedita autem, ut ex fuga deleniti sed, non velit laborum consequatur excepturi!</p>
            <div class="d-flex">
              <div class="card me-3" style="width: 10rem;">
                <img class="card-img-top" src="assets/img/catalogue.webp" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Catalogue</h5>
                  <a href="assets/pdf/catalogue.pdf" class="btn btn-primary" download>Download</a>
                </div>
              </div>
              <div class="card" style="width: 10rem;">
                <img class="card-img-top" src="assets/img/company_profile.webp" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Company</h5>
                  <a href="assets/pdf/company_profile.pdf" class="btn btn-primary" download>Download</a>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-6">
            <img src="assets/img/about.webp" alt="" width="600" height="410">
        </div>
    </div>
  </div>
</section>

<!-- Section 3: Brand Kami -->
<section id="brand" class="py-5">
  <div class="container text-center">
    <h2 class="mb-4">Brand Kami</h2>
    <div class="row g-4 justify-content-center">
      <div class="col-md-2"><img src="assets/img/lexus.webp" class="img-fluid" alt="Brand 1"></div>
      <div class="col-md-2"><img src="assets/img/toyota.webp" class="img-fluid" alt="Brand 2"></div>
      <div class="col-md-2"><img src="assets/img/mazda.webp" class="img-fluid" alt="Brand 3"></div>
      <div class="col-md-2"><img src="assets/img/hyundai.webp" class="img-fluid" alt="Brand 4"></div>
      <div class="col-md-2"><img src="assets/img/kia.webp" class="img-fluid" alt="Brand 5"></div>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-md-2"><img src="assets/img/tata.webp" class="img-fluid" alt="Brand 6"></div>
      <div class="col-md-2"><img src="assets/img/nissan.webp" class="img-fluid" alt="Brand 7"></div>
      <div class="col-md-2"><img src="assets/img/suzuki.webp" class="img-fluid" alt="Brand 8"></div>
      <div class="col-md-2"><img src="assets/img/mitsubishi.webp" class="img-fluid" alt="Brand 9"></div>
      <div class="col-md-2"><img src="assets/img/honda.webp" class="img-fluid" alt="Brand 10"></div>
    </div>
  </div>
</section>

<!-- Section 4: Produk -->
<section id="produk" class="bg-light py-5">
  <div class="container">
    <div class="d-flex justify-content-center align-items-center mb-4">
      <h2>Produk Kami</h2>
      <!-- <a href="tambah_produk.php" class="btn btn-primary">+ Tambah Produk</a> -->
    </div>
    <div class="row g-4 justify-content-center">
      <?php
      $result = $conn->query("SELECT * FROM produk ORDER BY created_at DESC LIMIT 5");
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '
          <div class="col-md-2" style="width: 12rem;">
            <div class="card h-100">
              <img src="uploads/'.$row['gambar'].'" class="card-img-top" alt="'.$row['nama'].'">
              <div class="card-body">
                <h5 class="card-title">'.$row['nama'].'</h5>
              </div>
            </div>
          </div>';
        }
      } else {
        echo "<p>Belum ada produk.</p>";
      }
      ?>
    </div>
    <div class="text-center mt-4">
      <a href="produk.php" class="btn btn-primary">Lihat Semua Produk</a>
    </div>
  </div>
</section>

<!-- Section 5: Artikel -->
<section id="artikel" class="py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Artikel</h2>
      <!-- <a href="tambah_artikel.php" class="btn btn-primary">+ Tambah Artikel</a> -->
    </div>
    <div class="row g-4">
      <?php
      $result = $conn->query("SELECT * FROM artikel ORDER BY created_at DESC LIMIT 4");
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '
          <div class="col-md-3">
            <div class="card h-100">
              <img src="uploads/'.$row['gambar'].'" class="card-img-top" alt="'.$row['judul'].'">
              <div class="card-body">
                <h5 class="card-title">'.$row['judul'].'</h5>
                <p class="card-text">'.substr($row['konten'],0,80).'...</p>
                </div>
            </div>
          </div>';
        }
      } else {
        echo "<p>Belum ada artikel.</p>";
      }
      ?>
    </div>
    <div class="text-center mt-4">
      <a href="artikel.php" class="btn btn-primary">Lihat Semua Artikel</a>
    </div>
  </div>
</section>

<?php include "../templates/footer.php"; ?>