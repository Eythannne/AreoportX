<?php
include "../../repository/RepositoryUtilisateur.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Utilisateur.php";

    $utilisateurRepo = new RepositoryUtilisateur();
    $utilisateurRepo->deconnect();

