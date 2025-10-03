<?php
include "../templates/header.php";
include "../config/database.php";

// Ambil daftar produk
$produkResult = $conn->query("SELECT id, nama FROM produk ORDER BY nama ASC");

// Proses simpan
$success = $error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $produk_id   = $_POST['produk_id'];
    $no_kabis    = trim($_POST['no_kabis']);
    $no_oem      = trim($_POST['no_oem']);
    $brand_mobil = trim($_POST['brand_mobil']);
    $nama_mobil  = trim($_POST['nama_mobil']);
    $deskripsi   = trim($_POST['deskripsi']);
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];

    // Upload gambar
    $gambar = null;
    if (!empty($_FILES['gambar']['name'])) {
        $targetDir  = "../uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName   = time() . "_" . basename($_FILES["gambar"]["name"]);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
            $gambar = $fileName;
        } else {
            $error = "Upload gambar gagal.";
        }
    }

    if ($produk_id && $no_kabis && $no_oem && $brand_mobil && $nama_mobil && $deskripsi && $harga !== "" && $stok !== "") {
        $stmt = $conn->prepare("INSERT INTO detail_produk (produk_id, no_kabis, no_oem, brand_mobil, nama_mobil, deskripsi, harga, stok, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssdis", $produk_id, $no_kabis, $no_oem, $brand_mobil, $nama_mobil, $deskripsi, $harga, $stok, $gambar);

        if ($stmt->execute()) {
            $success = "Detail produk berhasil ditambahkan.";
        } else {
            $error = "Gagal menyimpan detail produk: " . $conn->error;
        }
    } else {
        $error = "Semua field wajib diisi.";
    }
}
?>

<div class="container my-5">
  <h2 class="mb-4">Tambah Detail Produk</h2>

  <?php if ($success): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
  <?php endif; ?>
  <?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php endif; ?>

  <form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Pilih Produk</label>
        <select name="produk_id" class="form-select" required>
        <option value="">-- Pilih Produk --</option>
        <?php while ($p = $produkResult->fetch_assoc()): ?>
            <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['nama']); ?></option>
        <?php endwhile; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">NO. KABIS</label>
        <input type="text" name="no_kabis" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">NO. OEM</label>
        <input type="text" name="no_oem" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">BRAND MOBIL</label>
        <input type="text" name="brand_mobil" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">NAMA MOBIL</label>
        <input type="text" name="nama_mobil" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">DESKRIPSI</label>
        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
        <label class="form-label">HARGA</label>
        <input type="number" name="harga" step="0.01" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
        <label class="form-label">STOCK</label>
        <input type="number" name="stok" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Upload Gambar Produk</label>
        <input type="file" name="gambar" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">SIMPAN</button>
    <a href="produk.php" class="btn btn-danger">KEMBALI</a>
    </form>
</div>

<?php include "../templates/footer.php"; ?>