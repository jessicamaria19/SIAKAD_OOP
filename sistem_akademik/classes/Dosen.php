<?php
require_once 'User.php';

class Dosen extends User {
    private $nidn;

    public function __construct($nama, $nidn) {
        parent::__construct($nama);
        $this->nidn = $nidn;
    }

    public function getInfo() {
        return "Dosen: $this->nama ($this->nidn)";
    }
}