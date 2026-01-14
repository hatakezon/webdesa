<?php
include 'koneksi.php';
include 'header.php'; // Header sudah membawa pembuka HTML dan Sidebar

// --- LOGIK PHP ---
if(isset($_POST['upload'])){
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi   = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $tgl   = date('Y-m-d');
    $penulis = $_SESSION['user'] ?? 'Admin';

    $filename = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    
    if($filename != ""){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $new_name = uniqid().".".$ext;
        move_uploaded_file($tmp_name, 'gambar/'.$new_name);
        $sql = "INSERT INTO berita (judul, isi, gambar, tanggal, penulis) VALUES ('$judul', '$isi', '$new_name', '$tgl', '$penulis')";
    } else {
        $sql = "INSERT INTO berita (judul, isi, tanggal, penulis) VALUES ('$judul', '$isi', '$tgl', '$penulis')";
    }
    
    mysqli_query($koneksi, $sql);
    echo "<script>alert('Berita Terbit!'); window.location='berita.php';</script>";
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    $cek = mysqli_query($koneksi, "SELECT gambar FROM berita WHERE id='$id'");
    $d = mysqli_fetch_array($cek);
    if(isset($d['gambar']) && is_file("gambar/".$d['gambar'])) unlink("gambar/".$d['gambar']);
    mysqli_query($koneksi, "DELETE FROM berita WHERE id='$id'");
    echo "<script>window.location='berita.php';</script>";
}
?>

<h3><i class="bi bi-newspaper me-2"></i> Manajemen Berita Desa</h3>
<hr>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">Tulis Berita</div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Isi Berita</label>
                        <textarea name="isi" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <button type="submit" name="upload" class="btn btn-success w-100">Terbitkan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">Arsip Berita</div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr><th>No</th><th>Img</th><th>Judul</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        $q = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC");
                        while($r = mysqli_fetch_array($q)):
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <?php if($r['gambar']): ?>
                                    <img src="gambar/<?= $r['gambar'] ?>" width="50" style="border-radius:5px;">
                                <?php endif; ?>
                            </td>
                            <td>
                                <b><?= $r['judul'] ?></b><br>
                                <small class="text-muted"><?= $r['tanggal'] ?></small>
                            </td>
                            <td>
                                <a href="berita.php?hapus=<?= $r['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">X</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>