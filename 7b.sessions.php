<?php
    session_start();
    setcookie('reference','ROG123');
    $id_session = session_id();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les sessions</title>
</head>
<body>
    <h1>Les sessions</h1>
    <p>Une session en PHP correspond à 
        <ul>
            <li>une façon de stocker des données différentes pour chaque utilisateur ... </li>
            <li>... en utilisant un identifiant de session unique.</li>
        </ul>
    Les identifiants de session vont généralement être envoyés au navigateur via des <em>cookies de session</em> et vont être utilisés pour récupérer les données existantes de la session.</br>
    Un des grands intérêts des sessions est qu’on va pouvoir conserver des informations pour un utilisateur <u>lorsqu’il navigue d’une page à une autre</u>.</br>
    De plus, <strong>les informations de session <u>ne vont pas</u> être stockées sur les ordinateurs de vos visiteurs</strong> à la différence des cookies mais plutôt côté serveur ce qui fait que les sessions vont pouvoir être beaucoup plus sûres que les cookies.</br>
    Notez toutefois que le but des sessions n’est pas de conserver des informations indéfiniment mais simplement durant une « session ».</p>
    <p>Une session
        <ul>
            <li>démarre dès que la fonction session_start() est appelée ...</li>
            <li> ... et se termine en général dès que la fenêtre courante du navigateur est fermée</li>
        </ul>
    La superglobale $_SESSION est un tableau associatif qui va contenir toutes les données de session une fois la session démarrée.</p>
    <h2>Démarrer une session en PHP</h2>
    <p>Pour démarrer une session en PHP, on va utiliser la fonction <strong>session_start()</strong>. Cette fonction va
        <ol>
            <li>se charger de vérifier si une session a déjà été démarrée en recherchant la présence d’un identifiant de session</li>
            <li>et, si ce n’est pas le cas, va démarrer une nouvelle session et générer un identifiant de session unique pour un utilisateur.</li>
        </ol>
    </p>
    <p>Comme setcookie(), session_start() doit être appelé avant toute autre opération dans nos pages.</br>
    <u>Il faut appeler session_start() dans chaque page où on souhaite pouvoir accéder aux variables de session</u> en pratique, on créera généralement une page header.php qui va contenir notre fonction session_start() et qu’on va inclure à l’aide de include ou require dans les pages voulues d’un site.</p>
    <?php
        echo "setcookie après session_start: la référence est " . $_COOKIE['reference'] . "</br>";
        var_dump($_SESSION); // le tableau est vide
    ?>
    <p>Quand une session est démarrée, c’est-à-dire lorsqu’un utilisateur qui ne possède pas encore d’identifiant de session demande à accéder à une page contenant <u>session_start()</u>, <strong>cette fonction va générer un identifiant de session unique</strong> qui va être envoyé au navigateur sous forme de cookie sous le nom <em>PHPSESSID</em>: on pourra donc le récupérer grâce à <em>$_COOKIE['PHPSESSID']</em>.</br>
    Pour être tout à fait précis, le PHP supporte deux méthodes pour garder la trace des sessions : via des cookies ou via l’URL. Si les cookies sont activés, le PHP va préférer leur utilisation. C’est le comportement recommandé. Dans le cas contraire, les informations de session vont être passées via l’URL.</p>
    <?php
        if($id_session) {
            echo 'L\'ID de session généré par session_start() est ' . $id_session . '</br>';
            echo 'Il est aussi stocké dans $_COOKIE[\'PHPSESSID\']: </br>';
            echo $_COOKIE['PHPSESSID'].'</br>';
        }
    ?>
    <p><strong>NOTE</strong>: dès qu'une session est lancée, PHP créé un fichier de session qui contiendra les infos liées à la session pendant sa durée de vie.</p>
    <h2>Définir et récupérer des variables de session</h2>
    <p>Pour définir et récupérer les valeurs des variables de session, il faut utiliser la variable superglobale $_SESSION(tableau associatif).</br>
    Une fois une variable de session définie, celle-ci va pouvoir être accessible durant la durée de la session à partir de toutes les pages du site pour lesquelles les sessions ont été activées.</br>
    Pour illustrer cela, créons une autre page session.php : on y démarrera une nouvelle session avec quelques variables de session créées manuellement.</br>
    En haut de cette page, nous avons appelé session_start(): nous aurons donc accès aux variables de sessions créées dans session.php.</p>
    <?php
        echo "Nous pouvons récupérer ici les variables de session; faisons un var_dump de la superglobale ".'$_SESSION</br>';
        var_dump($_SESSION);
        echo "On peut donc les manipuler ici: ".$_SESSION['prenom']." habite à ".$_SESSION['ville'].'</br>';
        echo "Peut-on créer une variable de session ailleurs qu'en début de code ? ".$_SESSION['test'].'</br>';
        echo "Maintenant je créé une variable de session à cet endroit de cette page et je tente de l'appeler.</br>";
        $_SESSION['auto'] = 'Volvo';
        echo "Mon auto est une ".$_SESSION['auto'].'.</br>';
        echo session_id().'</br>';
    ?>
    <h2>Terminer une session et détruire les variables de session</h2>
    <p>Une session PHP se termine généralement automatiquement lorsqu’un utilisateur ferme la fenêtre de son navigateur.</br>
    Il peut être cependant parfois souhaitable de terminer une session avant. Pour ce faire, il faut utiliser les fonctions
        <ul>
            <li><strong>session_destroy()</strong> qui détruit toutes les données associées à la session courante</li>
            <li>et <strong>session_unset()</strong> qui détruit toutes les variables d’une session.</li>
        </ul></br>
    La fonction session_destroy() va supprimer le fichier de session dans lequel sont stockées toutes les informations de session MAIS <u>cette fonction ne détruit pas les variables globales associées à la session</u> (c’est-à-dire le contenu du tableau $_SESSION) ni le cookie de session.</br></br>
    <u>Pour détruire totalement une session, il va également falloir supprimer l’identifiant de session</u>. Généralement, cet identifiant est contenu dans le cookie PHPSESSID qu’on pourra effacer en utilisant setcookie() en définissant une date d’expiration passée pour le cookie.</p>
    <p><em>Il va cependant être très rare d’avoir besoin de détruire les données associées à une session et donc d’appeler session_destroy()</em>. On préférera généralement modifier le tableau $_SESSION manuellement pour supprimer des données en particulier.</br>
    Notez qu’on va également pouvoir utiliser la fonction session_unset() (sans lui passer d’argument) pour détruire toutes les variables de la session courante. Cette fonction va également nous permettre de détruire une variable de session en particulier en lui passant sa valeur de la manière suivante : <em>unset($_SESSION['nom-de-la-variable-de-session-adetruire'])</em>.</p>
    <p>Chronologiquement, dans le script:
        <ul>
            <li>on commence par démarrer une session ou par reprendre une session existante avec session_start().</li>
            <li>on vérifie que (par exemple) la variable $_SESSION['age'] a bien été définie et, si c’est le cas, on affiche sa valeur. </li>
            <li>ensuite on la détruit avec unset().</li>
            <li>A la fin du script, on détruit les informations associées à la session avec session_destroy().</li>
            <li>On essaie alors d’afficher le contenu de nos variables de session en utilisant le tableau $_SESSION. Ici, $_SESSION['age'] ne renvoie aucune valeur puisqu’on l’a détruite avec unset().</li>
            <li>En revanche, $_SESSION['prenom'] (par exemple) renvoie bien toujours une valeur CAR <u>session_destroy() <strong>ne va pas</strong> détruire les variables globales de session</u>. Cependant, comme les <em>informations</em> de session sont détruites, les variables de session ne vont plus être accessibles que dans le script courant.</li>
        </ul>   
    </p>
</body>
</html>