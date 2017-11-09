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
        $idLieu = $enreg['ID'];
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
    public static function getAllByDate($date) {
        $lesObjets = array();
        $requete = "SELECT * FROM Representation WHERE DATEREPRES = :id ";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $date);
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
    protected static function metierVersEnreg(Etablissement $objetMetier, PDOStatement $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        // Note : bindParam requiert une référence de variable en paramètre n°2 ; 
        // avec bindParam, la valeur affectée à la requête évoluerait avec celle de la variable sans
        // qu'il soit besoin de refaire un appel explicite à bindParam
        $stmt->bindValue(':idGroupe', $objetMetier->getGroupe());
        $stmt->bindValue(':idLieu', $objetMetier->getLieu());
        $stmt->bindValue(':heureDeb', $objetMetier->getHeureDebut());
        $stmt->bindValue(':heureFin', $objetMetier->getHeureFin());
        $stmt->bindValue(':dateRepres', $objetMetier->getDate());
    }
    
    /**
     * Mettre à jour enregistrement dans la table à partir de l'état d'un objet métier
     * @param string identifiant du groupe et du lieu de la représentation à mettre à jour
     * @param Representation $objet objet métier à mettre à jour
     * @return boolean =FALSE si l'opérationn échoue
     */
    public static function update($idGroupe, $idLieu, Representation $objet) {
        $ok = false;
        $requete = "UPDATE Representation SET ID_LIEU=:idGroupe, ID_GROUPE=:idLieu,
           HEUREDEB=:heureDeb, HEUREFIN=:heureFin, DATEREPRES=:dateRepres
           WHERE ID_GROUPE=:idGroupeRecherche AND ID_LIEU=:idLieuRecherche";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $stmt->bindParam(':idGroupeRecherche', $idGroupe);
        $stmt->bindParam(':idLieuRecherche', $idLieu);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

     /**
     * Détruire un enregistrement de la table REPRESENTATION d'après son groupe et lieu
     * @param string identifiant du groupe et du lieu de la representation à détruire
     * @return boolean =TRUE si l'enregistrement est détruit, =FALSE si l'opération échoue
     */
    public static function delete($idGroupe, $idLieu) {
        $ok = false;
        $requete = "DELETE FROM Representation WHERE ID_GROUPE = :idGroupe AND ID_LIEU = :idLieu";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':idGroupe', $idGroupe);
        $stmt->bindParam(':idLieu', $idLieu);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return $ok;
    }
    
}

