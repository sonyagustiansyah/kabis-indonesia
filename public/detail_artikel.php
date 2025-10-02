<?php
include "../templates/header.php";
include "../config/database.php";

// Cek parameter ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='container my-5'><p>Artikel tidak ditemukan.</p></div>";
    include "../templates/footer.php";
    exit;
}

$id = (int) $_GET['id'];

// Query artikel
$stmt = $conn->prepare("SELECT * FROM artikel WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='container my-5'><p>Artikel tidak ditemukan.</p></div>";
    include "../templates/footer.php";
    exit;
}

$artikel = $result->fetch_assoc();
?>

<div class="container my-5">
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center"><?php echo htmlspecialchars($artikel['judul']); ?></h2>
      <p class="text-muted text-center">
        Dipublikasikan pada: <?php echo date("d M Y", strtotime($artikel['created_at'])); ?>
      </p>
      <?php if (!empty($artikel['gambar'])): ?>
        <img src="uploads/<?php echo htmlspecialchars($artikel['gambar']); ?>" 
             alt="<?php echo htmlspecialchars($artikel['judul']); ?>" 
             class="img-fluid rounded shadow mb-4" style="width: 1300px; height: 600px;">
      <?php endif; ?>
      <div class="content">
        <?php echo nl2br($artikel['konten']); ?>
      </div>
      <a href="artikel.php" class="btn btn-primary mt-3">Lihat Semua Artikel</a>
    </div>
  </div>
</div>

<?php include "../templates/footer.php"; ?>