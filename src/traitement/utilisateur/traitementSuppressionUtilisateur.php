<?php
include "../../repository/RepositoryUtilisateur.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Utilisateur.php";


var_dump($_GET);
if(empty(
    $_GET["id"]))
{

    var_dump($_POST);
    echo "Erreur : ID utilisateur requis";
    return;
}

$user = new Utilisateur(array(
    'idUtilisateur' => $_GET["id"]

));

var_dump($user);

$repository = new repositoryUtilisateur();
$resultat = $repository->suppression($user);
header("Location: ../../../vue/accueilAdmin.php");