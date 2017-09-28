<?php

/**
 * Contrôleur : gestion des types de chambres
 */
use modele\metier\TypeChambre;
use modele\dao\TypeChambreDAO;
use modele\dao\Bdd;
require_once __DIR__ . '/includes/autoload.php';
Bdd::connecter();

include("includes/_gestionErreurs.inc.php");
//include("includes/gestionDonnees/_connexion.inc.php");
//include("includes/gestionDonnees/_gestionBaseFonctionsCommunes.inc.php");
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'initial';
}

$action = $_REQUEST['action'];

// Aiguillage selon l'étape   
switch ($action) {
    case 'initial' :
        include("vues/GestionGroupes/vObtenirGroupes.php");
        break;
}