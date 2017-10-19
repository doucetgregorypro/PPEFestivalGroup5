<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Representation Test</title>
    </head>
    <body>
        <?php
        use modele\metier\Representation;
        require_once __DIR__ . '/../includes/autoload.php';
        echo "<h2>Test unitaire de la classe métier Representation</h2>";
        $objet = new Representation("LE VILLAGE","Aira da Pedra","14:00","14:30");
        var_dump($objet);
        ?>
    </body>
</html>

