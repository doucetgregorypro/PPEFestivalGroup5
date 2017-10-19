<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Lieu : test</title>
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

        echo "<h2>Test de LieuDAO</h2>";

        $idLieu = '3';

        // Test n°1
        echo "<h3>1- getOneById</h3>";
        $objet = LieuDAO::getOneById($idLieu);
        var_dump($objet);

        // Test n°2
        echo "<h3>2- getAll</h3>";
        $lesObjets = LieuDAO::getAll();
        var_dump($lesObjets);

        // Test n°3
        echo "<h3>3- insert</h3>";
        $idLieu = '7357';
        $nomLieu = 'TestLoc';
        $adrLieu = '5 rue du Test';
        $capLieu = 7357;
        try {
            $lieu = new Lieu($idLieu, $nomLieu, $adrLieu, $capLieu);
            $ok = $lieu;
            if ($ok) {
                echo "<h4>ooo réussite de l'insertion ooo</h4>";
                $objetLu = LieuDAO::getOneById($idLieu);
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
            $ok = LieuDAO::delete($idLieu);
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
