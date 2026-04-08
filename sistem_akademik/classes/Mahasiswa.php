<?php
require_once 'User.php';

class Mahasiswa extends User {
    private $nim;
    private $programStudi;
    private $dosenWali;

    public function __construct($nama, $nim, $programStudi, $dosenWali) {
        parent::__construct($nama);
        $this->nim = $nim;
        $this->programStudi = $programStudi;
        $this->dosenWali = $dosenWali;
    }

    public function getNim() {
        return $this->nim;
    }

    public function getProgramStudi() {
        return $this->programStudi;
    }

    public function getDosenWali() {
        return $this->dosenWali;
    }

    public function getInfo() {
        return "Mahasiswa: " . $this->nama . " (" . $this->nim . ")";
    }
}