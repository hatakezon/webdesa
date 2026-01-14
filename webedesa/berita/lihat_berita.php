<?php
include 'koneksi.php';

// 1. Cek apakah ada ID di URL
if(!isset($_GET['id'])){
    // Jika tidak ada ID, kembalikan ke halaman berita admin
    header("location:berita.php"); 
    exit; 
}

// 2. Ambil Data Berita berdasarkan ID
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM berita WHERE id='$id'");

// 3. Cek apakah berita ditemukan
if(mysqli_num_rows($query) == 0){
    echo "<center><h3>Maaf, berita tidak ditemukan atau sudah dihapus.</h3><a href='berita.php'>Kembali</a></center>";
    exit;
}

$d = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $d['judul'] ?> - Desa Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="style.css" rel="stylesheet">
</head>
<body style="background-color: #f0f4f3;">

    <div class="public-nav">
        <div class="container">
            <h2 class="fw-bold"><i class="bi bi-tree-fill"></i> PORTAL DESA DIGITAL</h2>
            <p class="opacity-75">Informasi Terkini Seputar Kegiatan Warga</p>
            
            <a href="berita.php" class="btn btn-outline-light btn-sm mt-3 rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    <div class="container">
        <div class="news-container">
            
            <h1 class="news-title"><?= $d['judul'] ?></h1>
            
            <div class="news-meta">
                <span class="me-3">
                    <i class="bi bi-calendar-check text-success"></i> 
                    <?= date('d F Y', strtotime($d['tanggal'])) ?>
                </span>
                <span>
                    <i class="bi bi-person-circle text-success"></i> 
                    Ditulis oleh: <b><?= $d['penulis'] ?></b>
                </span>
            </div>

            <?php if($d['gambar'] != ""): ?>
                <img src="gambar/<?= $d['gambar'] ?>" class="news-hero" alt="Foto Berita">
            <?php endif; ?>

            <div class="news-content mt-4">
                <?= nl2br($d['isi']) ?>
            </div>

            <div class="mt-5 pt-4 border-top text-center">
                <p class="text-muted">Bagikan berita ini:</p>
                <button class="btn btn-success btn-sm me-2"><i class="bi bi-whatsapp"></i> WhatsApp</button>
                <button class="btn btn-primary btn-sm"><i class="bi bi-facebook"></i> Facebook</button>
            </div>

        </div>
    </div>

    <div class="text-center py-4 text-muted mt-5">
        <small>&copy; <?= date('Y') ?> Pemerintah Desa Digital Sejahtera.</small>
    </div>

</body>
</html>