<?php 
include "../templates/header.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if ($gambar) {
        $filename = time() . "_" . basename($gambar);
        move_uploaded_file($tmp, "uploads/" . $filename);
    } else {
        $filename = null;
    }

    $sql = "INSERT INTO artikel (judul, konten, gambar) VALUES ('$judul','$konten','$filename')";
    if ($conn->query($sql)) {
        echo "<script>alert('Artikel berhasil ditambahkan!'); window.location='artikel.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<div class="container my-5">
  <h2>Tambah Artikel</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Judul Artikel</label>
      <input type="text" name="judul" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Konten</label>
      <textarea name="konten" class="form-control" rows="6" required></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Upload Gambar</label>
      <input type="file" name="gambar" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="artikel.php" class="btn btn-danger">Batal</a>
  </form>
</div>

<br><br><br><br><br><br><br><br><br><br><br>

<?php include "../templates/footer.php"; ?>