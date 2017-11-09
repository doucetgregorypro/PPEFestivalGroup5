<?php
namespace modele\dao;

use modele\metier\Representation;
use PDO;

/**
 * Description of RepresentationDAO
 * Classe métier :  Representation
 * @author gdoucet
 * @version 2017
 */
class RepresentationDAO {


    /**
     * Instancier un objet de la classe Representation à partir d'un enregistrement de la table REPRESENTATION
     * @param array $enreg
     * @return Representation
     */
    protected static function enregVersMetier(array $enreg) {
        $idLieu = $enreg['ID_LIEU'];
        $idGroupe = $enreg['ID_GROUPE'];
        $heureDeb = $enreg['HEUREDEB'];
        $heureFin = $enreg['HEUREFIN'];
        $dateRepresentation = $enreg['DATEREPRES'];
        $uneRepresentation = new Representation($idLieu, $idGroupe, $heureDeb, $heureFin, $dateRepresentation);

        return $uneRepresentation;
    }


    /**
     * Retourne la liste de toutes les représentations
     * @return array tableau d'objets de type Representation
     */
    public static function getAllOrderedByDate() {
        $lesObjets = array();
        $requete = "SELECT * FROM Representation ORDER BY DATEREPRES";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        if ($ok) {
            // Tant qu'il y a des enregistrements dans la table
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //ajoute une nouvelle représentation au tableau
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }

    /**
     * Retourne la liste des représentations attribués à un groupe donné
     * @param string $idGroupe
     * @return array tableau d'éléments de type Representation
     */
    public static function getAllByGroupe($idGroupe) {
        $lesRepresentations = array();  // le tableau à retourner
        $requete = "SELECT * FROM Representation
                    WHERE ID_GROUPE = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $idGroupe);
        $ok = $stmt->execute();
        if ($ok) {
            // Tant qu'il y a des enregistrements dans la table
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //ajoute un nouveau groupe au tableau
                $lesRepresentations[] = self::enregVersMetier($enreg);
            }
        } 
        return $lesRepresentations;
    } 
    
    /**
     * Retourne la liste des représentations attribués à un groupe donné
     * @param string $idGroupe
     * @return array tableau d'éléments de type Representation
     */
    public static function getAllByLieu($idLieu) {
        $lesRepresentations = array();  // le tableau à retourner
        $requete = "SELECT * FROM Representation
                    WHERE ID_LIEU = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $idLieu);
        $ok = $stmt->execute();
        if ($ok) {
            // Tant qu'il y a des enregistrements dans la table
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //ajoute un nouveau groupe au tableau
                $lesRepresentations[] = self::enregVersMetier($enreg);
            }
        } 
        return $lesRepresentations;
    }
    
}

