<?php

use modele\dao\RepresentationDAO;
use modele\metier\Representation;
use modele\dao\Bdd;

require_once __DIR__ . '/../../includes/autoload.php';
Bdd::connecter();

$idGroupe = $_GET["nomGroupe"];
$idLieu = $_GET["nomLieu"];


$uneRepre = RepresentationDAO::getOneById($idGroupe, $idLieu);

if ($uneRepre == null){
    echo '1';
}else{
    echo '2';
}

$val = $uneRepre->getHeureDebut();

echo "$val";

Bdd::deconnecter();