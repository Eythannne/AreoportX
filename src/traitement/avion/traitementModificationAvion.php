<?php
include "../../repository/RepositoryAvion.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Avion.php";
var_dump($_POST);
if(empty($_POST["nom"]) ||
    empty($_POST["numero_serie"]) ||
    empty($_POST["nombre_place"]))
{
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    return;
}

$avion = new Avion(array(
    'idAvion' => $_POST['id_avion'],
    'nom' => $_POST['nom'],
    'numeroSerie' => $_POST['numero_serie'],
    'nombrePlace' => $_POST['nombre_place']
));

var_dump($avion);
$repositoryAvion = new repositoryAvion();
$resultatAvion = $repositoryAvion->modification($avion);
header("Location: ../../../vue/accueilAdmin.php");

