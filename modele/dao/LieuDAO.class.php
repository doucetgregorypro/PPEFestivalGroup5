<?php

namespace modele\dao;

use modele\metier\Lieu;
use PDO;


/**
 * Description of LieuDAO
 * Classe métier :  Lieu
 * @author gdoucet
 * @version 2017
 */

class LieuDAO {
    /**
     * Instancier un objet de la classe Lieu à partir d'un enregistrement de la table LIEU
     * @param array $enreg
     * @return Lieu
     */
    
    protected static function enregVersMetier(array $enreg) {
        $id = $enreg['ID'];
        $nom = $enreg['NOM'];
        $adresse = $enreg['ADR'];
        $capacite = $enreg['CAPACITE'];
        $unLieu = new Lieu($id, $nom, $adresse, $capacite);

        return $unLieu;
    }
    
    /**
     * Retourne la liste de tous les lieux
     * @return array tableau d'objets de type Lieu
     */
    public static function getAll() {
        $lesObjets = array();
        $requete = "SELECT * FROM Lieu";
        $stmt = Bdd::getPdo()->prepare($requete);
        $ok = $stmt->execute();
        if ($ok) {
            // Tant qu'il y a des enregistrements dans la table
            while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //ajoute un nouveau groupe au tableau
                $lesObjets[] = self::enregVersMetier($enreg);
            }
        }
        return $lesObjets;
    }
    
    /**
     * Recherche un groupe selon la valeur de son identifiant
     * @param int $id
     * @return Lieu le lieu trouvé ; null sinon
     */
    public static function getOneById($id) {
        $objetConstruit = null;
        $requete = "SELECT * FROM Lieu WHERE ID = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        // attention, $ok = true pour un select ne retournant aucune ligne
        if ($ok && $stmt->rowCount() > 0) {
            $objetConstruit = self::enregVersMetier($stmt->fetch(PDO::FETCH_ASSOC));
        }
        return $objetConstruit;
    }
    
    /**
     * Valorise les paramètres d'une requête préparée avec l'état d'un objet Lieu
     * @param type $objetMetier un Lieu
     * @param type $stmt requête préparée
     */
    protected static function metierVersEnreg(Lieu $objetMetier, PDOStatement $stmt) {
        // On utilise bindValue plutôt que bindParam pour éviter des variables intermédiaires
        // Note : bindParam requiert une référence de variable en paramètre n°2 ; 
        // avec bindParam, la valeur affectée à la requête évoluerait avec celle de la variable sans
        // qu'il soit besoin de refaire un appel explicite à bindParam
        $stmt->bindValue(':id', $objetMetier->getId());
        $stmt->bindValue(':nom', $objetMetier->getNom());
        $stmt->bindValue(':adr', $objetMetier->getAdresse());
        $stmt->bindValue(':capacite', $objetMetier->getCapacite());
    }
    
    /**
     * Insérer un nouvel enregistrement dans la table LIEU à partir de l'état d'un objet metier
     * @param Lieu $objet objet métier à insérer
     * @return boolean =FALSE si l'opération échoue
     */
    public static function insert(Etablissement $objet) {
        $requete = "INSERT INTO Lieu VALUES (:id, :nom, :adr, :capacite)";
        $stmt = Bdd::getPdo()->prepare($requete);
        self::metierVersEnreg($objet, $stmt);
        $ok = $stmt->execute();
        return ($ok && $stmt->rowCount() > 0);
    }

     /**
     * Détruire un enregistrement de la table LIEU d'après son identifiant
     * @param string identifiant de l'enregistrement à détruire
     * @return boolean =TRUE si l'enregistrement est détruit, =FALSE si l'opération échoue
     */
    public static function delete($id) {
        try{
        $requete = "DELETE FROM Lieu WHERE ID = :id";
        $stmt = Bdd::getPdo()->prepare($requete);
        $stmt->bindParam(':id', $id);
        $ok = $stmt->execute();
        $ok = $ok && ($stmt->rowCount() > 0);
        return true;
        }catch(Exception $e) {
        return false;}
    }
    

}
