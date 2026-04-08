<!DOCTYPE html>
<html>
<head>
    <title>Input KHS Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="card">

        <div style="text-align:center; margin-bottom:20px;">
            <img src="logo.png" alt="Logo Polije" class="logo" style="width:80px; margin-bottom:10px;">
            <h2>Input KHS Mahasiswa</h2>
            <p style="font-size:14px; color:#555;">Lengkapi data berikut untuk menampilkan KHS</p>
        </div>

        <!-- FORM -->
        <form method="POST" action="hasil.php" id="khsForm">

            <input type="text" name="nama" placeholder="Nama Mahasiswa" required>
            <input type="text" name="nim" placeholder="NIM" required>

            <label>Program Studi</label>
            <select name="programStudi" required>
                <option value="">-- Pilih Program Studi --</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Bisnis Digital">Bisnis Digital</option>
                <option value="Produksi Media">Produksi Media</option>
                <option value="Manajemen Pemasaran Internasional">Manajemen Pemasaran Internasional</option>
            </select>

            <label>Dosen Wali</label>
            <select name="dosen" required>
                <option value="">-- Pilih Dosen --</option>
                <option value="D001">Eka Yuniar S.Kom., MMSI</option>
                <option value="D002">Mas'ud Hermansyah M.Kom</option>
                <option value="D003">Lukman Hakim S.Kom., M.Kom</option>
                <option value="D004">Rizky Aditya Nugroho S.A.B., M.M</option>
                <option value="D005">Imam Abrori S.E., M.M</option>
            </select>

            <div id="matkulContainer">
                <div class="matkulRow">
                    <label>Mata Kuliah</label>
                    <select name="mk1" class="mkSelect" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        <option value="PBO">Pemrograman Berorientasi Objek</option>
                        <option value="VKB">Visualisasi Keputusan Bisnis</option>
                        <option value="DG">Desain Grafis dan Multimedia</option>
                        <option value="BI">Bahasa Indonesia</option>
                        <option value="PKN">Kewarganegaraan</option>
                        <option value="IE">Intermediate English</option>
                    </select>
                    <input type="number" name="nilai1" placeholder="Nilai (0-100)" min="0" max="100" required>
                </div>
            </div>

            <button type="button" id="addMatkul">Tambah Mata Kuliah</button>
            <button type="submit">Lihat KHS</button>

        </form>
    </div>
</div>

<script>
let count = 1;
document.getElementById("addMatkul").addEventListener("click", function(){
    count++;
    const container = document.getElementById("matkulContainer");
    const div = document.createElement("div");
    div.classList.add("matkulRow");
    div.innerHTML = `
        <label>Mata Kuliah</label>
        <select name="mk${count}" class="mkSelect" required>
            <option value="">-- Pilih Mata Kuliah --</option>
            <option value="PBO">Pemrograman Berorientasi Objek</option>
            <option value="VKB">Visualisasi Keputusan Bisnis</option>
            <option value="DG">Desain Grafis dan Multimedia</option>
            <option value="BI">Bahasa Indonesia</option>
            <option value="PKN">Kewarganegaraan</option>
            <option value="IE">Intermediate English</option>
        </select>
        <input type="number" name="nilai${count}" placeholder="Nilai (0-100)" min="0" max="100" required>
    `;
    container.appendChild(div);
});

document.getElementById("khsForm").addEventListener("submit", function(e){
    const selects = document.querySelectorAll(".mkSelect");
    let values = Array.from(selects).map(s => s.value).filter(v => v !== "");
    let unique = new Set(values);
    if(values.length !== unique.size){
        alert("Mata kuliah tidak boleh sama!");
        e.preventDefault();
    }
});
</script>

</body>
</html>