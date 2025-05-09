<?php
include "../../repository/RepositoryPilote.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Pilote.php";
var_dump($_POST);
if(empty($_POST["nom"]) ||
    empty($_POST["prenom"]) ||
    empty($_POST["email"]))
{
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    return;
}

$pilote = new Pilote(array(
    'idPilote' => $_POST['id_pilote'],
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'email' => $_POST['email']
));

var_dump($pilote);
$repositoryPilote = new repositoryPilote();
$resultatPilote = $repositoryPilote->modification($pilote);
header("Location: ../../../vue/accueilAdmin.php");

