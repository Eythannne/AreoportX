<?php
include "../../repository/RepositoryPilote.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Pilote.php";


var_dump($_GET);
if(empty(
$_GET["id"]))
{

    var_dump($_POST);
    echo "Erreur : ID pilote requis";
    return;
}

$pilote = new Pilote(array(
    'idPilote' => $_GET["id"]

));

var_dump($pilote);

$repository = new repositoryPilote();
$resultat = $repository->suppression($pilote);
header("Location: ../../../vue/accueilAdmin.php");