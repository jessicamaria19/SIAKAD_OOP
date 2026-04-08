<?php
require_once 'classes/Mahasiswa.php';
require_once 'classes/MataKuliah.php';
require_once 'classes/Nilai.php';
require_once 'classes/KHS.php';
require_once 'classes/Dosen.php';

function getDosen($kode) {
    if ($kode == "D001") return new Dosen("Eka Yuniar, S.Kom., MMSI", "D001");
    if ($kode == "D002") return new Dosen("Mas'ud Hermansyah, M.Kom", "D002");
    if ($kode == "D003") return new Dosen("Lukman Hakim, S.Kom., M.Kom", "D003");
    if ($kode == "D004") return new Dosen("Rizky Aditya Nugroho S.A.B., M.M", "D004");
    if ($kode == "D005") return new Dosen("Imam Abrori S.E., M.M", "D005");

    return new Dosen("Tidak diketahui", "-");
}

function getMatkul($kode) {
    if ($kode == "PBO") return new MataKuliah("Pemrograman Berorientasi Objek", 4);
    if ($kode == "VKB") return new MataKuliah("Visualisasi Keputusan Bisnis", 4);
    if ($kode == "DG") return new MataKuliah("Desain Grafis dan Multimedia", 4);
    if ($kode == "BI") return new MataKuliah("Bahasa Indonesia", 2);
    if ($kode == "PKN") return new MataKuliah("Kewarganegaraan", 2);
    if ($kode == "IE") return new MataKuliah("Intermediate English", 3);
}

$nama = $_POST['nama'] ?? '';
$nim = $_POST['nim'] ?? '';
$programStudi = $_POST['programStudi'] ?? '';
$dosenKode = $_POST['dosen'] ?? '';

$mhs = new Mahasiswa($nama, $nim, $programStudi, getDosen($dosenKode));

$khs = new KHS($mhs);

for ($i = 1; $i <= 6; $i++) {
    $mk = $_POST["mk$i"] ?? '';
    $nilai = $_POST["nilai$i"] ?? 0;

    if ($mk != '') {
        $khs->tambahNilai(new Nilai(getMatkul($mk), $nilai));
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil KHS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <?php $khs->cetak(); ?>

    <div style="text-align:center; margin-top:20px;">
        <button onclick="window.print()">Cetak KHS</button>
    </div>

    <div class="card">
        <a href="input.php">
            <button>Kembali ke Input</button>
        </a>
    </div>

</div>

</body>
</html>