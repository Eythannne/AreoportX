<?php


include "../../repository/RepositoryVol.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Vol.php";
require_once "../../repository/RepositoryVol.php";
var_dump($_POST);

if (empty($_POST["destination"]) ||
    empty($_POST["date"]) ||
    empty($_POST["heure_depart"]) ||
    empty($_POST["heure_arrivee"]) ||
    empty($_POST["ref_avion"]) ||
    empty($_POST["ref_pilote"])
) {
    echo "Toutes les cases doivent être remplis !";
    header("Location: ../../ajoutVol.php");
} else {

    $user = new Vol(array(
        'destination' => $_POST['destination'],
        'date' => $_POST['date'],
        'heureDepart' => $_POST['heure_depart'],
        'heureArrivee' => $_POST['heure_arrivee'],
        'refAvion' => $_POST['ref_avion'],
        'refPilote' => $_POST['ref_pilote']
    ));
    var_dump($user);
    $repository = new RepositoryVol();
    $resultat = $repository->ajout($user);
    var_dump($resultat);
    if ($resultat == true) {
        header("Location: ../../../vue/accueilAdmin.php");
    } else {
        header("Location: ../../../vue/listeVol.php");
    }

}