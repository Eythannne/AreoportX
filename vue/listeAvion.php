<?php
require_once "../src/modele/Avion.php";
require_once "../src/repository/RepositoryAvion.php";
require_once "../src/bdd/BDD.php";
session_start();
if (!isset($_SESSION["userConnecte"])) {
    $_SESSION["userConnecte"] = ["role" => "visiteur"];
}
$role = $_SESSION["userConnecte"]["role"];
$listeAvion = (new RepositoryAvion())->listeAvion();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AreoportX</title>

    <link href="asset/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

    <style>
        body {
            background-image: url('../asset/img/imageAvion.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }

        .container {
            max-width: 700px;
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            text-align: justify;
        }

        .search-bar {
            width: 100%;
            margin: 15px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        thead {
            background-color: #f8f9fa;
        }

        a {
            color: #0d6efd;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<script>
    function filterAvion() {
        let input = document.getElementById("search").value.toLowerCase();
        let rows = document.querySelectorAll("tbody tr");

        rows.forEach(row => {
            let title = row.cells[1].innerText.toLowerCase();
            row.style.display = title.includes(input) ? "" : "none";
        });
    }
</script>

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
    <h2 class="mb-3">Liste des Avions</h2>
    <input type="text" id="search" class="search-bar" onkeyup="filterAvion()" placeholder="numéro de serie de l'avion...">

    <div class="mb-3">
        <a href="ajoutAvion.php" class="btn btn-primary w-100">Ajouter un avion</a>
    </div>
    <table>
        <thead>
        <tr>
            <th>Numéro série</th>
            <th>Nom</th>
            <th>Nombre place</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($listeAvion as $avion): ?>
            <tr>
                <td><?= htmlspecialchars($avion['numero_serie']) ?></td>
                <td><?= htmlspecialchars($avion['nom']) ?></td>
                <td><?= htmlspecialchars($avion['nombre_place']) ?></td>
                <td>
                    <div class="d-grid gap-2">
                        <a href="modificationAvion.php?id=<?= $avion['id_avion'] ?>" class="btn btn-warning btn-sm w-100">Modifier</a>
                        <a href="../src/traitement/avion/traitementSuppressionAvion.php?id=<?= $avion['id_avion'] ?>" class="btn btn-danger btn-sm w-100" onclick="return confirm('Es-tu sûr de vouloir supprimer cet avion ?')">Supprimer</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>