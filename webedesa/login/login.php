<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = md5($_POST['password']); // Menggunakan MD5 sesuai database

    // Cek user di database
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$user' AND password='$pass'");
    $hitung = mysqli_num_rows($cek);

    if($hitung > 0){
        $data = mysqli_fetch_assoc($cek);
        
        // Simpan data ke session
        $_SESSION['login'] = true;
        $_SESSION['user'] = $data['username'];
        $_SESSION['nama'] = $data['nama_lengkap'];
        $_SESSION['level'] = $data['level']; // PENTING: Menyimpan Level User

        echo "<script>alert('Login Berhasil! Selamat datang {$data['nama_lengkap']}'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Username atau Password Salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Sistem Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

<div class="card shadow p-4" style="width: 400px;">
    <h3 class="text-center mb-4 text-success">Login Desa Digital</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-success w-100">MASUK</button>
    </form>
</div>

</body>
</html>