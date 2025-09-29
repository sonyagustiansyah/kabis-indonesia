<?php 
include "../templates/header.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "uploads/" . $gambar);

    $sql = "INSERT INTO produk (nama, deskripsi, gambar) VALUES ('$nama','$deskripsi','$gambar')";
    if ($conn->query($sql)) {
        echo "<script>alert('Produk berhasil ditambahkan!'); window.location='produk.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<div class="container my-5">
  <h2>Tambah Produk</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Nama Produk</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Deskripsi</label>
      <textarea name="deskripsi" class="form-control" rows="5"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Upload Gambar</label>
      <input type="file" name="gambar" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
  </form>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br>

<?php include "../templates/footer.php"; ?>