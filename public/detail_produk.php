<?php
include "../templates/header.php";
include "../config/database.php";

// === Cek Produk ID Utama ===
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='container my-5'><p>Produk tidak ditemukan.</p></div>";
    include "../templates/footer.php";
    exit;
}

$produk_id = (int) $_GET['id'];

// Ambil data produk utama (untuk judul halaman)
$stmt = $conn->prepare("SELECT * FROM produk WHERE id = ?");
$stmt->bind_param("i", $produk_id);
$stmt->execute();
$produk = $stmt->get_result()->fetch_assoc();

if (!$produk) {
    echo "<div class='container my-5'><p>Produk tidak tersedia.</p></div>";
    include "../templates/footer.php";
    exit;
}

// === Filter Product Group (checkbox) ===
$selected_groups = isset($_GET['group']) ? $_GET['group'] : [];
$where = "WHERE 1=1";

// Pencarian global
$search = isset($_GET['search']) ? trim($_GET['search']) : "";
if ($search !== "") {
    $search_esc = $conn->real_escape_string($search);
    $where .= " AND (brand_mobil LIKE '%$search_esc%' 
                  OR nama_mobil LIKE '%$search_esc%' 
                  OR no_kabis LIKE '%$search_esc%' 
                  OR no_oem LIKE '%$search_esc%')";
}

// Filter berdasarkan Product Group (produk_id)
if (!empty($selected_groups)) {
    $group_ids = array_map('intval', $selected_groups); 
    $where .= " AND produk_id IN (" . implode(",", $group_ids) . ")";
} else {
    // default hanya produk halaman utama
    $where .= " AND produk_id = $produk_id";
}

// === Ambil daftar Product Group ===
$productGroups = $conn->query("
    SELECT p.id, p.nama, COUNT(d.id) as total 
    FROM produk p
    LEFT JOIN detail_produk d ON d.produk_id = p.id
    GROUP BY p.id, p.nama
    ORDER BY p.nama ASC
");

// === Pagination ===
$limit = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);
$start = ($page - 1) * $limit;

// Hitung total data
$result_total = $conn->query("SELECT COUNT(*) AS total FROM detail_produk $where");
$total_data   = $result_total->fetch_assoc()['total'];
$total_page   = ceil($total_data / $limit);

// Ambil data detail produk sesuai filter
$details = $conn->query("SELECT * FROM detail_produk $where ORDER BY id DESC LIMIT $start, $limit");
?>

<div class="container my-5">
  <div class="row">
    
    <!-- Sidebar Filter -->
    <div class="col-md-3 mb-4">
      <h5 class="fw-bold">Product Group 
        <!-- <a href="?id=<?php echo $produk_id; ?>" class="small ms-2">Reset</a> -->
      </h5>

      <!-- Search box -->
      <input type="text" id="groupSearch" class="form-control mb-2" placeholder="Search">

      <form method="get" id="groupForm">
        <input type="hidden" name="id" value="<?php echo $produk_id; ?>">
        <?php if ($search !== ""): ?>
          <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
        <?php endif; ?>

        <div class="border p-2" style="max-height:400px; overflow-y:auto;">
          <?php while($pg = $productGroups->fetch_assoc()): ?>
            <div class="form-check">
              <input class="form-check-input group-filter" 
                     type="checkbox" 
                     name="group[]" 
                     value="<?php echo $pg['id']; ?>"
                     <?php echo in_array($pg['id'], $selected_groups) ? "checked" : ""; ?>
                     onchange="document.getElementById('groupForm').submit();">
              <label class="form-check-label">
                <?php echo htmlspecialchars($pg['nama']); ?> (<?php echo $pg['total']; ?>)
              </label>
            </div>
          <?php endwhile; ?>
        </div>
      </form>
    </div>

    <!-- Konten Produk -->
    <div class="col-md-9">
      <div class="text-center mb-5">
        <!-- <h2 class="fw-bold"><?php echo htmlspecialchars($produk['nama']); ?></h2> -->
        <h2 class="fw-bold">DETAIL PRODUK</h2>
      </div>

      <!-- Form pencarian global -->
      <form method="get" class="row mb-4">
        <input type="hidden" name="id" value="<?php echo $produk_id; ?>">
        <?php foreach($selected_groups as $sg): ?>
          <input type="hidden" name="group[]" value="<?php echo htmlspecialchars($sg); ?>">
        <?php endforeach; ?>
        <div class="col-md-12 d-flex">
          <input type="text" name="search" class="form-control me-2" 
                 value="<?php echo htmlspecialchars($search); ?>">
          <button type="submit" class="btn btn-primary me-2">Cari</button>
          <a href="?id=<?php echo $produk_id; ?>" class="btn btn-secondary">Reset</a>
        </div>
      </form>

      <h4 class="mb-4">Daftar Produk</h4>

      <?php if ($details->num_rows > 0): ?>
        <div class="row g-4">
          <?php while($row = $details->fetch_assoc()): ?>
            <div class="col-md-3 col-sm-6">
              <div class="card shadow-sm h-100 border-0 rounded-3">
                <div class="text-center p-3">
                  <?php if (!empty($row['gambar'])): ?>
                    <img src="../uploads/<?php echo htmlspecialchars($row['gambar']); ?>" 
                         class="img-fluid" style="max-height:150px; object-fit:contain;">
                  <?php else: ?>
                    <img src="../assets/no-image.png" 
                         class="img-fluid" style="max-height:150px; object-fit:contain;">
                  <?php endif; ?>
                </div>
                <div class="card-body d-flex flex-column">
                  <h6 class="card-title text-center fw-bold mb-3">
                    <?php echo htmlspecialchars($row['brand_mobil']); ?> - <?php echo htmlspecialchars($row['nama_mobil']); ?>
                  </h6>
                  <ul class="list-unstyled small text-muted flex-grow-1">
                    <li><strong>No. Kabis:</strong> <?php echo htmlspecialchars($row['no_kabis']); ?></li>
                    <li><strong>No. OEM:</strong> <?php echo htmlspecialchars($row['no_oem']); ?></li>
                    <li><strong>Deskripsi:</strong><br> <?php echo nl2br(htmlspecialchars($row['deskripsi'])); ?></li>
                  </ul>
                  <p class="text-center fs-6 fw-bold text-primary mb-3">
                    Rp <?php echo number_format($row['harga'],0,',','.'); ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <nav class="mt-4">
          <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
              <li class="page-item">
                <a class="page-link" href="?id=<?php echo $produk_id; ?>&search=<?php echo urlencode($search); ?><?php foreach($selected_groups as $sg) echo "&group[]=".urlencode($sg); ?>&page=1">Awal</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="?id=<?php echo $produk_id; ?>&search=<?php echo urlencode($search); ?><?php foreach($selected_groups as $sg) echo "&group[]=".urlencode($sg); ?>&page=<?php echo $page-1; ?>">&laquo;</a>
              </li>
            <?php endif; ?>

            <?php
            $start_page = max(1, $page - 2);
            $end_page   = min($total_page, $page + 2);

            if ($start_page > 1) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }

            for ($i = $start_page; $i <= $end_page; $i++): ?>
              <li class="page-item <?php echo ($i==$page) ? 'active' : ''; ?>">
                <a class="page-link" href="?id=<?php echo $produk_id; ?>&search=<?php echo urlencode($search); ?><?php foreach($selected_groups as $sg) echo "&group[]=".urlencode($sg); ?>&page=<?php echo $i; ?>">
                  <?php echo $i; ?>
                </a>
              </li>
            <?php endfor;

            if ($end_page < $total_page) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
            ?>

            <?php if ($page < $total_page): ?>
              <li class="page-item">
                <a class="page-link" href="?id=<?php echo $produk_id; ?>&search=<?php echo urlencode($search); ?><?php foreach($selected_groups as $sg) echo "&group[]=".urlencode($sg); ?>&page=<?php echo $page+1; ?>">&raquo;</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="?id=<?php echo $produk_id; ?>&search=<?php echo urlencode($search); ?><?php foreach($selected_groups as $sg) echo "&group[]=".urlencode($sg); ?>&page=<?php echo $total_page; ?>">Akhir</a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>

      <?php else: ?>
        <p class="text-center">Belum ada detail produk untuk produk ini.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>
document.getElementById('groupSearch').addEventListener('keyup', function(){
  let filter = this.value.toLowerCase();
  document.querySelectorAll('.group-filter').forEach(el => {
    let label = el.nextElementSibling.textContent.toLowerCase();
    el.parentElement.style.display = label.includes(filter) ? '' : 'none';
  });
});
</script>

<?php include "../templates/footer.php"; ?>