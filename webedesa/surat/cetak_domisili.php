<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM penduduk WHERE id='$id'"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Surat Keterangan Domisili</title>
    <style>
        body { font-family: "Times New Roman", Times, serif; padding: 40px; }
        .kop { text-align: center; border-bottom: 3px double black; margin-bottom: 20px; }
        .isi { margin-left: 30px; }
        .ttd { float: right; margin-top: 50px; text-align: center; }
    </style>
</head>
<body onload="window.print()">

    <div class="kop">
        <h3>PEMERINTAH KABUPATEN CONTOH<br>KECAMATAN MAJU JAYA<br>DESA DIGITAL SEJAHTERA</h3>
        <p>Alamat: Jl. Merdeka No. 45 Kode Pos 12345</p>
    </div>

    <center>
        <h4><u>SURAT KETERANGAN DOMISILI</u></h4>
        <p>Nomor: 470 / ... / DS / ...</p>
    </center>

    <p>Yang bertanda tangan di bawah ini Kepala Desa Digital Sejahtera, menerangkan bahwa:</p>

    <div class="isi">
        <table>
            <tr><td width="150">NIK</td><td>: <b><?= $data['nik'] ?></b></td></tr>
            <tr><td>Nama</td><td>: <b><?= $data['nama'] ?></b></td></tr>
            <tr><td>Jenis Kelamin</td><td>: <?= ($data['jk']=='L')?'Laki-laki':'Perempuan' ?></td></tr>
            <tr><td>Alamat</td><td>: Desa Digital Sejahtera, RT 01 RW 02</td></tr>
        </table>
    </div>

    <p>Adalah benar-benar warga yang berdomisili di desa kami. Surat ini dibuat untuk keperluan administrasi.</p>

    <div class="ttd">
        <p>Desa Digital, <?= date('d F Y') ?></p>
        <p>Kepala Desa</p>
        <br><br><br>
        <p><b>( BAPAK KADES )</b></p>
    </div>

</body>
</html>