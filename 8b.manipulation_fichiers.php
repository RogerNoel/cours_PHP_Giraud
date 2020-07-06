<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manipulation de fichiers</title>
    <style>
        table { border-collapse: collapse; }
        td { border: 1px solid black; padding: 5px; }
        /* tr { border-collapse: collapse; } */
    </style>
</head>
<body>
    <h1>Manipulation de fichiers - Suite</h1>
    <h2>Créer et écrire dans un fichier en PHP</h2>
    <p>Dans la 1° partie, nous avons appris à ouvrir un fichier et mis le doigt sur le <em>mode d’ouverture</em> qui va conditionner les opérations qu’on va pouvoir effectuer sur le fichier ouvert.</br>
    Nous avons également appris à gérer la place du pointeur, ce qui va se révéler essentiel pour écrire dans un fichier en PHP contenant déjà du texte.</br>
    Ici, nous allons apprendre à créer un fichier et à écrire dans un fichier vierge ou contenant déjà du texte.</p>
    <h2>Créer un fichier / écrire dans un fichier</h2>
    <p>Il existe différentes façons de créer un fichier et d’écrire dans un fichier déjà existant ou pas et contenant déjà du texte ou pas en PHP.</br>
    Les deux façons les plus simples vont être d’utiliser,
        <ul>
            <li>soit la fonction file_put_contents(),</li>
            <li>soit les fonctions fopen() et fwrite() ensemble.</li>
        </ul>
    <strong>L’utilisation des fonctions fopen() et fwrite() va nous donner plus de contrôle</strong> sur l'écriture, en permettant de choisir un mode d’ouverture, d’écrire à un endroit du fichier, etc.</p>
    <h3>Ecrire dans un fichier avec file_put_contents()</h3>
    <p>La <strong>fonction file_put_contents()</strong> permet d’écrire simplement des données dans un fichier. Cette fonction va accepter en argument,
        <ol>
            <li>le chemin vers le fichier dans lequel on doit écrire les données</li>
            <li>les données à écrire (qui peuvent être une chaine de caractères ou un
tableau)</li>
            <li>un drapeau (nous reviendrons là-dessus plus tard).</li>
        </ol>
    Si le fichier spécifié dans le chemin du fichier n’existe pas, alors il sera créé.</br>
    S’il existe, il sera par défaut écrasé, ce qui signifie que <u>ses données seront supprimées</u>.</br>
    <strong>Remarque</strong> : appeler file_put_contents() correspond à appeler successivement les fonctions fopen(), fwrite() et fclose().</p>
    <?php
        file_put_contents('./fichiers/fichier2.txt', 'Exemple simple d\'utilisation de file_put_content()');
        echo "Si on rappelle la fonction, le texte original sera écrasé par le nouveau. Pour ajouter du texte avec cette fonction, il faudra préalablement récupérer le texte existant dans une variable puis rappeler la fonction en concaténant les textes.</br>";
        $texteExistant = file_get_contents('./fichiers/fichier2.txt');
        file_put_contents('./fichiers/fichier2.txt', $texteExistant.= "\nAJOUT DE TEXTE");
        echo '<strong>Remarque:</strong> la combinaison \n créé un retour à la ligne, mais pour qu\'il soit interprété, il faut que la chaîne soit entourée de guillemets doubles ".</br>';
    ?>
    <p>Cette astuce pour rajouter du texte dans un fichier fonctionne mais nous force finalement à faire plusieurs opérations et à écraser le contenu de base du fichier pour placer le nouveau (qui contient le contenu original).</p>
    <p><strong>Pour véritablement conserver les données</strong> de base de notre fichier et lui ajouter de nouvelles données, on peut passer le drapeau FILE_APPEND en troisième argument de notre fonction file_put_contents().</p>
    <p>Un drapeau est une <em>constante</em> qui va correspondre à un nombre. De nombreuses fonctions utilisent des drapeaux différents. Le drapeau ou la constante FILE_APPEND permet donc d’ajouter des données en fin de fichier. </p>
    <?php
        file_put_contents('./fichiers/fichier2.txt', "\nUtilisation du flag FILE_APPEND", FILE_APPEND);
    ?>
    <h3>Créer un fichier avec fopen()</h3>
    <p>Pour créer un nouveau fichier en PHP (sans forcément écrire dedans), nous allons à nouveau utiliser la fonction <strong>fopen()</strong>.</br>
    En effet, rappelez-vous que cette fonction va pouvoir créer un fichier si celui-ci n’existe pas à condition qu’on utilise un mode adapté (arguments chemin + mode).</p>
    <?php
        echo 'Nous allons utiliser le mode c+ : ouvre un fichier pour lecture et écriture. Si le fichier n\'existe pas, il sera créé. S\'il existe, les infos seront conservées.</br>';
        fopen('./fichiers/fichier3.txt', 'c+b');
    ?>
    <h3>Ecrire dans un fichier avec fwrite()</h3>
    <p>Une fois un fichier ouvert ou créé avec fopen(), on va pouvoir écrire dedans en utilisant la fonction <strong>fwrite()</strong>. Cette fonction va prendre la valeur retournée par fopen() ainsi que la chaine de caractères à écrire dans le fichier en arguments. Si notre fichier est vide, on va très simplement pouvoir écrire du texte dedans.</p>
    <?php
        $ressource = fopen('./fichiers/fichier3.txt', 'c+b');
        fwrite($ressource, 'Ecriture d\'un texte avec fwrite().');
        echo '<strong>Remarque:</strong> un nouvel appel de fwrite() mettra le nouveau texte à la suite car fwrite() déplace la curseur à la fin du texte APRES chaque utilisation.</br>';
        fwrite($ressource, 'Ajout de texte.');
        fwrite($ressource, "\nJe passe à la ligne suivante.");
    ?>
    <p>Le problème va se situer lors de la <em><strong>première</strong> utilisation de fwrite()</em> <strong>dans un fichier qui contient déjà du texte</strong>.</br>
    En effet, la plupart des modes de fopen() vont placer le curseur <u>en début de fichier</u>. Les informations vont donc être écrites par-dessus les anciennes.</p>
    <?php
        echo 'Le fichier existant "fichier3.txt" contient ce texte: </br>' . file_get_contents('./fichiers/fichier3.txt').'</br>';
        echo 'Je le récupère dans une variable avec fopen().</br>';
        $fichier = fopen('./fichiers/fichier3.txt', 'c+b');
        echo 'Le curseur se trouve donc en début du fichier. Donc si je fais un fwrite() de la chaîne "123", voici ce qui résultera:</br>';
        fwrite($fichier, '123');
        echo file_get_contents('./fichiers/fichier3.txt');
    ?>
    <p>On utilisera la fonction <strong>fseek()</strong> vue auparavant pour modifier la position du pointeur et écrire à partir d’un autre endroit dans le fichier. En faisant cela, le nouveau texte sera écrit à partir d’un certain point dans le fichier. Si on tente d’écrire du texte au milieu du fichier, cependant, les données déjà présentes à cet endroit continueront d’être écrasées.</p>
    <p><strong>Rappel:</strong> on a utilisé fseek() avec 2 ou 3 arguments; fseek($ressource, nouvelle position (int)), fseek($ressource, 20, SEEK_CUR).</p>
    <?php
        fseek($fichier, filesize('./fichiers/fichier3.txt'));
        fwrite($ressource, 'Ecrire avec fseek().');
        fseek($ressource, 10);
        fwrite($ressource, '10');
        fseek($ressource, 15);
        fwrite($ressource, '15');
        echo 'Si on place le curseur sur une position au milieu du texte, fwrite() ne va pas insérer le texte mais <strong>remplacer</strong> le texte existant pas le nouveau, caractère pour caractère.</br>'
    ?>
    <p>Comment faire si on souhaite insérer du texte?</br>
    Il faudra récupérer la partie du texte qui se trouve avant le curseur, y concaténer le nouveau texte, puis récupérer ce qui se trouve après le curseur et le concaténer au reste et enfin ré-écrire le tout dans le fichier.</p>
    <?php
        $fichier = fopen('./fichiers/fichier3.txt', 'c+b');
        $partie1 = fread($fichier, 20); // récupération de ce qui précède position 20
        // et place le curseur en position 20
        $partie1.='Je rajoute du texte en position 20'; // on concatène dans la variable
        // le pointeur est donc en position 20. Un fread() reprendra la lecture à la position du lecteur. Donc on peut concaténer un nouveau fread() à $partie1
        $partie1.= fread($fichier, filesize('./fichiers/fichier3.txt'));
        // var_dump($partie1);
        rewind($fichier); // on remet le curseur au début
        fwrite($fichier, $partie1); // on réécrit le fichier
    ?>
    <p><strong>L'important est de toujours bien situer où se trouve le curseur à chaque étape.</strong></p>
    <h2>Autres opérations sur le fichiers</h2>
    <p>Il existe d’autres types de manipulations moins courantes sur les fichiers comme le renommage de fichier ou la suppression que nous allons rapidement voir.</br>
    Nous allons également étudier les niveaux de permission des fichiers, <u>un concept qu’il va être essentiel de comprendre et de maitriser</u> pour travailler avec des fichiers sur un « vrai » site hébergé sur serveur distant.</p>
    <h3>Tester l'existence d'un fichier</h3>
    <p>Il existe deux fonctions qui vont nous permettre de vérifier si un fichier existe et si un fichier est un véritable fichier (et non un répertoire par exemple).
        <ul>
            <li>La fonction <strong>file_exists()</strong> vérifie si un fichier <em>ou un dossier</em> existe. On lui passe le chemin du fichier/dossier en argument. Si le fichier/dossier existe, la fonction renverra le booléen true, sinon false.</li>
            <li>La fonction <strong>is_file()</strong> indique si le fichier est un véritable fichier. On lui passe le chemin du fichier supposé en argument. Si le fichier existe et que c’est bien un fichier régulier, alors is_file() renverra le booléen true, sinon false.</li>
        </ul>
    </p>
    <?php
        if(file_exists('./fichiers/fichier2.txt')){
            echo 'Le fichier "fichier2.txt" existe.</br>';
        } ;
        if(file_exists('./fichiers')){
            echo 'Le dossier "fichiers" existe.</br>';
        }
        if(file_exists('./fichier')){
            echo 'Le dossier "fichier" existe.</br>';
        } else {
            echo 'Le dossier "fichier" n\'existe pas.</br>';
        }
        if(!is_file('./fichiers')) {
            echo "La cible n'est pas un fichier.</br>";
        }
        echo 'On peut imbriquer les deux fonctions:</br>';
        if(file_exists('./fichiers/fichier2.txt')){
            if(is_file('./fichiers/fichier2.txt')){
                echo "L'item existe et est un fichier.</br>";
            } else {
                echo "L'item existe mais n'est pas un fichier.</br>";
            }
        } else {
            echo "L'item n'existe pas.</br>";
        }
        if(file_exists('./fichiers/fichier2.txt') && is_file('./fichiers/fichier2.txt')) {
            echo "Le fichier existe et est un véritable fichier.</br>";
        }
    ?>
    <h3>Renommer un fichier</h3>
    <p>La fonction <strong>rename()</strong> permet de renommer un fichier ou un dossier. On lui passe le nom d’origine du fichier ou du dossier et le nouveau nom en arguments. si le nom choisi est le nom d’un fichier existant, ce fichier sera écrasé et remplacé par le fichier renommé.</p>
    <h3>Effacer un fichier</h3>
    <p>La fonction <strong>unlink()</strong> permet d’effacer un fichier. On lui passe le chemin du fichier à effacer en argument. Cette fonction va retourner true si le fichier a bien été effacé ou false en cas d’erreur.</p>
    <h2>Introduction aux permissions des fichiers et au chmod</h2>
    <p>Sujet vaste et complexe que nous n’allons aborder qu'en surface et dans les grandes lignes afin de comprendre la relation avec les fichiers en PHP. Le système Linux (utilisés par la plupart des hébergeurs) <u>définit différents types d’utilisateurs</u> pouvant interagir avec les fichiers (et les dossiers):
        <ul>
            <li>Le propriétaire</li>
            <li>Les membres du groupe</li>
            <li>Les autres utilisateurs</li>
        </ul>
    Linux permet à plusieurs utilisateurs d’avoir accès au système en même temps et va permettre de définir des groupes d’utilisateurs.</br>
    Cependant, pour que le système fonctionne toujours bien, il a fallu définir différents niveaux de permission d’accès aux différents fichiers pour les différents utilisateurs.</br>
    <em>Pour pouvoir manipuler des fichiers (ou le contenu de dossiers), nous allons donc avant tout avoir besoin de permissions</em>. Différentes opérations (lecture du fichier, écriture, etc.) vont nécessiter différents <strong>niveaux</strong> de permission.</br>
    Lorsqu’on travaille en local et sur nos propres fichiers on n'a normalement pas besoin de permissions puisque par défaut le système attribue généralement les permissions maximales au propriétaire du fichier. Mais c'est différent sur un serveur distant car on doit donner un accès à certains fichiers pour les différents utilisateurs, et c’est là qu’il faut bien faire attention aux différentes permissions accordées.</br>
    Les permissions d’accès accordées pour un fichier (ou pour un dossier) à chaque groupe d’utilisateurs sont symbolisées par <u>3 chiffres allant de 0 à 7 ou par 3 lettres</u>.
        <ul>
            <li>Le premier caractère indique les <u>droits accordés au propriétaire</u> du fichier,</li>
            <li>le deuxième caractère indique les <u>droits accordés au groupe</u></li>
            <li>et le troisième caractère indique les <u>droits accordés aux autres utilisateurs</u>.</li>
        </ul>
    </p>
    <table>
        <thead>
            <td>DROITS</td>
            <td>VAL. ALPHANUM</td>
            <td>VAL NUMERIQUE  </td>
        </thead>
        <tr>
            <td>Aucun droit</td>
            <td>---</td>
            <td>0</td>
        </tr>
        <tr>
            <td>Exécution seulement</td>
            <td>--x</td>
            <td>1</td>
        </tr>
        <tr>
            <td>Ecriture seulement</td>
            <td>-w-</td>
            <td>2</td>
        </tr>
        <tr>
            <td>Ecriture et exécution</td>
            <td>-wx</td>
            <td>3</td>
        </tr>
        <tr>
            <td>Lecture seule</td>
            <td>r--</td>
            <td>4</td>
        </tr>
        <tr>
            <td>Lecture et exécution</td>
            <td>r-x</td>
            <td>5</td>
        </tr>
        <tr>
            <td>Lecture et écriture</td>
            <td>rw-</td>
            <td>6</td>
        </tr>
        <tr>
            <td>Tous les droits</td>
            <td>rwx</td>
            <td>7</td>
        </tr>
    </table>
    <p>Si un fichier (ou dossier) possède les permissions 754 par exemple, cela signifie qu’on accorde tous les droits sur les fichiers contenus dans ce dossier à l’auteur, des droits de lecture et d’exécution aux membres du groupe et des droits de lecture uniquement aux autres utilisateurs.</p>
    <h2>Vérifier et modifier les permissions d'un fichier</h2>
    <p>Pour vérifier les permissions d'un fichier/dossier, on va déjà pouvoir tout simplement effectuer un clic droit dessus et afficher les informations liées à celui-ci.</br>
    Pour vérifier les permissions d’un fichier via un script PHP, c’est-à-dire dynamiquement, on utilise fonction <strong>fileperms()</strong> qui renvoie les permissions pour un fichier.</br>
    Cette fonction va renvoyer les permissions d’un fichier sous forme numérique. On pourra ensuite convertir le résultat sous forme octale avec la fonction <strong>decoct()</strong> pour obtenir la représentation des permissions selon nos trois chiffres.</br>
    <strong>ATTENTION:</strong> fileperms() peut renvoyer des informations supplémentaires selon le système utilisé. <strong>Les trois derniers chiffres renvoyés correspondent aux permissions</strong>.</p>
    <p>On va également pouvoir utiliser les fonctions <u>is_readable() et is_writable()</u> qui vont respectivement déterminer si le fichier peut être lu et si on peut écrire dedans. Ces fonctions vont renvoyer true si c’est le cas ou false dans le cas contraire ce qui les rend très pratiques d’utilisation au sein d’une condition.</p>
        <?php
            var_dump(decoct((fileperms('./fichiers/fichier3.txt'))));
            if(is_readable('./fichiers/fichier3.txt')) {
                echo 'Le fichier est libre à l\'écriture.</br>';
            } else {
                echo 'Le fichier n\'est pas libre à l\'écriture.</br>';
            }
        ?>
    <p>Pour modifier les permissions d’un fichier, on utilise la fonction <strong>chmod()</strong> qui va prendre en arguments le fichier dont on souhaite modifier les permissions ainsi que les nouvelles permissions du fichier en notation octale (<strong>on placera un zéro devant nos trois chiffres</strong>).</br>
    Le réglage des permissions concernant les membres du groupe et les autres utilisateurs va être particulier à chaque cas selon votre site et la sensibilité des informations stockées: vos utilisateurs doivent ils pouvoir lire les fichiers? Les exécuter? Les modifier?</p>
    <?php
        var_dump(chmod('./fichiers/fichier3.txt', 0777));
        var_dump(decoct(fileperms('./fichiers/fichier3.txt'))); // réponse 100666 ???
    ?>
</body>
</html>