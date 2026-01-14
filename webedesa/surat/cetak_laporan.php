<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Data Penduduk</title>
    <style>
        /* Reset CSS agar rapi saat diprint */
        body { font-family: "Times New Roman", serif; font-size: 11pt; padding: 20px; }
        
        /* Kop Laporan */
        .kop { text-align: center; margin-bottom: 20px; text-transform: uppercase; }
        .kop h2 { margin: 0; font-size: 16pt; }
        .kop h4 { margin: 0; font-size: 12pt; font-weight: normal; }
        .line { border-bottom: 2px solid #000; margin-top: 10px; margin-bottom: 20px; }

        /* Tabel Data */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th { background-color: #f2f2f2; padding: 8px; text-align: center; }
        td { padding: 5px 8px; vertical-align: top; }
        
        /* Tanda Tangan */
        .ttd { float: right; text-align: center; width: 250px; margin-top: 30px; }

        /* Pengaturan Kertas Landscape */
        @page { size: landscape; margin: 20mm; }
        @media print {
            .no-print { display: none; } /* Sembunyikan tombol saat dicetak */
        }
    </style>
</head>
<body onload="window.print()">

    <button class="no-print" onclick="window.history.back()" style="margin-bottom: 20px; padding: 10px;">Kembali</button>

    <div class="kop">
        <h2>PEMERINTAH KABUPATEN CONTOH</h2>
        <h2>KECAMATAN CONTOH</h2>
        <h2>DESA DIGITAL SEJAHTERA</h2>
        <h4>Laporan Data Penduduk Per Tanggal: <?= date('d F Y') ?></h4>
        <div class="line"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">NIK</th>
                <th width="20%">Nama Lengkap</th>
                <th width="5%">L/P</th>
                <th width="15%">Tempat, Tgl Lahir</th>
                <th width="10%">Agama</th>
                <th width="10%">Pekerjaan</th>
                <th width="20%">Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            // Ambil data diurutkan berdasarkan nama
            $query = mysqli_query($koneksi, "SELECT * FROM penduduk ORDER BY nama ASC");
            
            if(mysqli_num_rows($query) > 0){
                while($data = mysqli_fetch_array($query)){
            ?>
            <tr>
                <td style="text-align: center;"><?= $no++ ?></td>
                <td><?= $data['nik'] ?></td>
                <td><?= strtoupper($data['nama']) ?></td>
                <td style="text-align: center;"><?= $data['jk'] ?></td>
                <td><?= $data['tempat_lahir'] ?>, <?= date('d-m-Y', strtotime($data['tgl_lahir'])) ?></td>
                <td><?= $data['agama'] ?></td>
                <td><?= $data['pekerjaan'] ?></td>
                <td><?= $data['alamat'] ?></td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='8' style='text-align:center'>Belum ada data penduduk.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="ttd">
        <p>Desa Digital, <?= date('d F Y') ?></p>
        <p>Kepala Desa</p>
        <br><br><br><br>
        <p><b>( NAMA KADES )</b></p>
    </div>

</body>
</html>