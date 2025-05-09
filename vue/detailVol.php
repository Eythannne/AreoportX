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

$userPrenom = isset($_SESSION["userConnecte"]["userPrenom"]) ? $_SESSION["userConnecte"]["userPrenom"] : "Invité";
$listeVol = new repositoryVol();
$vol = $listeVol->detailVol($_GET["id"]);
$repoPilote = new RepositoryPilote();
$repoAvion = new RepositoryAvion();

$pilote = $repoPilote->detailPilote($vol->getRefPilote());
$avion = $repoAvion->detailAvion($vol->getRefAvion());

//var_dump($vol);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AreoportX - Réservation Vol</title>
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
        }

        .content-box h1 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="accueilUser.php">
            <img height="50" src="../asset/img/areoportX.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img height="40" src="../asset/img/compte.png" alt="Compte">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><a class="dropdown-item" href="../src/traitement/utilisateur/traitementDeconnexionUtilisateur.php">Deconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="content-box">
        <h1>Réserver ce vol</h1>
        <p class="text-center mb-4">Bonjour <strong><?= htmlspecialchars($userPrenom) ?></strong>, voici les détails du vol :</p>

        <form method="POST" action="../src/traitement/reservation/traitementReservation.php">
            <input type="hidden" name="id_vol" value="<?= htmlspecialchars($vol->getIdVol()) ?>">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Destination</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($vol->getDestination()) ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($vol->getDate()) ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Heure de départ</label>
                    <input type="text" class="form-control" value="<?= date('H:i', strtotime($vol->getHeureDepart())) ?>" readonly>                </div>
                <div class="col-md-6">
                    <label class="form-label">Heure d’arrivée</label>
                    <input type="text" class="form-control" value="<?= date('H:i', strtotime($vol->getHeureArrivee())) ?>" readonly>                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nom de l’avion</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($avion->getNom()) ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nom du pilote</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($pilote->getNom() . ' ' . $pilote->getPrenom()) ?>" readonly>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col text-center">
                    <button type="submit" class="btn btn-dark px-4">Réserver le vol</button>
                </div>
            </div>
        </form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="asset/js/scripts.js"></script>
</body>
</html>