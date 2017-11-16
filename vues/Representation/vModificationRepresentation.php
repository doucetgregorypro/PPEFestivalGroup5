<?php

use modele\dao\RepresentationDAO;
use modele\metier\Representation;
use modele\metier\Lieu;
use modele\dao\LieuDAO;
use modele\metier\Groupe;
use modele\dao\GroupeDAO;
use modele\dao\Bdd;

require_once __DIR__ . '/../../includes/autoload.php';
Bdd::connecter();

include("includes/_debut.inc.php");

//on récupere la representation choisie ainsi que une liste de tous les objet lieu et tous les objets groupes
$idGroupe = $_GET["nomGroupe"];
$idLieu = $_GET["nomLieu"];
$uneRepre = RepresentationDAO::getOneById($idGroupe, $idLieu);
$AllLieu = LieuDAO::getAll();
$AllGroupe = GroupeDAO::getAll();
// on créer une liste déroulante contenant les lieu
echo '<select>';
foreach ($AllLieu as $lieu){
    $nomLieu = $lieu->getNom();
    $idLieu = $lieu->getId();
    echo "<option value=" . $idLieu .">"."$nomLieu"."</option>";
}
echo '</select>';
echo '<br/><select>';
foreach ($AllGroupe as $groupe){
    $nomgroupe = $groupe->getNom();
    $idGroupe = $groupe->getId();
    echo "<option value=" . $idGroupe .">"."$nomgroupe"."</option>";
}
echo '</select>';

echo '<br/><p style="display: inline-block">ok</p>';
echo "<input placeholder=".$uneRepre->getHeureDebut()."></input>";
echo '<br/><p style="display: inline-block">ok</p>';
echo "<input placeholder=". $uneRepre->getHeureFin() ."></input>";
echo '<br/><p style="display: inline-block">date: </p>';
echo "<input placeholder=".$uneRepre->getDate()."></input>";
echo "<a href=cRepresentation.php?action=initial><button>Retour</button></a>";

Bdd::deconnecter();