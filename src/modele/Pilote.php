<?php
class Pilote {
    private $idPilote;
    private $nom;
    private $prenom;
    private $email;

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
    public function getIdPilote()
    {
        return $this->idPilote;
    }

    /**
     * @param mixed $idPilote
     */
    public function setIdPilote($idPilote)
    {
        $this->idPilote = $idPilote;
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
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $prenom
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}