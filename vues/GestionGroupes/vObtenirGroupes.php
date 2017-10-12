<?php

use modele\dao\GroupeDAO;
use modele\dao\AttributionDAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../includes/autoload.php';
Bdd::connecter();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include ("includes/_debut.inc.php");

$lesGroupes = GroupeDAO::getAll();

echo"<table width='60%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
        <tr class='enTeteTabNonQuad'>
            <td colspan='3'><strong>Groupes</strong></td>
        </tr>";

foreach ($lesGroupes as $unGroupe) {
    echo"<tr class='ligneTabNonQuad'>";
    $nomGroupe = $unGroupe->getNom();
    $nmbPersonnes = $unGroupe->getNbPers();
    $nomPays = $unGroupe->getNomPays();
    
    echo"<td>$nomGroupe</td>";
    echo"<td>$nmbPersonnes</td>";
    echo"<td>$nomPays</td>";
    echo"</tr>";
}


echo"</table>";
include ("includes/_fin.inc.php");
