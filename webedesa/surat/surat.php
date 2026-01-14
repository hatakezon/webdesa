<?php include 'koneksi.php'; include 'header.php'; 

if(isset($_POST['cetak'])){
    $nik = $_POST['nik'];
    $jenis = $_POST['jenis'];
    $ket = $_POST['keterangan'];
    echo "<script>window.open('cetak_surat.php?nik=$nik&jenis=$jenis&ket=$ket', '_blank');</script>";
}
?>

<h3><i class="bi bi-printer"></i> Pelayanan Surat</h3>
<hr>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">Formulir Cetak Surat</div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label>Pilih Penduduk</label>
                        <select name="nik" class="form-select" required>
                            <option value="">-- Cari Nama / NIK --</option>
                            <?php
                            $q = mysqli_query($koneksi, "SELECT * FROM penduduk ORDER BY nama ASC");
                            while($r = mysqli_fetch_array($q)){
                                echo "<option value='$r[nik]'>$r[nik] - $r[nama]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Jenis Surat</label>
                        <select name="jenis" class="form-select" required>
                            <option value="domisili">Surat Keterangan Domisili</option>
                            <option value="usaha">Surat Keterangan Usaha</option>
                            <option value="sktm">Surat Keterangan Tidak Mampu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Keperluan / Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Pengajuan KUR BRI, Melamar Kerja, dll"></textarea>
                    </div>
                    <button type="submit" name="cetak" class="btn btn-primary w-100">Cetak Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>