<?php include __DIR__ . "/../config/database.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kabis Indonesia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container">
    <a class="navbar-brand" href="../public/index.php">
      <img src="../public/assets/img/logo.webp" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#tentang">Tentang Kami</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#brand">Brand Kami</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#produk">Produk</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#artikel">Artikel</a></li>
        <li class="nav-item"><a class="nav-link" href="hubungi.php">Hubungi Kami</a></li>
      </ul>
      <div class="d-flex">
        <select class="form-select text-light bg-primary" aria-label="Pilih Bahasa" onchange="location = this.value;">
          <option value="#" selected>ID</option>
          <!-- <option value="#">EN</option>
          <option value="#">MY</option>
          <option value="#">CH</option>
          <option value="#">TH</option>
          <option value="#">VN</option> -->
        </select>
      </div>
    </div>
  </div>
</nav>