<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Representation : test</title>
    </head>

    <body>

        <?php

        use modele\dao\OffreDAO;
        use modele\dao\GroupeDAO;
        use modele\dao\LieuDAO;
        use modele\dao\Bdd;
        use modele\metier\Lieu;

require_once __DIR__ . '/../includes/autoload.php';

        Bdd::connecter();

        echo "<h2>Test de RepresenationDAO</h2>";

        $idRepresentation = '3';

        // Test n°1
        echo "<h3>1- getOneById</h3>";
        $objet = RepresentationDAO::getOneById($idRepresentation);
        var_dump($objet);

        // Test n°2
        echo "<h3>2- getAll</h3>";
        $lesObjets = RepresentationDAO::getAll();
        var_dump($lesObjets);

        // Test n°3
        echo "<h3>3- insert</h3>";
        $idRepresentation = '34';
        $lieuRepresentation = 'LE VILLAGE';
        $heureDebutRepresentation = '14:00';
        $heureFinRepresentation = '14:30';
        $dateRepresentation = '2017-07-14';
                
        try {
            $representation = new Representation($idRepresentation, $lieuRepresentation, $heureDebutRepresentation, $heureFinRepresentation, $date);
            $ok = $representation;
            if ($ok) {
                echo "<h4>ooo réussite de l'insertion ooo</h4>";
                $objetLu = RepresentationDAO::getOneById($idRepresentation);
                var_dump($objetLu);
            } else {
                echo "<h4>*** échec de l'insertion ***</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>*** échec de la requête ***</h4>" . $e->getMessage();
        }
        
        // Test n°4
        echo "<h3>4- delete</h3>";
        try {
            $ok = RepresentationDAO::delete($idRepresentation);
            if ($ok) {
                echo "<h4>ooo réussite de la suppression ooo</h4>";
            } else {
                echo "<h4>*** échec de la suppression ***</h4>";
            }
        } catch (Exception $e) {
            echo "<h4>*** échec de la requête ***</h4>" . $e->getMessage();
        }
        
        Bdd::deconnecter();
        ?>


    </body>
</html>