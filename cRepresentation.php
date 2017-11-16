<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use modele\dao\RepresentationDAO;
use modele\metier\Representation;
use modele\dao\Bdd;

require_once __DIR__ . '/includes/autoload.php';
Bdd::connecter();

include("includes/_gestionErreurs.inc.php");

if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'initial';
}

$action = $_REQUEST['action'];

switch ($action) {
    case 'initial' :
        include("vues/Representation/vGestionRepresentation.php");
        break;
    case 'modifierheb':
        $nomLieu = $_REQUEST['nomLieu'];
        $nomGroupe = $_REQUEST['nomGroupe'];
        include ("vues/Representation/vModificationRepresentation.php");
        break;
}
Bdd::deconnecter();