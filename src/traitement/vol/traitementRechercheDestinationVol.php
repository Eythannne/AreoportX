<?php
require_once "../../bdd/BDD.php";
require_once "../../repository/RepositoryVol.php";

$bdd = (new BDD())->getBdd();
$repoVol = new RepositoryVol($bdd);

if (isset($_GET['destination'])) {
    $destination = trim($_GET['destination']);
    $resultats = $repoVol->rechercherDestination($destination);

    if (count($resultats) > 0) {
        header("Location: ../../../vue/detailVol.php?id=".$resultats[0]["id_vol"]);
    } else {
        header("Location: ../../../accueilAdmin.php");
    }
} else {
    header("Location: ../../../index.php");
    exit();
}
?>