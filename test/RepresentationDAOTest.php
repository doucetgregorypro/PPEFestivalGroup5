<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Representation : test</title>
    </head>

    <body>

        <?php

        use modele\dao\RepresentationDAO;
        use modele\dao\Bdd;
        use modele\metier\Representation;

require_once __DIR__ . '/../includes/autoload.php';

        Bdd::connecter();

        echo "<h2>Test de RepresenationDAO</h2>";

        $idGroupe = 'g008';
        $idLieu = 1;

        // Test n°1
        echo "<h3>1- getOneById</h3>";
        try {
            $objet = RepresentationDAO::getOneById($idGroupe, $idLieu);
            var_dump($objet);
        } catch (Exception $ex) {
            echo "<h4>*** échec de la requête ***</h4>" . $ex->getMessage();
        }

        // Test n°2
        echo "<h3>2- getAll</h3>";
        try {
            $lesObjets = RepresentationDAO::getAllOrderedByDate();
            var_dump($lesObjets);
        } catch (Exception $ex) {
            echo "<h4>*** échec de la requête ***</h4>" . $ex->getMessage();
        }
/*
        // Test n°3
        echo "<h3>3- update</h3>";
        $lieuRepresentation = 1;
        $groupeRepresentation = 'g008';
        $heureDebutRepresentation = '20:00:00';
        $heureFinRepresentation = '22:00:00';
        $dateRepresentation = '2017-07-12';
        
        try {
            $representation = new Representation($lieuRepresentation, $groupeRepresentation, $heureDebutRepresentation, $heureFinRepresentation, $dateRepresentation);
            $ok = RepresentationDAO::update($representation);
            if ($ok) {
                $objetLu = RepresentationDAO::getOneById($lieuRepresentation, $groupeRepresentation);
                var_dump($objetLu);
                $heureDebutRepresentation = '20:30:00';
                $ok = RepresentationDAO::update($representation); //remettre la bonne info
            } else {
                echo "<h4>*** échec de la mise à jour, erreur DAO ***</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>*** échec de la requête, erreur PDO ***</h4>" . $e->getMessage();
        }
*/
        /*
         * 
         * -------Fonctionnel mais aucune fonction insert, 
         * donc rajout de la ligne supprimer à la main si execution
         * du test de la methode update ----------
         */
        
        /*
        // Test n°4
        echo "<h3>4- delete</h3>";
        
        $lieuRepresentation = 1;
        $groupeRepresentation = 'g008';
        try {
            $ok = RepresentationDAO::delete($lieuRepresentation, $groupeRepresentation);
            if ($ok) {
                echo "<h4>ooo réussite de la suppression ooo</h4>";
            } else {
                echo "<h4>*** échec de la suppression ***</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>*** échec de la requête ***</h4>" . $e->getMessage();
        }
         */
        
        Bdd::deconnecter();
        ?>


    </body>
</html>