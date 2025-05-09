<?php
include "../../repository/RepositoryAvion.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Avion.php";


var_dump($_GET);
if(empty(
$_GET["id"]))
{

    var_dump($_POST);
    echo "Erreur : ID avion requis";
    return;
}

$avion = new Avion(array(
    'idAvion' => $_GET["id"]

));

var_dump($avion);

$repository = new repositoryAvion();
$resultat = $repository->suppression($avion);
header("Location: ../../../vue/accueilAdmin.php");