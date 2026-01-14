<?php include 'header.php'; include 'koneksi.php'; 
// Hitung jumlah penduduk
$count = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM penduduk"));
?>

<h3>Dashboard Sistem Informasi Desa</h3>
<p>Selamat Datang, <b><?= $_SESSION['user'] ?></b> di Panel Administrasi.</p>
<hr>

<div class="row">
    <div class="col-md-4">
        <div class="card bg-success text-white p-4">
            <h4>Total Warga</h4>
            <h1 class="display-4 fw-bold"><?= $count ?></h1>
            <p>Orang terdaftar</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-warning text-dark p-4">
            <h4>Layanan Surat</h4>
            <h1 class="display-4 fw-bold">Active</h1>
            <p>Siap digunakan</p>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
