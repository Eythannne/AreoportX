<?php
class Vol {
    private $idVol;
    private $destination;
    private $date;
    private $heure_depart;
    private $heure_arrivee;
    private $ref_avion;
    private $ref_pilote;

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
    public function getIdVol()
    {
        return $this->idVol;
    }

    /**
     * @param mixed $idVol
     */
    public function setIdVol($idVol)
    {
        $this->idVol = $idVol;
    }

    /**
     * @return mixed
     */
    public function getRefPilote()
    {
        return $this->ref_pilote;
    }

    /**
     * @param mixed $ref_pilote
     */
    public function setRefPilote($ref_pilote)
    {
        $this->ref_pilote = $ref_pilote;
    }

    /**
     * @return mixed
     */
    public function getRefAvion()
    {
        return $this->ref_avion;
    }

    /**
     * @param mixed $ref_avion
     */
    public function setRefAvion($ref_avion)
    {
        $this->ref_avion = $ref_avion;
    }

    /**
     * @return mixed
     */
    public function getHeureArrivee()
    {
        return $this->heure_arrivee;
    }

    /**
     * @param mixed $heure_arrivee
     */
    public function setHeureArrivee($heure_arrivee)
    {
        $this->heure_arrivee = $heure_arrivee;
    }

    /**
     * @return mixed
     */
    public function getHeureDepart()
    {
        return $this->heure_depart;
    }

    /**
     * @param mixed $heure_depart
     */
    public function setHeureDepart($heure_depart)
    {
        $this->heure_depart = $heure_depart;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }
}