<?php
class RepositoryPilote {
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function detailPilote($id)
    {
        if (empty($id)) {
            return null;
        }

        $sql = 'SELECT * FROM pilote WHERE id_pilote = :id';
        $req = $this->bdd->getBDD()->prepare($sql);
        $req->execute(['id' => $id]);
        $pilote = $req->fetch(PDO::FETCH_ASSOC);

        if (!$pilote) {
            return null;
        }

        return new Pilote([
            "idPilote" => $pilote['id_pilote'],
            "nom" => $pilote['nom'],
            "prenom" => $pilote['prenom'],
            "email" => $pilote['email'],
        ]);
    }

    public function ajout(Pilote $user)
    {
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM pilote WHERE email = :email');
        $req2->execute(array(
            'email' => $user->getEmail(),
        ));
        $donne = $req2->fetch();
        if ($donne == NULL){
            $sql = 'INSERT INTO pilote(nom,prenom,email) 
                Values (:nom,:prenom,:email)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute(array(
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
            ));
            var_dump($res);

            if ($res) {
                return true;
                echo "Le compte a été crée ! ";
                header('Location:../../vue/listePilote.php');
            } else {
                return false;
            }
            exit();
        } else {
            echo "Ce compte existe déjà ! ";
            header('Location: ../../vue/listePilote.php');
            exit();
        }
    }

    public function listePilote()
    {
        $sqlPilote = 'SELECT * FROM pilote';
        $reqPilote = $this->bdd->getBDD()->prepare($sqlPilote);
        $reqPilote->execute();

        return $reqPilote->fetchAll();
    }

    public function nombrePilote()
    {
        $sqlnombrepilote = 'SELECT COUNT(*) FROM pilote';
        $reqnombrepilote = $this->bdd->getBdd()->prepare($sqlnombrepilote);
        $reqnombrepilote->execute(array());

        return $reqnombrepilote->fetchColumn();

    }

    public function suppression(Pilote $pilote)
    {
        $sqlsuppression = 'DELETE FROM pilote WHERE id_pilote = :id';
        $reqsuppression = $this->bdd->getBdd()->prepare($sqlsuppression);
        $ressuppression = $reqsuppression->execute(array(
            'id' => $pilote->getIdPilote()
        ));
        header("Location: ../../vue/accueilAdmin.php");
        return $ressuppression ? "Suppression réussie" : "Échec de la suppression";
    }

    public function modification(Pilote $pilote)
    {
        $sqlmodification = "UPDATE pilote SET nom = :nom, prenom = :prenom, email = :email WHERE id_pilote = :id";
        $reqmodification = $this->bdd->getBdd()->prepare($sqlmodification);
        $resmodification = $reqmodification->execute(array(
            'nom' => $pilote->getNom(),
            'prenom' => $pilote->getPrenom(),
            'email' => $pilote->getEmail(),
            'id' => $pilote->getIdPilote()
        ));
        header("Location: ../../vue/ModificationPilote.php");
        return $resmodification ? "Modification réussie" : "Échec de la modification";
    }
}