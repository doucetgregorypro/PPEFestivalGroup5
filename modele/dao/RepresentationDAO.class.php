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
    
    /**
     * Valorise les paramètres d'une requête préparée avec l'état d'un objet Representation
     * @param type $objetMetier une Representation
     * @param type $stmt requête préparée
     */
    protected static function metierVersEnreg(Representation $objetMetier, PDOStatement $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        // Note : bindParam requiert une référence de variable en paramètre n°2 ; 
        // avec bindParam, la valeur affectée à la requête évoluerait avec celle de la variable sans
        // qu'il soit besoin de refaire un appel explicite à bindParam
        $stmt->bindValue(':idGroupe', $objetMetier->getGroupe());
        $stmt->bindValue(':idLieu', $objetMetier->getLieu());
        $stmt->bindValue(':heureDeb', $objetMetier->getHeureDebut());
        $stmt->bindValue(':heureFin', $objetMetier->getHeureFin());
        $stmt->bindValue(':dateRepres', $objetMetier->getDate());
        $stmt->bindParam(':idGroupeRecherche', $objetMetier->getGroupe());
        $stmt->bindParam(':idLieuRecherche', $objetMetier->getLieu());
    }
    
    /**
     * Mettre à jour enregistrement dans la table à partir de l'état d'un objet métier
     * @param string identifiant du groupe et du lieu de la représentation à mettre à jour
     * @param Representation $objet objet métier à mettre à jour
     * @return boolean =FALSE si l'opérationn échoue
     */
    public static function update(Representation $objet) {
        $ok = false;
        $requete = "UPDATE Representation SET ID_LIEU=:idLieu, ID_GROUPE=:idGroupe,
           HEUREDEB=:heureDeb, HEUREFIN=:heureFin, DATEREPRES=:dateRepres
           WHERE ID_GROUPE=:idGroupeRecherche AND ID_LIEU=:idLieuRecherche";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

     /**
     * Détruire un enregistrement de la table REPRESENTATION d'après son groupe et lieu
     * @param string identifiant du groupe et du lieu de la representation à détruire
     * @return boolean =TRUE si l'enregistrement est détruit, =FALSE si l'opération échoue
     */
    public static function delete($idLieu, $idGroupe) {
        $ok = false;
        $requete = "DELETE FROM Representation WHERE ID_GROUPE = :idGroupe AND ID_LIEU = :idLieu";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':idGroupe', $idGroupe);
        $stmt->bindParam(':idLieu', $idLieu);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }
    
    public  static function getOneById($idGroupe, $idLieu){
        $objetConstruit = null;
        $requete = "SELECT * FROM Representation WHERE id_groupe = :idGroupe AND id_lieu = :idLieu";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':idGroupe', $idGroupe);
        $stmt->bindParam(':idLieu', $idLieu);
        $ok = $stmt->execute();
        // attention, $ok = true pour un select ne retournant aucune ligne
        if ($ok && $stmt->rowCount() > 0) {
            $objetConstruit = self::enregVersMetier($stmt->fetch(PDO::FETCH_ASSOC));
        }
        return $objetConstruit;
    }
    
}

