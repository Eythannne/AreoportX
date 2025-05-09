<?php
include "../../repository/RepositoryVol.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Vol.php";
var_dump($_POST);
if(empty($_POST["destination"]) ||
    empty($_POST["date"]) ||
    empty($_POST["heure_depart"]) ||
    empty($_POST["heure_arrivee"]) ||
    empty($_POST["ref_avion"]) ||
    empty($_POST["ref_pilote"]))
{
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    return;
}

$vol = new Vol(array(
    'idVol' => $_POST["idVol"],
    'destination' => $_POST['destination'],
    'date' => $_POST['date'],
    'heureDepart' => $_POST['heure_depart'],
    'heureArrivee' => $_POST['heure_arrivee'],
    'refAvion' => $_POST['ref_avion'],
    'refPilote' => $_POST['ref_pilote']
));

$repositoryVol = new repositoryVol();
$resultatVol = $repositoryVol->modification($vol);
header("Location: ../../../vue/accueilAdmin.php");

