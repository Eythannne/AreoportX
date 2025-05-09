<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>AreoportX</title>
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
    <h2 class="mb-3">Ajout Pilote</h2>
    <form method="POST" action="../src/traitement/pilote/traitementAjoutPilote.php">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="...@..." required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Ajouter</button><br><br>
    </form>
</div>
</body>
</html>
