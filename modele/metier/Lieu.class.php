<?php

namespace modele\metier;

/**
 * Description of Lieu
 * Lieu sur lequel ce produit un groupe.
 * @author Guyot Thomas
 */
class Lieu {
    /**
     * identifiant du Lieu ("gxxx")
     * @var integer
     */
    private $id;
    /**
     * nom du Lieu
     * @var string
     */
    private $nom;
    /**
     * adresse du Lieu
     * @var string 
     */
    private $adr;
    /**
     * Capacite du Lieu
     * @var integer
     */
    private $capacite;

    function __construct($id, $nom, $adr, $capacite) {
        $this->id = $id;
        $this->nom = $nom;
        $this->adr = $adr;
        $this->capacite = $capacite;
    }

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getAdresse() {
        return $this->adr;
    }

    function getCapacite() {
        return $this->capacite;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function setNom($nom){
        $this->nom = $nom;
    }
    
    function  setAdresse($adr){
        return $this->adr = $adr;
    }
    
    function  setCapacite($capacite){
        return $this->capacite = $capacite;
    }

}
