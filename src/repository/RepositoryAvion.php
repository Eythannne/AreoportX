<?php
class RepositoryAvion {
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function detailAvion($id)
    {
        if (empty($id)) {
            return null;
        }

        $sql = 'SELECT * FROM avion WHERE id_avion = :id';
        $req = $this->bdd->getBDD()->prepare($sql);
        $req->execute(['id' => $id]);
        $avion = $req->fetch(PDO::FETCH_ASSOC);

        if (!$avion) {
            return null;
        }

        return new Avion([
            "idAvion" => $avion['id_avion'],
            "nom" => $avion['nom'],
            "numeroSerie" => $avion['numero_serie'],
            "nombrePlace" => $avion['nombre_place'],
        ]);
    }

    public function ajout(Avion $user)
    {
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM avion WHERE numero_serie = :numero_serie');
        $req2->execute(array(
            'numero_serie' => $user->getNumeroSerie(),
        ));
        $donne = $req2->fetch();
        if ($donne == NULL){
            $sql = 'INSERT INTO avion(nom,numero_serie,nombre_place) 
                Values (:nom,:numero_serie,:nombre_place)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute(array(
                'nom' => $user->getNom(),
                'numero_serie' => $user->getNumeroSerie(),
                'nombre_place' => $user->getNombrePlace(),
            ));
            var_dump($res);

            if ($res) {
                return true;
                echo "L'avion a été crée ! ";
                header('Location:../../vue/listeAvion.php');
            } else {
                return false;
            }
            exit();
        } else {
            echo "Cet avion existe déjà ! ";
            header('Location: ../../vue/listeAvion.php');
            exit();
        }
    }

    public function listeAvion()
    {
        $sqlAvion = 'SELECT * FROM avion';
        $reqAvion = $this->bdd->getBDD()->prepare($sqlAvion);
        $reqAvion->execute();

        return $reqAvion->fetchAll();
    }

    public function nombreAvion()
    {
        $sqlnombreavion = 'SELECT COUNT(*) FROM avion';
        $reqnombreavion = $this->bdd->getBdd()->prepare($sqlnombreavion);
        $reqnombreavion->execute(array());

        return $reqnombreavion->fetchColumn();

    }

    public function suppression(Avion $avion)
    {
        $sqlsuppression = 'DELETE FROM avion WHERE id_avion = :id';
        $reqsuppression = $this->bdd->getBdd()->prepare($sqlsuppression);
        $ressuppression = $reqsuppression->execute(array(
            'id' => $avion->getIdAvion()
        ));
        header("Location: ../../vue/accueilAdmin.php");
        return $ressuppression ? "Suppression réussie" : "Échec de la suppression";
    }

    public function modification(Avion $avion)
    {
        $sqlmodification = "UPDATE avion SET nom = :nom, numero_serie = :numero_serie, nombre_place = :nombre_place WHERE id_avion = :id";
        $reqmodification = $this->bdd->getBdd()->prepare($sqlmodification);
        $resmodification = $reqmodification->execute(array(
            'nom' => $avion->getNom(),
            'numero_serie' => $avion->getNumeroSerie(),
            'nombre_place' => $avion->getNombrePlace(),
            'id' => $avion->getIdAvion()
        ));
        header("Location: ../../vue/ModificationAvion.php");
        return $resmodification ? "Modification réussie" : "Échec de la modification";
    }
}