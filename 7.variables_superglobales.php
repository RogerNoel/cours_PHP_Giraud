<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables superglobales</title>
    <style>
        b {font-weight: normal;} /* pour réparer le user stylesheet agent de chrome */
    </style>
</head>
<body>
    <h1>Les variables superglobales</h1>
    <p>Ces variables sont créées automatiquement par PHP. Elles sont accessibles n'importe où dans le script. Elles sont des tableaux qui contiennent des groupes de variables.</br>
    Elles sont au nombre de 9:
        <ul>
            <li>$GLOBALS</li>
            <li>$_SERVER</li>
            <li>$_REQUEST</li>
            <li>$_GET</li>
            <li>$_POST</li>
            <li>$_FILES</li>
            <li>$_ENV</li>
            <li>$_COOKIE</li>
            <li>$_SESSION</li>
        </ul>
    </p>
    <h2>$GLOBALS</h2>
    <p>C'est un tableau associatif qui contient en index les noms des variables créées dans l'espace global et en valeurs, leur ... valeur.</p>
    <?php
        // var_dump($GLOBALS);
        $prenom = 'Roger';
        $nom = 'Noel';
        $age = 56;

        function presentation(){
            global $prenom; // on rapatrie la variable globale "prenom"
            echo "Je suis $prenom.</br>";
            echo "Mon nom est ".$GLOBALS['nom'] ."</br>"; // on appelle la clef "nom" du tableau $GLOBALS
        }
        presentation();
        echo 'Les variables déclarées en globale sont intégrées à la superglobale $GLOBALS.';
    ?>
    <h2>$_SERVER</h2>
    <p>La superglobale $_SERVER contient des variables définies par le serveur utilisé ainsi que des informations relatives au script. Cette superglobale est un tableau associatif dont les clefs sont les noms des variables qu’elle stocke et les valeurs sont les valeurs des variables liées.</p>
    <h2>$_REQUEST</h2>
    <p>La variable -tableau associatif- superglobale $_REQUEST va contenir toutes les variables envoyées via HTTP GET, HTTP POST et par les cookies HTTP.</p>
    <h2>$_ENV</h2>
    <p>La superglobale tableau associatif $_ENV va contenir des informations liées à l’environnement dans lequel s’exécute le script.</p>
    <h2>$_FILES</h2>
    <p>La superglobale $_FILES va contenir des informations sur un fichier téléchargé, comme le
type du fichier, sa taille, son nom, etc. On pourra donc utiliser cette superglobale lorsqu’on offre la possibilité à nos utilisateurs de nous envoyer des fichiers, afin d’obtenir des informations sur les fichiers envoyés ou même pour filtrer et interdire l’envoi de certains fichiers.</p>
    <h2>$_GET et $_POST</h2>
    <p>Les superglobales $_GET et $_POST vont être utilisées pour manipuler les informations
    envoyées via un formulaire HTML. En effet, <em>ces deux superglobales vont stocker les différentes valeurs envoyées par un utilisateur via un formulaire selon la méthode d’envoi</em> : 
        <ul>
            <li>$_GET stockera les valeurs lorsque le formulaire sera envoyé via la méthode GET</li>
            <li>$_POST stockera les valeurs lorsque le formulaire sera envoyé via la méthode POST.</li>
        </ul>
    </p>
    <form method="post" action="7.variables_superglobales.php">
        <label for="prenom">Entrez votre prénom</label>
        <input type="text" id="prenom" name="prenom">
        <input type="submit" value="Envoyer">
    </form>
    <?php
        if(isset($_POST['prenom'])) {
            echo $_POST['prenom'] . " a été envoyé.</br>";
        }
    ?>
    <h2>$_COOKIE</h2>
    <p>La superglobale $_COOKIE est un tableau associatif qui contient toutes les variables passées via des cookies HTTP.</p>
    <h2>$_SESSION</h2>
    <p>La superglobale $_SESSION est un tableau associatif qui contient toutes les variables de
session.</p>
</body>
</html>