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
            max-width: 400px;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Inscription</h2>
    <form method="POST" action="../src/traitement/utilisateur/traitementInscriptionUtilisateur.php">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="...@..." required>
        </div>
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">S'inscrire</button><br><br>
    </form>
        <a href="connexionUtilisateur.php"><button type="submit" class="btn btn-primary w-100">Connexion</button></a><br><br>
        <a href="../index.php"><button type="submit" class="btn btn-primary w-100">Accueil</button></a><br><br>
    </div>
</body>
</html>