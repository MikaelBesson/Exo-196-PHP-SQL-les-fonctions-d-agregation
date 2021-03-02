<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    /**
     * 1. Importez le contenu du fichier user.sql dans une nouvelle base de données.
     * 2. Utilisez un des objets de connexion que nous avons fait ensemble pour vous connecter à votre base de données.
     *
     * Pour chaque résultat de requête, affichez les informations, ex:  Age minimum: 36 ans <br>   ( pour obtenir une information par ligne ).
     *
     * 3. Récupérez l'age minimum des utilisateurs.
     * 4. Récupérez l'âge maximum des utilisateurs.
     * 5. Récupérez le nombre total d'utilisateurs dans la table à l'aide de la fonction d'agrégation COUNT().
     * 6. Récupérer le nombre d'utilisateurs ayant un numéro de rue plus grand ou égal à 5.
     * 7. Récupérez la moyenne d'âge des utilisateurs.
     * 8. Récupérer la somme des numéros de maison des utilisateurs ( bien que ca n'ait pas de sens ).
     */

    // TODO Votre code ici, commencez par require un des objet de connexion que nous avons fait ensemble.

    try {
    $server ='localhost';
    $user = 'root';
    $password = '';
    $db = 'exo_196';

    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    echo 'connection ok <br>';
        echo"<br>";

       echo "3. Récupérez l'age minimum des utilisateurs.<br>";
    $search = $conn->prepare("SELECT MIN(age) as minimum FROM user");

    $result = $search->execute();
    if($result) {
        $min = $search->fetch();
        echo "le plus petit age trouvé est : " . $min['minimum'] . " ans<br>";
    }
    echo"<br>";

        echo "4. Récupérez l'âge maximum des utilisateurs.<br>";
        $search = $conn->prepare("SELECT max(age) as maximum FROM user");

        $result = $search->execute();
        if($result) {
            $max = $search->fetch();
            echo "le plus grand age trouvé est : " . $max['maximum'] . " ans<br>";
        }
        echo"<br>";

        echo "5. Récupérez le nombre total d'utilisateurs dans la table à l'aide de la fonction d'agrégation COUNT().<br>";
        $search = $conn->prepare("SELECT count(*) AS number FROM user");

        $result = $search->execute();
        if($result) {
            $count = $search->fetch();
            echo "il y as : " . $count['number'] . " utilisateurs<br>";
        }
        echo"<br>";

        echo "6. Récupérer le nombre d'utilisateurs ayant un numéro de rue plus grand ou égal à 5.<br>";
        $search = $conn->prepare("SELECT count(*) AS number FROM user WHERE numero >= 5");

        $result = $search->execute();
        if($result) {
            $count = $search->fetch();
            echo "il y as : " . $count['number'] . " utilisateurs dont le numero de rue est superieur ou egal a 5<br>";
        }
        echo"<br>";

        echo "7. Récupérez la moyenne d'âge des utilisateurs.<br>";
        $search = $conn->prepare("SELECT AVG(age) AS moyenne FROM user");

        $result = $search->execute();
        if($result) {
            $moyenne = $search->fetch();
            echo "l'age moyen de mes utilisateurs est :" . $moyenne['moyenne'] . "<br>";
        }
        echo"<br>";

        echo "8. Récupérer la somme des numéros de maison des utilisateurs ( bien que ca n'ait pas de sens ).<br>";
        $search = $conn->prepare("SELECT SUM(numero) AS somme FROM user");

        $result = $search->execute();
        if($result) {
            $somme = $search->fetch();
            echo "la somme des numéros de maison des utilisateurs est :" . $somme['somme'] . "<br>";
        }
        echo"<br>";
        
    }
    catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }

    ?>
</body>
</html>

