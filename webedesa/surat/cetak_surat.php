<?php
include 'koneksi.php';
$nik = $_GET['nik'];
$jenis = $_GET['jenis'];
$ket = $_GET['ket'];

// Ambil Data Warga
$q = mysqli_query($koneksi, "SELECT * FROM penduduk WHERE nik='$nik'");
$d = mysqli_fetch_array($q);

if(!$d) { die("Data Penduduk Tidak Ditemukan!"); }

// Logika Isi Surat
if($jenis == 'domisili'){
    $judul = "SURAT KETERANGAN DOMISILI";
    $kode = "470";
    $isi = "Bahwa nama tersebut di atas adalah benar-benar warga Desa Digital Sejahtera dan saat ini berdomisili di alamat tersebut di atas.";
} elseif($jenis == 'usaha'){
    $judul = "SURAT KETERANGAN USAHA";
    $kode = "510";
    $isi = "Bahwa yang bersangkutan benar-benar memiliki usaha: <b>Pedagang / Petani</b> di wilayah desa kami.";
} else {
    $judul = "SURAT KETERANGAN TIDAK MAMPU";
    $kode = "401";
    $isi = "Bahwa yang bersangkutan berasal dari keluarga Pra-Sejahtera (Kurang Mampu).";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Surat</title>
    <style>
        body { font-family: "Times New Roman", serif; padding: 40px; }
        .kop { text-align: center; border-bottom: 3px double #000; margin-bottom: 20px; }
        h3, h4 { margin: 0; }
        .tabel-bio { width: 100%; margin-top: 10px; }
        .tabel-bio td { padding: 4px; vertical-align: top; }
        .ttd { float: right; text-align: center; margin-top: 50px; }
    </style>
</head>
<body onload="window.print()">

    <div class="kop">
        <h3>PEMERINTAH KABUPATEN CONTOH</h3>
        <h4>KECAMATAN CONTOH</h4>
        <h3>DESA DIGITAL SEJAHTERA</h3>
        <small>Jl. Raya Desa No. 1 Kode Pos 12345</small>
    </div>

    <center>
        <h3><u><?= $judul ?></u></h3>
        <p>Nomor: <?= $kode ?> / <?= rand(100,999) ?> / DS / <?= date('Y') ?></p>
    </center>

    <p>Yang bertanda tangan di bawah ini Kepala Desa Digital Sejahtera, menerangkan bahwa:</p>

    <table class="tabel-bio">
        <tr><td width="150">Nama</td><td>: <b><?= strtoupper($d['nama']) ?></b></td></tr>
        <tr><td>NIK</td><td>: <?= $d['nik'] ?></td></tr>
        <tr><td>Tempat, Tgl Lahir</td><td>: <?= $d['tempat_lahir'] ?>, <?= date('d-m-Y', strtotime($d['tgl_lahir'])) ?></td></tr>
        <tr><td>Jenis Kelamin</td><td>: <?= ($d['jk']=='L') ? 'Laki-laki' : 'Perempuan' ?></td></tr>
        <tr><td>Agama</td><td>: <?= $d['agama'] ?></td></tr>
        <tr><td>Pekerjaan</td><td>: <?= $d['pekerjaan'] ?></td></tr>
        <tr><td>Alamat</td><td>: <?= $d['alamat'] ?></td></tr>
    </table>

    <p><?= $isi ?></p>
    <p>Surat ini dibuat untuk keperluan: <b><?= $ket ?></b>.</p>
    <p>Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>

    <div class="ttd">
        <p>Desa Digital, <?= date('d F Y') ?></p>
        <p>Kepala Desa</p>
        <br><br><br>
        <p><b>( BAPAK KADES )</b></p>
    </div>

</body>
</html>