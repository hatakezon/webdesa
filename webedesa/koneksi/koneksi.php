<?php
// Mengambil data dari Environment Variables Vercel
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');

// Jika variabel kosong (artinya sedang dijalankan di laptop/XAMPP), pakai settingan lokal
if(!$host){
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'db_desa_baru';
}

$koneksi = mysqli_connect($host, $user, $pass, $db);

if(!$koneksi){
    die("Gagal Terhubung: " . mysqli_connect_error());
}
?>
