<?php 
// Cek status session agar tidak error "Ignoring session_start"
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek login
if(!isset($_SESSION['login'])){ header("location:login.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Desa Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="style.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">
    
    <div class="sidebar p-0" style="width: 260px; flex-shrink: 0;">
        <h4>🌿 DESA DIGITAL</h4>
        
        <div class="sidebar-menu mt-3">
            <a href="index.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="penduduk.php"><i class="bi bi-people"></i> Data Penduduk</a>
            <a href="surat.php"><i class="bi bi-envelope-paper"></i> Layanan Surat</a>
            <a href="berita.php"><i class="bi bi-newspaper"></i> Berita Desa</a> <a href="logout.php" class="text-warning mt-5"><i class="bi bi-box-arrow-left"></i> Keluar</a>
        </div>
    </div>

    <div class="container-fluid p-4" style="height: 100vh; overflow-y: auto; width: 100%;">