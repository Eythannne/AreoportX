<?php

include "../../repository/RepositoryUtilisateur.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Utilisateur.php";
require_once "../../repository/RepositoryUtilisateur.php";
var_dump($_POST);

if(empty($_POST["nom"]) ||
    empty($_POST["prenom"]) ||
    empty($_POST["date_naissance"]) ||
    empty($_POST["email"]) ||
    empty($_POST["mdp"])
){
    echo "Toutes les cases doivent être remplis !";
    header("Location: ../../connexionUtilisateur.php");
}else{

    $user = new Utilisateur(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'dateNaissance' => $_POST['date_naissance'],
        'email' => $_POST['email'],
        'mdp' => password_hash($_POST['mdp'], PASSWORD_DEFAULT),

    ));
    var_dump($user);
    $repository = new RepositoryUtilisateur();
    $resultat = $repository->ajout($user);
    var_dump($resultat);
    if($resultat == true){
        header("Location: ../../../vue/accueilAdmin.php");
    }else{
        header("Location: ../../../vue/listerUtilisateur.php");
    }

}