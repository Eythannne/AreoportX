<?php
include "../src/repository/RepositoryUtilisateur.php";
require_once "../src/bdd/BDD.php";
require_once "../src/modele/Utilisateur.php";

include "../src/repository/RepositoryPilote.php";
require_once "../src/bdd/BDD.php";
require_once "../src/modele/Pilote.php";

include "../src/repository/RepositoryAvion.php";
require_once "../src/bdd/BDD.php";
require_once "../src/modele/Avion.php";

include "../src/repository/RepositoryVol.php";
require_once "../src/bdd/BDD.php";
require_once "../src/modele/Vol.php";

include "../src/repository/RepositoryReservation.php";
require_once "../src/bdd/BDD.php";
require_once "../src/modele/Reservation.php";

session_start();

if ($_SESSION["userConnecte"]["role"] == "visiteur") {
    header('Location:../index.php');
    exit;
}
$repositoryUtilisateur = new repositoryUtilisateur();
$resultatUtilisateur = $repositoryUtilisateur->nombreUtilisateur();

$repositoryPilote = new repositoryPilote();
$resultatPilote = $repositoryPilote->nombrePilote();

$repositoryAvion = new repositoryAvion();
$resultatAvion = $repositoryAvion->nombreAvion();

$repositoryVol = new repositoryVol();
$resultatVol = $repositoryVol->nombreVol();

$repositoryReservation = new repositoryReservation();
$resultatReservation = $repositoryReservation->nombreReservation();

$userPrenom = isset($_SESSION["userConnecte"]["userPrenom"]) ? $_SESSION["userConnecte"]["userPrenom"] : "Invité";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AreoportX</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="asset/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" />

    <style>
        body {
            background-image: url('../asset/img/imageAvion.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }

        .content-box {
            max-width: 700px;
            margin: 60px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            text-align: justify;
        }

        .content-box h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .lead {
            text-align: center;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="accueilAdmin.php">
            <img height="50" src="../asset/img/areoportX.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="../src/traitement/utilisateur/traitementDeconnexionUtilisateur.php">
                        <img src="../asset/img/deconnexion.png" alt="Déconnexion" height="40">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="content-box">
        <h1>Session Admin</h1>
        <div class="row mb-4 text-center">
            <div class="col-md-3">
                <div class="card bg-primary text-white rounded-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Utilisateur</h5>
                        <p class="card-text fs-4"><?php echo $resultatUtilisateur ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary text-white rounded-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Pilote</h5>
                        <p class="card-text fs-4"><?php echo $resultatPilote ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary text-white rounded-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Avion</h5>
                        <p class="card-text fs-4"><?php echo $resultatAvion ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary text-white rounded-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Vol</h5>
                        <p class="card-text fs-4"><?php echo $resultatVol ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="dropdown mb-3">
            <div class="mb-3">
                <a href="listeUtilisateur.php" class="btn btn-info w-100 mb-2">UTILISATEUR</a>
            </div>
        </div>

        <div class="dropdown mb-3">
            <div class="mb-3">
                <a href="listePilote.php" class="btn btn-info w-100 mb-2">PILOTE</a>
            </div>
        </div>

        <div class="dropdown mb-3">
            <div class="mb-3">
                <a href="listeAvion.php" class="btn btn-info w-100 mb-2">AVION</a>
            </div>
        </div>

        <div class="dropdown mb-3">
            <div class="mb-3">
                <a href="listeVol.php" class="btn btn-info w-100 mb-2">VOL</a>
            </div>
        </div>

        <div class="dropdown mb-3">
            <div class="mb-3">
                <a href="listeReservation.php" class="btn btn-info w-100 mb-2">RESERVATION</a>
            </div>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="asset/js/scripts.js"></script>
</body>
</html>