<?php
include "../../repository/RepositoryReservation.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Reservation.php";
var_dump($_POST);
if(empty($_POST["nb_place_reserver"]) ||
    empty($_POST["ref_vol"]) ||
    empty($_POST["ref_utilisateur"]))
{
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    return;
}

$reservation = new Reservation(array(
    'idReservation' => $_POST["idReservation"],
    'nbPlaceReserver' => $_POST['nb_place_reserver'],
    'refVol' => $_POST['ref_vol'],
    'refUtilisateur' => $_POST['ref_utilisateur']
));

$repositoryReservation = new repositoryReservation();
$resultatReservation = $repositoryReservation->modification($reservation);
header("Location: ../../../vue/accueilAdmin.php");

