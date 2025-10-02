<?php
include "../templates/header.php";
include "../config/database.php";

// Ambil ID produk dari URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='container my-5'><p>Produk tidak ditemukan.</p></div>";
    include "../templates/footer.php";
    exit;
}

$id = (int) $_GET['id'];

// Query produk berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM produk WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='container my-5'><p>Produk tidak ditemukan.</p></div>";
    include "../templates/footer.php";
    exit;
}

$produk = $result->fetch_assoc();
?>

<div class="container my-5">
  <div class="row">
    <div class="col-md-6">
      <img src="uploads/<?php echo htmlspecialchars($produk['gambar']); ?>" 
           class="img-fluid rounded shadow" 
           alt="<?php echo htmlspecialchars($produk['nama']); ?>" style="width: 200px; height: 200px;">
    </div>
    <div class="col-md-6">
      <h2><?php echo htmlspecialchars($produk['nama']); ?></h2>
      <p class="text-muted">
        Dipublikasikan pada: <?php echo date("d M Y", strtotime($produk['created_at'])); ?>
      </p>
      <p><?php echo nl2br(htmlspecialchars($produk['deskripsi'])); ?></p>
      <a href="produk.php" class="btn btn-danger mt-3">Kembali</a>
    </div>
  </div>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php include "../templates/footer.php"; ?>