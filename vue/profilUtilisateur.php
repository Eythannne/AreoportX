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
$RepositoryUtilisateur = new RepositoryUtilisateur();
$utilisateur = $RepositoryUtilisateur->detailUtilisateur($_SESSION["userConnecte"]["idUtilisateur"]);
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

        .carousel-wrapper {
            overflow: hidden;
            width: 100%;
            margin-top: 30px;
        }

        .carousel-track {
            width: 100%;
            display: flex;
        }

        .carousel-slide {
            display: flex;
            animation: scroll 30s linear infinite;
            gap: 20px;
            min-width: 200%; /* Clé pour que ça boucle sans couper */
        }

        .carousel-slide img {
            width: 350px;
            height: 220px;
            object-fit: cover;
            border-radius: 12px;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0%);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        .button-above-search {
            margin-top: -40px;
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
                        <li><a class="dropdown-item" href="profilUtilisateur.php">Profil</a></li>
                        <li><a class="dropdown-item" href="../src/traitement/utilisateur/traitementDeconnexionUtilisateur.php">Deconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="content-box">
        <h1>Page profil <strong><?= htmlspecialchars($userPrenom) ?></strong></h1>
        <form action="../src/traitement/utilisateur/traitementModifUtilisateur.php" method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?=$utilisateur->getNom()?>">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom </label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?=$utilisateur->getPrenom()?>">
            </div>
            <div class="mb-3">
                <label for="dateNaissance" class="form-label">Date de naissance</label>
                <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="<?=$utilisateur->getDateNaissance()?>">

            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?=$utilisateur->getEmail()?>">
            </div>
            <input type="hidden" name="id_utilisateur" value="<?=$utilisateur->getIdUtilisateur()?>">
            <input type="submit" value="Modifier" class="btn btn-primary" >
        </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="asset/js/scripts.js"></script>
</body>
</html>