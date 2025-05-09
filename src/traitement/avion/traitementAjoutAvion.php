<?php


include "../../repository/RepositoryAvion.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Avion.php";
require_once "../../repository/RepositoryAvion.php";
var_dump($_POST);

if (empty($_POST["nom"]) ||
    empty($_POST["numero_serie"]) ||
    empty($_POST["nombre_place"])
) {
    echo "Toutes les cases doivent être remplis !";
    header("Location: ../../accueilAdmin.php");
} else {

    $user = new Avion(array(
        'nom' => $_POST['nom'],
        'numeroSerie' => $_POST['numero_serie'],
        'nombrePlace' => $_POST['nombre_place']
    ));
    var_dump($user);
    $repository = new RepositoryAvion();
    $resultat = $repository->ajout($user);
    var_dump($resultat);
    if ($resultat == true) {
        header("Location: ../../../vue/accueilAdmin.php");
    } else {
        header("Location: ../../../vue/listeAvion.php");
    }

}