<?php
namespace modele\metier;

/**
 * Description of Representation
 * un groupe musical se produisant au festival
 * @author prof
 */
class Representation {
   
    private $id;
   
    private $lieu;
   
    private $groupe;
   
    private $heureDebut;
   
    private $heureFin;
    
    private $date;
   

    function __construct($id, $lieu, $groupe, $heureDebut, $heureFin, $date) {
        $this->id = $id;
        $this->lieu = $lieu;
        $this->groupe = $groupe;
        $this->heureDebut = $heureDebut;
        $this->heureFin = $heureFin;
        $this->date = $date;

    }

    function getId() {
        return $this->id;
    }

    function getLieu() {
        return $this->lieu;
    }

    function getGroupe() {
        return $this->groupe;
    }

    function getHeureDebut() {
        return $this->heureDebut;
    }

    function getHeureFin() {
        return $this->heureFin;
    }

    function getDate() {
        return $this->date;
    }


    
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLieu($lieu) {
        $this->lieu = $lieu;
    }

    function setGroupe($groupe) {
        $this->groupe = $groupe;
    }

    function setHeureDebut($heureDebut) {
        $this->heureDebut = $heureDebut;
    }

    function setHeureFin($heureFin) {
        $this->heureFin = $heureFin;
    }

    function setDate($date) {
        $this->date = $date;
    }





