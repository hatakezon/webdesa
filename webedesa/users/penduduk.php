<?php
include 'koneksi.php';
include 'header.php';

// PROSES SIMPAN
if(isset($_POST['simpan'])){
    $nik = $_POST['nik']; $nama = $_POST['nama'];
    $tmpl = $_POST['tempat_lahir']; $tgll = $_POST['tgl_lahir'];
    $jk = $_POST['jk']; $agama = $_POST['agama'];
    $pkj = $_POST['pekerjaan']; $alamat = $_POST['alamat'];

    $sql = "INSERT INTO penduduk (nik, nama, tempat_lahir, tgl_lahir, jk, agama, pekerjaan, alamat) 
            VALUES ('$nik', '$nama', '$tmpl', '$tgll', '$jk', '$agama', '$pkj', '$alamat')";
    
    if(mysqli_query($koneksi, $sql)){
        echo "<script>alert('Data Berhasil Disimpan'); window.location='penduduk.php';</script>";
    } else {
        echo "<script>alert('Gagal! NIK mungkin sudah ada.');</script>";
    }
}

// PROSES HAPUS
if(isset($_GET['hapus'])){
    mysqli_query($koneksi, "DELETE FROM penduduk WHERE id='$_GET[hapus]'");
    echo "<script>window.location='penduduk.php';</script>";
}
?>

<h3><i class="bi bi-people"></i> Data Penduduk</h3>
<hr>

<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-table me-2"></i>Daftar Warga</span>
        
        <a href="cetak_laporan.php" target="_blank" class="btn btn-sm btn-light border fw-bold text-success">
            <i class="bi bi-printer-fill me-1"></i> Cetak Laporan
        </a>
    </div>
    
    <div class="card-body bg-light">
        <h6 class="mb-3">Input Penduduk Baru:</h6>
        <form method="POST">
            <div class="row g-2">
                <div class="col-md-3"><input type="text" name="nik" class="form-control" placeholder="NIK (Wajib)" required></div>
                <div class="col-md-3"><input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required></div>
                <div class="col-md-2"><input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir"></div>
                <div class="col-md-2"><input type="date" name="tgl_lahir" class="form-control"></div>
                <div class="col-md-2">
                    <select name="jk" class="form-select">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-2"><input type="text" name="agama" class="form-control" placeholder="Agama"></div>
                <div class="col-md-3"><input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan"></div>
                <div class="col-md-5"><input type="text" name="alamat" class="form-control" placeholder="Alamat Lengkap"></div>
                <div class="col-md-2"><button type="submit" name="simpan" class="btn btn-primary w-100">Simpan</button></div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <thead>
                <tr><th>NIK</th><th>Nama</th><th>L/P</th><th>Pekerjaan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                <?php
                $tampil = mysqli_query($koneksi, "SELECT * FROM penduduk ORDER BY id DESC");
                while($d = mysqli_fetch_array($tampil)):
                ?>
                <tr>
                    <td><?= $d['nik'] ?></td>
                    <td><?= $d['nama'] ?></td>
                    <td><?= $d['jk'] ?></td>
                    <td><?= $d['pekerjaan'] ?></td>
                    <td>
                        <a href="penduduk.php?hapus=<?= $d['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'footer.php'; ?>