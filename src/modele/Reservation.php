<?php
class Reservation {
    private $idReservation;
    private $nb_place_reserver;
    private $ref_vol;
    private $ref_utilisateur;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {

            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {

                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * @param mixed $idReservation
     */
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
    }

    /**
     * @return mixed
     */
    public function getRefUtilisateur()
    {
        return $this->ref_utilisateur;
    }

    /**
     * @param mixed $ref_utilisateur
     */
    public function setRefUtilisateur($ref_utilisateur)
    {
        $this->ref_utilisateur = $ref_utilisateur;
    }

    /**
     * @return mixed
     */
    public function getRefVol()
    {
        return $this->ref_vol;
    }

    /**
     * @param mixed $ref_vol
     */
    public function setRefVol($ref_vol)
    {
        $this->ref_vol = $ref_vol;
    }

    /**
     * @return mixed
     */
    public function getNbPlaceReserver()
    {
        return $this->nb_place_reserver;
    }

    /**
     * @param mixed $nb_place_reserver
     */
    public function setNbPlaceReserver($nb_place_reserver)
    {
        $this->nb_place_reserver = $nb_place_reserver;
    }

}