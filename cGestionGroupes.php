<?php

/**
 * Contrôleur : gestion des types de chambres
 */
use modele\metier\Groupe;
use modele\dao\GroupeDAO;
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
    case 'detailGroupe':
        $id = $_REQUEST['id'];
        include("vues/GestionGroupes/vDetailGroupe.php");
        break;
    /*
    case 'demanderSupprGroupe':
        $id = $_REQUEST['id'];
        include("vues/GestionGroupes/vSupprGroupe.php");
        break;
    case 'demanderModifGroupe':
        $id = $_REQUEST['id'];
        include("vues/GestionGroupes/vCreerModifGroupe.php");
        break;
    case 'demanderCreerGroupe':
        $id = $_REQUEST['id'];
        include("vues/GestionGroupes/vCreerGroupe.php");
        break;
     */
}

// Fermeture de la connexion au serveur MySql
Bdd::deconnecter();

