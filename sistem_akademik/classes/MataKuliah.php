<?php
class MataKuliah {
    private $nama;
    private $sks;

    public function __construct($nama, $sks) {
        $this->nama = $nama;
        $this->sks = $sks;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getSks() {
        return $this->sks;
    }
}