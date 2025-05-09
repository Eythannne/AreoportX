<?php
class RepositoryReservation {
    private $bdd;

    public function __construct()
    {
        $this->bdd = new BDD();
    }

    public function detailReservation($id)
    {
        if (empty($id)) {
            return null;
        }

        $sql = 'SELECT * FROM reservation WHERE id_reservation = :id';
        $req = $this->bdd->getBDD()->prepare($sql);
        $req->execute(['id' => $id]);
        $reservation = $req->fetch(PDO::FETCH_ASSOC);

        if (!$reservation) {
            return null;
        }

        return new Reservation([
            "idReservation" => $reservation['id_reservation'],
            "nbPlaceReserver" => $reservation['nb_place_reserver'],
            "refVol" => $reservation['ref_vol'],
            "refUtilisateur" => $reservation['ref_utilisateur'],
        ]);
    }

    public function ajout(Reservation $reservation)
    {
        $req2 = $this->bdd->getBdd()->prepare('SELECT * FROM reservation WHERE ref_vol = :ref_vol and ref_utilisateur = :ref_user');
        $req2->execute(array(
            'ref_vol' => $reservation->getRefVol(),
            'ref_user' => $reservation->getRefUtilisateur(),
        ));
        $donne = $req2->fetch();
        if ($donne == NULL){
            $sql = 'INSERT INTO reservation(nb_place_reserver,ref_vol,ref_utilisateur) 
                Values (:nb_place_reserver,:ref_vol,:ref_utilisateur)';
            $req = $this->bdd->getBdd()->prepare($sql);
            $res = $req->execute(array(
                'nb_place_reserver' => $reservation->getNbPlaceReserver(),
                'ref_vol' => $reservation->getRefVol(),
                'ref_utilisateur' => $reservation->getrefUtilisateur(),
            ));
            var_dump($res);

            if ($res) {
                return true;
            } else {
                return false;
            }
        } else {
            echo "test sur vol deja reservé";
            return false;
        }
    }

    public function listeReservation()
    {
        $sqlReservation = 'SELECT r.id_reservation, r.nb_place_reserver, u.nom AS nom_utilisateur, v.destination AS destination_vol FROM reservation r JOIN utilisateur u ON r.ref_utilisateur = u.id_utilisateur JOIN vol v ON r.ref_vol = v.id_vol ORDER BY u.nom ASC';
        $reqReservation = $this->bdd->getBDD()->prepare($sqlReservation);
        $reqReservation->execute();

        return $reqReservation->fetchAll();
    }

    public function listeVol()
    {
        $sqlvol = 'SELECT v.id_vol, v.destination, v.date, v.heure_depart, v.heure_arrivee, a.nom AS nom_avion, p.nom AS nom_pilote FROM vol v JOIN avion a ON v.ref_avion = a.id_avion JOIN pilote p ON v.ref_pilote = p.id_pilote';
        $reqvol = $this->bdd->getBDD()->prepare($sqlvol);
        $reqvol->execute();

        return $reqvol->fetchAll();
    }



    public function nombreReservation()
    {
        $sqlnombreReservation = 'SELECT COUNT(*) FROM reservation';
        $reqnombreReservation = $this->bdd->getBdd()->prepare($sqlnombreReservation);
        $reqnombreReservation->execute(array());

        return $reqnombreReservation->fetchColumn();

    }

    public function suppression(Reservation $reservation)
    {
        $sqlsuppression = 'DELETE FROM reservation WHERE id_reservation = :id';
        $reqsuppression = $this->bdd->getBdd()->prepare($sqlsuppression);
        $ressuppression = $reqsuppression->execute(array(
            'id' => $reservation->getIdReservation()
        ));
        header("Location: ../../vue/accueilAdmin.php");
        return $ressuppression ? "Suppression réussie" : "Échec de la suppression";
    }

    public function modification(Reservation $reservation)
    {
        $sqlmodification = "UPDATE reservation SET nb_place_reserver = :nb_place_reserver, ref_vol = :ref_vol, ref_utilisateur = :ref_utilisateur WHERE id_reservation = :id";
        $reqmodification = $this->bdd->getBdd()->prepare($sqlmodification);
        $resmodification = $reqmodification->execute(array(
            'nb_place_reserver' => $reservation->getNbPlaceReserver(),
            'ref_vol' => $reservation->getRefVol(),
            'ref_utilisateur' => $reservation->getRefUtilisateur(),
            'id' => $reservation->getIdReservation()
        ));
        header("Location: ../../vue/ModificationReservation.php");
        return $resmodification ? "Modification réussie" : "Échec de la modification";
    }

    public function getVol()
    {
        $get="SELECT id_vol,destination FROM vol";
        $res =  $this->bdd->getBdd()->prepare($get);
        $res->execute();
        return $res->fetchAll();
    }

    public function getUtilisateur()
    {
        $get="SELECT id_utilisateur,nom,prenom FROM utilisateur";
        $res =  $this->bdd->getBdd()->prepare($get);
        $res->execute();
        return $res->fetchAll();
    }

}