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
        </div>
        <div class="col-md-6">
            <img src="assets/img/about.jpeg" alt="" width="600">
        </div>
    </div>
  </div>
</section>

<!-- Section 3: Brand Kami -->
<section id="brand" class="py-5">
  <div class="container text-center">
    <h2 class="mb-4">Brand Kami</h2>
    <div class="row g-4 justify-content-center">
      <div class="col-md-2"><img src="assets/img/lexus.png" class="img-fluid" alt="Brand 1"></div>
      <div class="col-md-2"><img src="assets/img/toyota.png" class="img-fluid" alt="Brand 2"></div>
      <div class="col-md-2"><img src="assets/img/mazda.png" class="img-fluid" alt="Brand 3"></div>
      <div class="col-md-2"><img src="assets/img/hyundai.png" class="img-fluid" alt="Brand 4"></div>
      <div class="col-md-2"><img src="assets/img/kia.png" class="img-fluid" alt="Brand 5"></div>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-md-2"><img src="assets/img/tata.png" class="img-fluid" alt="Brand 6"></div>
      <div class="col-md-2"><img src="assets/img/nissan.png" class="img-fluid" alt="Brand 7"></div>
      <div class="col-md-2"><img src="assets/img/suzuki.png" class="img-fluid" alt="Brand 8"></div>
      <div class="col-md-2"><img src="assets/img/mitsubishi.png" class="img-fluid" alt="Brand 9"></div>
      <div class="col-md-2"><img src="assets/img/honda.png" class="img-fluid" alt="Brand 10"></div>
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
          <div class="col-md-2" style="width: 10rem;">
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

<!-- Section 2: Tentang Kami -->
<section id="dapatkan" class="py-5">
  <div class="container text-center">
    <div class="row">
        <div class="col">
            <h2>Dapatkan Produk Kabis</h2>
            <h5>Tersebar Di 9 Kota Besar</h5>
            <p>Kabis memiliki 9 dealer resmi yang tersebar di 9 kota besar, yaitu: Jakarta, Jawa Barat, Jawa Tengah, Kalimantan Selatan, Sulawesi, Kalimantan Barat, Bangka Belitung, Sumatera Selatan dan Bandar Lampung.</p>
            <img src="assets/img/peta.png" alt="">
        </div>
    </div>
    <div class="text-center mt-4">
      <a href="dapatkan.php" class="btn btn-primary">Selengkapnya</a>
    </div>
  </div>
</section>

<!-- Section 6: Artikel -->
<section id="artikel" class="bg-light py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Artikel</h2>
      <!-- <a href="tambah_artikel.php" class="btn btn-primary">+ Tambah Artikel</a> -->
    </div>
    <div class="row g-4">
      <?php
      $result = $conn->query("SELECT * FROM artikel ORDER BY created_at DESC LIMIT 3");
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '
          <div class="col-md-4">
            <div class="card h-100">
              <img src="uploads/'.$row['gambar'].'" class="card-img-top" alt="'.$row['judul'].'">
              <div class="card-body">
                <h5 class="card-title">'.$row['judul'].'</h5>
                <p class="card-text">'.substr($row['konten'],0,80).'...</p>
                <a href="artikel.php" class="btn btn-link">Baca Selengkapnya</a>
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