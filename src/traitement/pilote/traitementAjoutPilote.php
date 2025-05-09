<?php


include "../../repository/RepositoryPilote.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Pilote.php";
require_once "../../repository/RepositoryPilote.php";
var_dump($_POST);

if (empty($_POST["nom"]) ||
    empty($_POST["prenom"]) ||
    empty($_POST["email"])
) {
    echo "Toutes les cases doivent être remplis !";
    header("Location: ../../accueilAdmin.php");
} else {

    $user = new Pilote(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email']
    ));
    var_dump($user);
    $repository = new RepositoryPilote();
    $resultat = $repository->ajout($user);
    var_dump($resultat);
    if ($resultat == true) {
        header("Location: ../../../vue/accueilAdmin.php");
    } else {
        header("Location: ../../../vue/listePilote.php");
    }

}