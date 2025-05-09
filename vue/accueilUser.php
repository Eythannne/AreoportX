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
$repositoryVol = new RepositoryVol();
$destinations = $repositoryVol->getDestinations();
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
        <h1>Bienvenue à AreoportX</h1>
        <p class="lead">L'aéroport le plus fiable du mondeX</p>
        <p class="text-center">Bonjour <strong><?= htmlspecialchars($userPrenom) ?></strong>, ravi de vous revoir !</p>
    </div>
</div>
<!-- Barre de recherche -->
<div class="container mt-0">
    <form method="GET" action="../src/traitement/vol/traitementRechercheDestinationVol.php" class="d-flex justify-content-center mb-3">
        <input type="text" name="destination" class="form-control w-50 me-2" placeholder="Rechercher une destination..." required>
        <button type="submit" class="btn btn-light">
            🔍
        </button>
    </form>
</div>

<!-- Liste déroulante -->
<div class="container d-flex justify-content-center">
    <div class="dropdown" style="max-width: 700px; width: 100%;">
        <button class="btn btn-light dropdown-toggle w-100" type="button" id="dropdownDestinations" data-bs-toggle="dropdown" aria-expanded="false">
            Voir les différentes destinations
        </button>
        <ul class="dropdown-menu w-100" aria-labelledby="dropdownDestinations">
            <?php foreach ($destinations as $destination): ?>
                <li><span class="dropdown-item disabled"><?= htmlspecialchars($destination) ?></span></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<div class="carousel-wrapper">
    <div class="carousel-track">
        <div class="carousel-slide">
            <!-- Place tes images ici -->
            <img src="../asset/img/photo%201.jpg" alt="1">
            <img src="../asset/img/photo%202.jpg" alt="2">
            <img src="../asset/img/photo%203.jpg" alt="3">
            <img src="../asset/img/photo%204.jpg" alt="4">
            <img src="../asset/img/photo%205.jpeg" alt="5">

            <!-- Duplication pour effet infini -->
            <img src="../asset/img/photo%201.jpg" alt="1">
            <img src="../asset/img/photo%202.jpg" alt="2">
            <img src="../asset/img/photo%203.jpg" alt="3">
            <img src="../asset/img/photo%204.jpg" alt="4">
            <img src="../asset/img/photo%205.jpeg" alt="5">
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="asset/js/scripts.js"></script>
<script>
    const destinations = ["Paris", "New York", "Tokyo", "Londres", "Sydney", "Barcelone", "Rome"];

    function filtrerDestinations() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const liste = document.getElementById("listeDestinations");
        liste.innerHTML = "";

        const resultats = destinations.filter(dest => dest.toLowerCase().includes(input));

        if (input && resultats.length > 0) {
            resultats.forEach(dest => {
                const li = document.createElement("li");
                li.className = "list-group-item";
                li.textContent = "✈️ " + dest;
                liste.appendChild(li);
            });
        } else if (input) {
            const li = document.createElement("li");
            li.className = "list-group-item text-danger";
            li.textContent = "Aucune destination trouvée.";
            liste.appendChild(li);
        }
    }
</script>
</body>
</html>