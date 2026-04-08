<?php
require_once 'CetakLaporan.php';

class KHS implements CetakLaporan {
    private $mahasiswa;
    private $listNilai = [];

    public function __construct($mahasiswa) {
        $this->mahasiswa = $mahasiswa;
    }

    public function tambahNilai($nilai) {
        $this->listNilai[] = $nilai;
    }

    private function konversiNilai($nilai) {
        if ($nilai >= 85) return 4;
        elseif ($nilai >= 75) return 3;
        elseif ($nilai >= 65) return 2;
        elseif ($nilai >= 50) return 1;
        else return 0;
    }

    private function getHuruf($nilai) {
        if ($nilai >= 85) return "A";
        elseif ($nilai >= 75) return "B";
        elseif ($nilai >= 65) return "C";
        elseif ($nilai >= 50) return "D";
        else return "E";
    }

    public function hitungIPK() {
        $totalMutu = 0;
        $totalSks = 0;

        foreach ($this->listNilai as $n) {
            $bobot = $this->konversiNilai($n->getNilai());
            $sks = $n->getMatkul()->getSks();

            $totalMutu += $bobot * $sks;
            $totalSks += $sks;
        }

        return $totalSks > 0 ? round($totalMutu / $totalSks, 2) : 0;
    }

    private function getTotalSks() {
        $total = 0;
        foreach ($this->listNilai as $n) {
            $total += $n->getMatkul()->getSks();
        }
        return $total;
    }

    public function cetak() {
        $ipk = $this->hitungIPK();

        echo "<div class='container'>";
        echo "<div class='card'>";

        echo "
        <div class='header-khs'>
            <img src='logo.png' class='logo'>
            <div class='header-text'>
                <h3>KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI</h3>
                <p>Jl. Mastrip PO.BOX 164 Telp 333532 - 333534 Fax 333531 Jember 68101</p>
                <p>Website: www.polije.ac.id E-Mail : politeknik@polije.ac.id</p>
            </div>
        </div>
        ";

        echo "
        <div class='title'>
            <h2>KARTU HASIL STUDI</h2>
            <span class='semester'>SEMESTER GANJIL 2025/2026</span>
        </div>
        ";

        echo "<div class='info-khs'>";
        echo "<p><b>Nama:</b> " . $this->mahasiswa->getNama() . "</p>";
        echo "<p><b>NIM:</b> " . $this->mahasiswa->getNim() . "</p>";
        echo "<p><b>Program Studi:</b> " . $this->mahasiswa->getProgramStudi() . "</p>";

        $dosen = $this->mahasiswa->getDosenWali();
        $namaDosen = $dosen ? $dosen->getNama() : "-";

        echo "<p><b>Dosen Wali:</b> $namaDosen</p>";
        echo "</div>";

        echo "<table class='table-khs'>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Nilai</th>
                    <th>Huruf</th>
                    <th>Bobot</th>
                    <th>Mutu</th>
                </tr>";

        $no = 1;
        foreach ($this->listNilai as $n) {
            $nilai = $n->getNilai();
            $huruf = $this->getHuruf($nilai);
            $bobot = $this->konversiNilai($nilai);
            $sks = $n->getMatkul()->getSks();
            $mutu = $bobot * $sks;

            echo "<tr>
                    <td>$no</td>
                    <td>".$n->getMatkul()->getNama()."</td>
                    <td>$sks</td>
                    <td>$nilai</td>
                    <td>$huruf</td>
                    <td>$bobot</td>
                    <td>$mutu</td>
                  </tr>";

            $no++;
        }

        echo "</table>";

        echo "<div class='footer'>";
        echo "<p><b>Total SKS:</b> " . $this->getTotalSks() . "</p>";
        echo "<p><b>IPK:</b> $ipk</p>";

        echo "
        <table class='ttd'>
            <tr>
                <td>
                    Jember, 26-01-2026<br>
                    Ketua Jurusan <br><br><br>
                    _____________________
                </td>
                <td>
                    Dosen Wali<br><br><br><br>
                    _____________________
                    <div>$namaDosen</div>
                </td>
            </tr>
        </table>
        ";

        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}