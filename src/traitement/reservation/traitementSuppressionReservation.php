<?php
include "../../repository/RepositoryReservation.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Reservation.php";


var_dump($_GET);
if(empty(
$_GET["id"]))
{

    var_dump($_POST);
    echo "Erreur : ID reservation requis";
    return;
}

$reservation = new Reservation(array(
    'idReservation' => $_GET["id"]

));

var_dump($reservation);

$repository = new repositoryReservation();
$resultat = $repository->suppression($reservation);
header("Location: ../../../vue/accueilAdmin.php");