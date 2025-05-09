<?php
include "../../repository/RepositoryVol.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Vol.php";


var_dump($_GET);
if(empty(
$_GET["id"]))
{

    var_dump($_POST);
    echo "Erreur : ID avion requis";
    return;
}

$vol = new Vol(array(
    'idVol' => $_GET["id"]

));

var_dump($vol);

$repository = new repositoryVol();
$resultat = $repository->suppression($vol);
header("Location: ../../../vue/accueilAdmin.php");