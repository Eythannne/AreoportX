<?php
class RepositoryVol
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function detailVol($id)
    {
        if (empty($id)) {
            return null;
        }

        $sql = 'SELECT * FROM vol WHERE id_vol = :id';
        $req = $this->bdd->getBDD()->prepare($sql);
        $req->execute(['id' => $id]);
        $vol = $req->fetch(PDO::FETCH_ASSOC);

        if (!$vol) {
            return null;
        }

        return new Vol([
            'idVol' => $vol['id_vol'],
            'destination' => $vol['destination'],
            'date' => $vol['date'],
            'heureDepart' => $vol['heure_depart'],
            'heureArrivee' => $vol['heure_arrivee'],
            'refAvion' => $vol['ref_avion'],
            'refPilote' => $vol['ref_pilote']
        ]);
    }

    public function ajout(Vol $vol)
    {
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM vol WHERE destination = :destination');
        $req2->execute(array(
            'destination' => $vol->getDestination(),
        ));
        $donne = $req2->fetch();
        if ($donne == NULL) {
            $sql = 'INSERT INTO vol(destination,date,heure_depart,heure_arrivee,ref_avion,ref_pilote) 
                Values (:destination,:date,:heure_depart,:heure_arrivee,:ref_avion,:ref_pilote)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute(array(
                'destination' => $vol->getDestination(),
                'date' => $vol->getDate(),
                'heure_depart' => $vol->getHeureDepart(),
                'heure_arrivee' => $vol->getHeureArrivee(),
                'ref_avion' => $vol->getRefAvion(),
                'ref_pilote' => $vol->getRefPilote(),
            ));
            var_dump($res);

            if ($res) {
                return true;
                echo "Le vol a été crée ! ";
                header('Location:../../vue/listeVol.php');
            } else {
                return false;
            }
            exit();
        } else {
            echo "Cet vol existe déjà ! ";
            header('Location: ../../vue/listeVol.php');
            exit();
        }
    }

    public function listeVol()
    {
        $sqlvol = 'SELECT v.id_vol, v.destination, v.date, v.heure_depart, v.heure_arrivee, a.nom AS nom_avion, p.nom AS nom_pilote FROM vol v JOIN avion a ON v.ref_avion = a.id_avion JOIN pilote p ON v.ref_pilote = p.id_pilote';
        $reqvol = $this->bdd->getBDD()->prepare($sqlvol);
        $reqvol->execute();

        return $reqvol->fetchAll();
    }

    public function nombreVol()
    {
        $sqlnombrevol = 'SELECT COUNT(*) FROM vol';
        $reqnombrevol = $this->bdd->getBdd()->prepare($sqlnombrevol);
        $reqnombrevol->execute(array());

        return $reqnombrevol->fetchColumn();

    }

    public function suppression(Vol $vol)
    {
        $sqlsuppression = 'DELETE FROM vol WHERE id_vol = :id';
        $reqsuppression = $this->bdd->getBdd()->prepare($sqlsuppression);
        $ressuppression = $reqsuppression->execute(array(
            'id' => $vol->getIdVol()
        ));
        header("Location: ../../vue/accueilAdmin.php");
        return $ressuppression ? "Suppression réussie" : "Échec de la suppression";
    }

    public function modification(Vol $vol)
    {
        $sqlmodification = "UPDATE vol SET destination = :destination, date = :date, heure_depart = :heure_depart, heure_arrivee = :heure_arrivee, ref_avion = :ref_avion, ref_pilote = :ref_pilote WHERE id_vol = :id_vol";
        $reqmodification = $this->bdd->getBdd()->prepare($sqlmodification);
        $resmodification = $reqmodification->execute(array(
            'destination' => $vol->getDestination(),
            'date' => $vol->getDate(),
            'heure_depart' => $vol->getHeureDepart(),
            'heure_arrivee' => $vol->getHeureArrivee(),
            'ref_avion' => $vol->getRefAvion(),
            'ref_pilote' => $vol->getRefPilote(),
            'id_vol' => $vol->getIdVol()
        ));
        header("Location: ../../vue/ModificationVol.php");
        return $resmodification ? "Modification réussie" : "Échec de la modification";
    }

    public function getAvion()
    {
        $get="SELECT id_avion,nom,nombre_place FROM avion";
        $res =  $this->bdd->getBdd()->prepare($get);
        $res->execute();
        return $res->fetchAll();
    }

    public function getPilote()
    {
        $get="SELECT id_pilote,nom,prenom FROM pilote";
        $res =  $this->bdd->getBdd()->prepare($get);
        $res->execute();
        return $res->fetchAll();
    }
    public function rechercherDestination(string $destination)
    {
        $sql = "SELECT * FROM vol WHERE destination LIKE :destination";
        $stmt = $this->bdd->getBdd()->prepare($sql);
        $stmt->execute(['destination' => "%$destination%"]);
        return $stmt->fetchAll();

    }

    public function getDestinations()
    {
        $sql = "SELECT DISTINCT destination FROM vol ORDER BY destination ASC";
        $stmt = $this->bdd->getBdd()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}