<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use \modele\dao\RepresentationDAO;
use modele\dao\GroupeDAO;
use modele\dao\LieuDAO;
use modele\dao\Bdd;
require_once __DIR__ . '/../../includes/autoload.php';
Bdd::connecter();

include("includes/_debut.inc.php");

$lesRepresentations = Representation::getAll();

echo"<table width='60%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
        <tr class='enTeteTabNonQuad'>
            <td colspan='3'><strong>Groupes</strong></td>
        </tr>
        <tr class='enTeteTabQuad'>
            <td><strong>Lieu</strong></td>
            <td><strong>Groupe</strong></td>
            <td><strong>Début</strong></td>
            <td><strong>Fin</strong></td>
            <td><strong>Date</strong></td>
         </tr>";

foreach ($lesRepresentations as $uneRepresentations) {
    echo"<tr class='ligneTabNonQuad'>";
    $nomLieu = $uneRepresentations->getLieu();
    $nomGroupe = $uneRepresentations->getGroupe();
    $tDébut = $uneRepresentations->getDébut();
    $tFin = $uneRepresentations->getFin();
    $Date = $uneRepresentations->getDate();
    
    echo"<td>$nomLieu</td>";
    echo"<td>$nomGroupe</td>";
    echo"<td>$tDébut</td>";
    echo"<td>$tFin</td>";
    echo"<td>$Date</td>";
    echo"</tr>";
}