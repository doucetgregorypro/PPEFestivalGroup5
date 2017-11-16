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

//on obtient toute les representation depuis la bdd

$lesRepresentations = RepresentationDAO::getAllOrderedByDate();


// pour chaque representation on créer une ligne dans un tableau
foreach ($lesRepresentations as $uneRepresentations) {
    $Date = $uneRepresentations->getDate();
    //on teste si il s'agit du premier tableau ou si on change de date dans ce cas on créer une nouvelle table
    if(isset($prevDate)){
        if($prevDate != $Date){
            echo "</table>
            <strong>$Date</strong>
            <table width='60%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
        <tr class='enTeteTabNonQuad'>
            <td colspan='7'><strong>Groupes</strong></td>
        </tr>
        <tr class='enTeteTabQuad'>
            <td><strong>Lieu</strong></td>
            <td><strong>Groupe</strong></td>
            <td><strong>Début</strong></td>
            <td><strong>Fin</strong></td>
            <td><strong>Date</strong></td>
            <td></td>
            <td></td>
         </tr>";
     }
    }else{
        echo"<strong>$Date</strong>
            <table width='60%' cellspacing='0' cellpadding='0' class='tabNonQuadrille'>
        <tr class='enTeteTabNonQuad'>
            <td colspan='7'><strong>Groupes</strong></td>
        </tr>
        <tr class='enTeteTabQuad'>
            <td><strong>Lieu</strong></td>
            <td><strong>Groupe</strong></td>
            <td><strong>Début</strong></td>
            <td><strong>Fin</strong></td>
            <td><strong>Date</strong></td>
            <td></td>
            <td></td>
         </tr>";
    }
    //on stock nos valeur dans des variables
    echo"<tr class='ligneTabNonQuad'>";
    $nomLieu = $uneRepresentations->getLieu();
    $nomGroupe = $uneRepresentations->getGroupe();
    $tDébut = $uneRepresentations->getHeureDebut();
    $tFin = $uneRepresentations->getHeureFin();
    
    //on ecrit les données dans une ligne dans le tableau
    echo"<td>$nomLieu</td>";
    echo"<td>$nomGroupe</td>";
    echo"<td>$tDébut</td>";
    echo"<td>$tFin</td>";
    echo"<td>$Date</td>";
    echo"<td><a href='cRepresentation.php?action=modifierheb&nomLieu=$nomLieu&nomGroupe=$nomGroupe'>Modifier</a></td>";
    echo"<td><a href='cRepresentation.php?action=suprimerheb&nomLieu=$nomLieu&nomGroupe=$nomGroupe'>Suprimer</a></td>";
    echo"</tr>";
    $prevDate = $Date;  
}
Bdd::deconnecter();