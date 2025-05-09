<?php

include "../../repository/RepositoryReservation.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Reservation.php";
require_once "../../repository/RepositoryReservation.php";

if(empty($_POST["nb_place_reserver"]) ||
    empty($_POST["ref_vol"]) ||
    empty($_POST["ref_utilisateur"])
){

    echo "Toutes les cases doivent être remplis !";
    die();
    header("Location: ../../accueilAdmin.php");
}else{
    var_dump($_POST);

    $reservation = new Reservation(array(
        'nbPlaceReserver' => $_POST['nb_place_reserver'],
        'refVol' => $_POST['ref_vol'],
        'refUtilisateur' => $_POST['ref_utilisateur'],
    ));
    var_dump($reservation);
    $repository = new RepositoryReservation();
    $resultat = $repository->ajout($reservation);
    var_dump($resultat);
    //die();
    if($resultat == true){
        header("Location: ../../../vue/accueilAdmin.php");
    }else{
        header("Location: ../../../vue/listeReservation.php");
        exit();
    }

}