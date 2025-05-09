<?php
require_once "../src/bdd/BDD.php";
require_once "../src/modele/Reservation.php";
require_once "../src/repository/RepositoryReservation.php";
require_once "../src/repository/RepositoryUtilisateur.php";
require_once "../src/repository/RepositoryVol.php";
session_start();

if($_SESSION["userConnecte"]["role"]=="user"){
    header('Location:../vue/accueil.php');
}

$vol = (new RepositoryVol())->listeVol();
$utilisateur = (new RepositoryUtilisateur())->listeUtilisateur();

$RepositoryReservation = new RepositoryReservation();
$reservation = $RepositoryReservation->detailReservation($_GET["id"]);
$idReservation = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Plus 2</title>
    <style>
        body {
            background-image: url('../asset/img/imageAvion.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .film {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .film:last-child {
            border-bottom: none;
        }
        img {
            max-width: 100px;
            display: block;
            margin-bottom: 10px;
        }
        .buttons {
            display: flex;
            gap: 10px;
        }
        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        button {
            padding: 5px 10px;
            cursor: pointer;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
<div class="container mt-4">
    <h1>Modification reservation</h1>
    <?= var_dump($reservation)?>
    <form action="../src/traitement/reservation/traitementModificationReservation.php" method="post">
        <div class="mb-3">
            <label for="nb_place_reserver" class="form-label">Nombre de place reserver</label>
            <input type="text" class="form-control" id="nb_place_reserver" name="nb_place_reserver" value="<?=$reservation->getNbPlaceReserver()?>">
        </div>
        <div class="mb-3">
            <label for="ref_vol" class="form-label">Destination</label>
            <select class="form-control" id="ref_vol" name="ref_vol">
                <?php foreach ($vol as $vol): ?>
                    <option value="<?= $vol['id_vol'] ?>" <?= $reservation->getRefVol() == $vol['id_vol'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($vol['destination']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="ref_utilisateur" class="form-label">Utilisateur</label>
            <select class="form-control" id="ref_utilisateur" name="ref_utilisateur">
                <?php foreach ($utilisateur as $utilisateur): ?>
                    <option value="<?= $utilisateur['id_utilisateur'] ?>" <?= $reservation->getRefUtilisateur() == $utilisateur['id_utilisateur'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($utilisateur['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="hidden" name="idReservation" value="<?=$reservation->getIdReservation()?>">
        <input type="submit" value="Modifier" class="btn btn-primary" >
    </form>



</div>
</body>
</body>
</html>

