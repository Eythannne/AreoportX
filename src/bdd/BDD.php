<?php

class BDD
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new PDO('mysql:host=localhost;dbname=areoportx;charset=utf8', 'root','' );
    }
    public function getBdd()
    {
        return $this->bdd;
    }
}
