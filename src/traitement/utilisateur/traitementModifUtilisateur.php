<?php
include "../../repository/RepositoryUtilisateur.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Utilisateur.php";
var_dump($_POST);
if(empty($_POST["nom"]) ||
    empty($_POST["prenom"]) ||
    empty($_POST["date_naissance"]) ||
    empty($_POST["email"]))
{
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    return;
}

$user = new Utilisateur(array(
    'idUtilisateur' => $_POST['id_utilisateur'],
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'dateNaissance' => $_POST['date_naissance'],
    'email' => $_POST['email']
));

var_dump($user);
$repository = new repositoryUtilisateur();
$resultat = $repository->modif($user);
header("Location: ../../../index.php");

