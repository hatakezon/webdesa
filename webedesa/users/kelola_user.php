<?php
include 'koneksi.php';
include 'header.php';

// CEK: Hanya Admin yang boleh akses halaman ini
if($_SESSION['level'] != 'admin'){
    echo "<script>alert('Anda tidak punya akses ke halaman ini!'); window.location='index.php';</script>";
    exit;
}

// LOGIKA TAMBAH USER
if(isset($_POST['tambah'])){
    $nama = $_POST['nama'];
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);
    $level = $_POST['level'];

    $simpan = mysqli_query($koneksi, "INSERT INTO users (nama_lengkap, username, password, level) VALUES ('$nama','$user','$pass','$level')");
    
    if($simpan){
        echo "<script>alert('User Berhasil Ditambahkan'); window.location='kelola_user.php';</script>";
    }
}

// LOGIKA HAPUS USER
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM users WHERE id='$id'");
    echo "<script>window.location='kelola_user.php';</script>";
}
?>

<h3><i class="bi bi-person-badge-fill"></i> Manajemen Pengguna Sistem</h3>
<hr>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">Buat Akun Baru</div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-2">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Username</label>
                        <input type="text" name="user" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Password</label>
                        <input type="password" name="pass" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Level Akses</label>
                        <select name="level" class="form-select">
                            <option value="penduduk">Penduduk</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="kades">Kepala Desa</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" name="tambah" class="btn btn-success w-100">Simpan User</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">Daftar Pengguna</div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $q = mysqli_query($koneksi, "SELECT * FROM users ORDER BY level ASC");
                        while($r = mysqli_fetch_assoc($q)):
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r['nama_lengkap'] ?></td>
                            <td><?= $r['username'] ?></td>
                            <td>
                                <span class="badge bg-<?= ($r['level']=='admin')?'danger':(($r['level']=='kades')?'warning':'info') ?>">
                                    <?= strtoupper($r['level']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if($r['username'] != 'admin'): // Admin utama tidak boleh dihapus ?>
                                    <a href="kelola_user.php?hapus=<?= $r['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus user ini?')">Hapus</a>
                                <?php endif; ?>
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