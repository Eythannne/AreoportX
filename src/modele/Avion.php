<?php
class Avion {

    private $idAvion;
    private $nom;
    private $numero_serie;
    private $nombre_place;

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
    public function getIdAvion()
    {
        return $this->idAvion;
    }

    /**
     * @param mixed $idAvion
     */
    public function setIdAvion($idAvion)
    {
        $this->idAvion = $idAvion;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getNumeroSerie()
    {
        return $this->numero_serie;
    }

    /**
     * @param mixed $numero_serie
     */
    public function setNumeroSerie($numero_serie)
    {
        $this->numero_serie = $numero_serie;
    }

    /**
     * @return mixed
     */
    public function getNombrePlace()
    {
        return $this->nombre_place;
    }

    /**
     * @param mixed $nombre_place
     */
    public function setNombrePlace($nombre_place)
    {
        $this->nombre_place = $nombre_place;
    }
}