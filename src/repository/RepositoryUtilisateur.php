<?php
class RepositoryUtilisateur {
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function detailUtilisateur($id)
    {
        if (empty($id)) {
            return null;
        }

        $sql = 'SELECT * FROM utilisateur WHERE id_utilisateur = :id';
        $req = $this->bdd->getBDD()->prepare($sql);
        $req->execute(['id' => $id]);
        $utilisateur = $req->fetch(PDO::FETCH_ASSOC);

        if (!$utilisateur) {
            return null;
        }

        return new Utilisateur([
            "idUtilisateur" => $utilisateur['id_utilisateur'],
            "nom" => $utilisateur['nom'],
            "prenom" => $utilisateur['prenom'],
            "mdp" => $utilisateur['mdp'],
            "email" => $utilisateur['email'],
            "dateNaissance" => $utilisateur['date_naissance'],
        ]);
    }

    public function inscription(Utilisateur $user)
    {
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $req2->execute(array(
            'email' => $user->getEmail(),
        ));
        $donne = $req2->fetch();
        if ($donne == NULL){
            $sql = 'INSERT INTO utilisateur(nom,prenom,date_naissance,email,mdp) 
                Values (:nom,:prenom,:date_naissance,:email,:mdp)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute(array(
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'date_naissance' => $user->getDateNaissance(),
                'email' => $user->getEmail(),
                'mdp' => $user->getMdp(),
            ));
            var_dump($res);

            if ($res) {
                return true;
                echo "Votre profil a été créé ! ";
                header('Location:../../vue/connexionUtilisateur.php');
            } else {
                return false;
            }
            exit();
        } else {
            echo "Vous avez déjà un compte, veuillez vous connecter ! ";
            header('Location: ../../index.php');
            exit();
        }
    }

    public function connexion(Utilisateur $user)
    {
        $sqlconnexion = 'SELECT * FROM utilisateur WHERE email = :email';
        $reqconnexion = $this->bdd->getBdd()->prepare($sqlconnexion);
        $reqconnexion->execute(array(
            'email' => $user->getEmail(),
        ));
        $donne = $reqconnexion->fetch();
        if($donne && password_verify($user->getMdp(), $donne['mdp'])) {
            $user->setNom($donne['nom']);
            $user->setPrenom($donne['prenom']);
            $user->setEmail($donne['email']);
            $user->setMdp($donne['mdp']);
            $user->setIdUtilisateur($donne['id_utilisateur']);

            return $user;
        }
        else {
            return null;
        }

    }

    public function listeUtilisateur()
    {
        $sqlUtilisateur = 'SELECT * FROM utilisateur';
        $reqUtilisateur = $this->bdd->getBDD()->prepare($sqlUtilisateur);
        $reqUtilisateur->execute();

        return $reqUtilisateur->fetchAll();
    }
    public function deconnect()
    {
        session_start();
        session_destroy();
        header("Location: ../../../index.php");
    }

    public function ajout(Utilisateur $user)
    {
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $req2->execute(array(
            'email' => $user->getEmail(),
        ));
        $donne = $req2->fetch();
        if ($donne == NULL){
            $sql = 'INSERT INTO utilisateur(nom,prenom,date_naissance,email,mdp) 
                Values (:nom,:prenom,:date_naissance,:email,:mdp)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute(array(
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'date_naissance' => $user->getDateNaissance(),
                'email' => $user->getEmail(),
                'mdp' => $user->getMdp(),
            ));
            var_dump($res);

            if ($res) {
                return true;
                echo "Le compte a été crée ! ";
                header('Location:../../vue/listeUtilisateur.php');
            } else {
                return false;
            }
            exit();
        } else {
            echo "Ce compte existe déjà ! ";
            header('Location: ../../vue/listeUtilisateur.php');
            exit();
        }
    }

    public function modification(Utilisateur $user)
    {
        $sqlmodification = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance, email = :email WHERE id_utilisateur = :id";
        $reqmodification = $this->bdd->getBdd()->prepare($sqlmodification);
        $resmodification = $reqmodification->execute(array(
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'date_naissance' => $user->getDateNaissance(),
            'email' => $user->getEmail(),
            'id' => $user->getIdUtilisateur()
        ));
        header("Location: ../../vue/ModificationUtilisateur.php");
        return $resmodification ? "Modification réussie" : "Échec de la modification";
    }

    public function modif(Utilisateur $user)
    {
        $sqlmodification = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance, email = :email WHERE id_utilisateur = :id";
        $reqmodification = $this->bdd->getBdd()->prepare($sqlmodification);
        $resmodification = $reqmodification->execute(array(
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'date_naissance' => $user->getDateNaissance(),
            'email' => $user->getEmail(),
            'id' => $user->getIdUtilisateur()
        ));
        header("Location: ../../vue/ModificationUtilisateur.php");
        return $resmodification ? "Modification réussie" : "Échec de la modification";
    }
    public function suppression(Utilisateur $user)
    {
        $sqlsuppression = 'DELETE FROM utilisateur WHERE id_utilisateur = :id';
        $reqsuppression = $this->bdd->getBdd()->prepare($sqlsuppression);
        $ressuppression = $reqsuppression->execute(array(
            'id' => $user->getIdUtilisateur()
        ));
        header("Location: ../../vue/accueilAdmin.php");
        return $ressuppression ? "Suppression réussie" : "Échec de la suppression";
    }

    public function nombreUtilisateur()
    {
        $sqlnombreutilisateur = 'SELECT COUNT(*) FROM utilisateur';
        $reqnombreutilisateur = $this->bdd->getBdd()->prepare($sqlnombreutilisateur);
        $reqnombreutilisateur->execute(array());

        return $reqnombreutilisateur->fetchColumn();

    }
}