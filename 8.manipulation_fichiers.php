<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manipulation de fichiers</title>
    <style>
        .operation { font-size: 15px; text-align: left; }
        tr td:first-child { font-size: 30px; }
        table {border-collapse: collapse;}
        td {border: 1px solid purple; text-align: center; padding: 5px; }
        thead { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Manipuler des fichiers en PHP</h1>
    <p>Nous allons apprendre à ouvrir et lire un fichier déjà existant ou à créer des fichiers de différents formats (fichiers texte, etc.) grâce aux fonctions PHP et à écrire des informations dedans.</br>
    Laa manipulation de fichiers est un sujet complexe et pour lequel les problématiques peuvent être très différentes et très précises. Nous allons présenter les cas de manipulation de fichiers les plus généraux et les fonctions communes liées.</p>
    <p>En PHP, nous allons pouvoir manipuler différents types de fichiers comme des fichiers texte (au format .txt) ou des fichiers image par exemple.</br>
    Nous allons particulièrement nous intéresser à la manipulation de fichiers texte puisque ce sont les fichiers qu’on manipule le plus souvent en pratique. Jusqu’à présent, nous n’avons appris à stocker des informations que de manière temporaire en utilisant les variables « classiques », les cookies ou les sessions. L’utilisation de fichiers en PHP va nous permettre entre autres de stocker de façon définitive des informations.</br>
    Les fichiers vont donc nous offrir une alternative aux bases de données mais on préférera dans la majorité des cas utiliser les bases de données plutôt que les fichiers pour enregistrer les données.</br>
    Il reste néanmoins intéressant d’apprendre à stocker des données dans des fichiers car on préfèrera <u>dans certains cas</u> stocker des données dans des fichiers plutôt que dans des bases de données. Par ailleurs, la manipulation de fichiers ne se limite pas au stockage de données : nous allons pouvoir effectuer toutes sortes d’opérations sur nos fichiers ce qui représente un avantage indéniable.</p>
    <h2>Lire un fichier PHP</h2>
    <p>L’une des opérations de base relative aux fichiers en PHP va tout simplement être de <strong>lire le contenu d’un fichier</strong>. Il existe deux façons de faire cela :
        <ul>
            <li>on peut soit lire le contenu d’un fichier morceau par morceau, chose que nous apprendrons à faire dans la prochaine leçon,</li>
            <li>soit lire un fichier entièrement c’est-à-dire afficher tout son contenu d’un coup.</li>
        </ul>
    Pour faire cela, on va pouvoir utiliser l’une des fonctions suivantes :
        <ul>
            <li>La fonction <strong>file_get_contents()</strong> qui va retourner le contenu du fichier dans une chaine de caractères qu’il faudra echo pour afficher ou la valeur booléenne false en cas d’erreur.</li>
            <li>La fonction <strong>file()</strong> est identique à la seule différence que le contenu du fichier sera renvoyé dans un tableau numéroté. Chaque ligne de notre fichier sera un nouvel élément de tableau.</li>
            <li>La fonction <strong>readfile ()</strong> va directement lire et afficher le contenu de notre fichier.</li>
        </ul>
    <u>On va devoir passer le chemin relatif menant au fichier qu’on souhaite lire en argument de chacune de ces fonctions.</u>
    Pour illustrer le fonctionnement de ces trois fonctions, créons un premier fichier de texte txt.</p>
    <?php
        echo '1. Utilisation de <em>file_get_contents()</em>: '. file_get_contents('texte.txt').'</br></br>';
        echo '2. Utilisation de <em>file()</em>: </br>';
        print_r(file('texte.txt'));
        echo '</br></br>3. Utilisation de <em>readfile()</em>: </br>';
        readfile('texte.txt');
    ?>
    <p>Nous avons utilisé les trois fonctions; comme on peut le voir, file_get_contents() (cas 1) et readfile() (cas 3) produisent un résultat similaire mais il faut echo le résultat renvoyé par file_get_contents() pour l’afficher tandis que readfile() affiche directement le résultat.</br>
    La fonction file_get_contents() nous donne donc davantage de contrôle sur la valeur renvoyée puisqu’on va pouvoir l’enfermer dans une variable pour la manipuler à loisir.</p>
    <h2>Conserver la mise en forme d'un fichier avant affichage</h2>
    <p>Dans l’exemple ci-dessus, <em>on s’aperçoit que les retours à la ligne et les sauts de ligne contenus dans notre fichier texte ne sont pas conservés</em> lors de l’affichage du texte dans le navigateur. Cela est normal puisque <u>nos fonctions vont renvoyer le texte tel quel sans y ajouter des éléments HTML indiquant de nouvelles lignes ou des sauts de ligne</u> et donc le navigateur va afficher le texte d’une traite.</br>
    Pour conserver la mise en forme du texte, on va pouvoir utiliser la fonction <strong>nl2br()</strong> qui va se charger d’ajouter des éléments <em>br</em> devant chaque nouvelle ligne de notre texte.</br>
    Nous allons pouvoir utiliser cette fonction <em>sur le résultat renvoyé par file_get_contents()</em> avant de l’afficher. En revanche, on ne va pas pouvoir l’utiliser avec readfile() puisque cette fonction va directement afficher le résultat sans que nous puissions exercer un quelconque contrôle dessus.</p>
    <?php
        echo 'Utilisation de nl2br(): </br>';
        echo nl2br(file_get_contents('texte.txt'));
    ?>
    <h2>Ouvrir, lire et fermer un fichier</h2>
    <p>Dans le chapitre précédent, nous avons appris à lire un fichier texte entièrement.</br>
    Dans ce chapitre, il s'agit de ne lire et ne récupérer qu’une partie d’un fichier.</p>
    <p>Pour lire un fichier partie par partie, il faut d'abord l’ouvrir.</br>
    Pour ouvrir un fichier en PHP, nous allons utiliser la fonction <strong>fopen()</strong>.</br>
    <strong>ATTENTION fopen() ne sert qu'à récupérer la ressource pour la mettre dans une variable afin de la manipuler ensuite.</strong>
    On va devoir passer le chemin relatif menant à notre fichier ainsi qu’un « mode » en arguments à cette fonction qui va alors retourner en cas de succès une <em>ressource de pointeur de fichier</em>, c’est-à-dire pour le dire <u>plus simplement une ressource qui va nous permettre de manipuler notre fichier.</u></p>
    <p>Le mode choisi en second argument détermine le type d’accès au fichier et donc les opérations qu’on va pouvoir effectuer sur le fichier. On va pouvoir choisir parmi les modes suivants :
        <ul>
            <li>r - pour ouverture en lecture seule</li>
            <li>r+ - ouverture en lecture et écriture</li>
            <li>a - ouvre un fichier en écriture seule en conservant les données existantes.Si le fichier n'existe pas, PHP tente de le créer.</li>
            <li>a+ - ouvre un fichier en lecture et écriture en conservant les données existantes. Si le fichier n'existe pas, PHP tente de le créer.</li>
            <li>w - ouverture en écriture seule. Si le fichier existe, les infos existantes seront supprimées, s'il n'existe pas, il sera créé.</li>
            <li>w+ - ouverture en lecture et écriture. Si le fichier existe, les infos existantes seront supprimées, s'il n'existe pas, il sera créé.</li>
            <li>x - créé un nouveau fichier accessible seulement en écriture. Retourne false erreur si le fichier existe déjà.</li>
            <li>x+ - créé un nouveau fichier accessible en lecture et en écriture. Retourne false erreur si le fichier existe déjà.</li>
            <li>c - ouvre un fichier pour écriture seulement. Si le fichier n'existe pas, il sera créé. S'il existe, les infos seront conservées.</li>
            <li>c+ - ouvre un fichier pour lecture et écriture. Si le fichier n'existe pas, il sera créé. S'il existe, les infos seront conservées.</li>
            <li>e - mode particulier et pas toujours disponible. On n'en parnera pas ici</li>
        </ul>
        <strong>Notez</strong> par ailleurs qu’<u>on ajoutera généralement la lettre b au paramètre « mode » de fopen()</u>. Cela permet une meilleure compatibilité et évite les erreurs pour les systèmes qui différencient les fichiers textes et binaires comme Windows par exemple.
    </p>
    <h2>Lire un fichier partie par partie</h2>
    <p>Voici 3 des fonctions qu'on peut utiliser:
        <ul>
            <li> <strong>fread()</strong> </li>
            <li> <strong>fgets()</strong> </li>
            <li> <strong>fgetc()</strong> </li>
        </ul>
    </p>
    <h3>Utilisation de fread()</h3>
    <p>On commence par utiliser fopen() pour récupérer la ressource renvoyée par la fonction dans une variable.</br>
    On passe ensuite le contenu de notre variable à fread() et on lui demande de lire les 15 premiers caractères.</br>
    Si on veut lire tout le fichier, il faut connaître le nombre de caractères qu'il contient, mais on ne le sait pas... la fonction filesize(), qu'on utilisera à la place d'un nombre de caractères, calculera la taille exacte du fichier.</p>
    <?php
        $recuperationDuFichier = fopen('./fichiers/unFichierTexte.txt', 'rb');
        echo 'Récupération des 15 premiers caractères: '. fread($recuperationDuFichier, 15); // second argument = nombre de caractères à afficher
    ?>
    <?php
        $ressource = fopen('./fichiers/unFichierTexte.txt', 'rb');
        echo '</br>Lecture de tout le fichier avec la fonction filesize()</br>';
        echo fread($ressource, filesize('./fichiers/unFichierTexte.txt'));
    ?>
    <h3>Utilisation de fgets()</h3>
    <p>La fonction fgets() va nous permettre de <u>lire un fichier ligne par ligne</u>. On va passer le résultat renvoyé par fopen() en argument de fgets() et à <strong>chaque nouvel appel de la fonction</strong>, une nouvelle ligne du fichier va pouvoir être lue.</br>
    On peut également préciser de manière facultative un nombre en deuxième argument de fgets() qui représentera un nombre d’octets. La fonction lira alors:
        <ul>
            <li>soit le nombre d’octets précisé,</li>
            <li>soit jusqu’à la fin du fichier,</li>
            <li>soit jusqu’à arriver à une nouvelle ligne</li>
            <li>(le premier des trois cas qui va se présenter).</li>
        </ul>
    Si aucun nombre n’est précisé, fgets() lira jusqu’à la fin de la ligne.</p>
    <?php
    echo 'fgets() va lire le texte ligne par ligne, à chaque appel de la fonction: </br>';
        $ressourceTexte = fopen('texte.txt', 'rb');
        echo 'Ligne 1: '.fgets($ressourceTexte).'</br>';
        echo 'Ligne 2: '.fgets($ressourceTexte).'</br>';
        echo 'Ligne 3: '.fgets($ressourceTexte).'</br>';
        echo 'Ligne 4: '.fgets($ressourceTexte).'</br>';
    ?>
    <h3>Utilisation de fgetc()</h3>
    <p>Cette fonction permet de lire un fichier caractère par caractère, par exemple pour récupérer un caractère en particulier ou pour arrêter la lecture lorsqu’on arrive à un certain caractère.</br>
    fgetc() s’utilise exactement comme fgets(), et chaque nouvel appel à la fonction va nous permettre de lire un nouveau caractère de notre fichier. Notez que les espaces sont bien entendus considérés comme des caractères.</p>
    <?php
        echo 'Utilisation de fgetc() qui permet à chaque appel, de récupérer les caractères un par un: </br>';
        $ressourceTexte = fopen('texte.txt', 'rb');
        echo 'Premier appel: '. fgetc($ressourceTexte).'</br>';
        echo 'Second appel: '. fgetc($ressourceTexte).'</br>';
        echo 'Troisième appel: '. fgetc($ressourceTexte).'</br>';
        echo 'Quatrième appel: '. fgetc($ressourceTexte).'</br>';
    ?>
    <h2>Trouver la fin d'un fichier de taille inconnue</h2>
    <p>En pratique, cependant, nous utiliserons généralement les fichiers pour stocker des informations non connues à l’avance. Il sera donc impossible de prévoir la taille de ces fichiers et on risque donc de ne pas pouvoir utiliser les fonctions fgets() et fgetc() de manière optimale.</p>
    <p>Il existe plusieurs moyens de déterminer la taille ou la fin d’un fichier.</br>
    La fonction filesize(), par exemple, va lire la taille d’un fichier.</br>
    Dans le cas présent, cependant, nous cherchons plutôt à <u>déterminer où se situe la fin d’un fichier</u> (ce qui n’est pas forcément équivalent à la taille d’un fichier à cause de la place du curseur, notion que nous allons voir en détail par la suite).</p>
    <p>La fonction PHP <strong>feof()</strong> (« end of the file ») va nous permettre de savoir si la fin d’un fichier a été atteinte ou pas. <em>Dès que la fin d’un fichier est atteinte, cette fonction va renvoyer la valeur true. Avant cela, elle renverra la valeur false.</em>On va donc pouvoir utiliser cette fonction pour boucler dans un fichier de taille inconnue.</p>
    <?php
        $newResource = fopen('texte.txt', 'rb');
        while(feof($newResource)==false){
            $ligne = fgets($newResource); //fgets() pour récupérer ligne par ligne
            echo 'La ligne: "'. $ligne . '" contient ' . strlen($ligne) . ' caractères.</br>';
        }
    ?>
    <p><strong>Note:</strong> le retour à la ligne compte comme un caractère et fgets() s'arrête après ce passage à la ligne. C'est la raison pour laquelle on compte un caractère de plus que ce qu'on peut s'attendre, sauf la dernière évidemment</p>
    <h2>La place du curseur interne ou pointeur de fichier</h2>
    <p>La position du curseur (ou « pointeur de fichier ») va impacter le résultat de la plupart des manipulations qu’on va pouvoir effectuer sur les fichiers.</br>
    Il est donc essentiel de toujours savoir où se situe ce pointeur et également de savoir comment le bouger.</p>
    <p>Le curseur ou pointeur est l’endroit dans un fichier <u>à partir duquel</u> une opération va être faite. Pour donner un exemple concret, le curseur dans un document Word correspond à la barre clignotante.</p>
    <p>Ce curseur indique l’emplacement à partir duquel vous allez écrire votre requête ou supprimer un caractère, etc. Le curseur dans les fichiers va être exactement la même chose à la différence qu’ici on ne peut pas le voir concrètement.</p>
    <table>
        <thead>
            <td>Mode utilisé</td>
            <td>Opération</td>
            <td>Position du pointeur de fichier</td>
        </thead>
        <tbody>
            <tr>
                <td>r/r+</td>
                <td class="operation" >ouverture en lecture seule/ouverture en lecture et écriture</td>
                <td>au début du fichier</td>
            </tr>
            <tr>
                <td>a/a+</td>
                <td class="operation" >ouvre un fichier en écriture seule/lecture en conservant les données existantes.</td>
                <td>à la fin du fichier</td>
            </tr>
            <tr>
                <td>w/w+</td>
                <td class="operation" >ouverture en écriture seule/écriture. Si le fichier existe, les infos existantes seront supprimées.</td>
                <td>au début du fichier</td>
            </tr>
            <tr>
                <td>x/x+</td>
                <td class="operation" >créé un nouveau fichier accessible seulement en écriture/lecture et écriture. Retourne false erreur si le fichier existe déjà.</td>
                <td>au début du fichier</td>
            </tr>
            <tr>
                <td>c/c+</td>
                <td class="operation" >ouvre un fichier pour écriture seulement/lecture et écriture. Si le fichier n'existe pas, il sera créé. S'il existe, les infos seront conservées.</td>
                <td>au début du fichier</td>
            </tr>
        </tbody>
    </table>
    <p>Ensuite, vous devez également savoir que <u>certaines fonctions vont modifier la place du curseur à chaque exécution</u>: cela va par exemple être le cas des fonctions fgets() et fgetc() qui servent à lire un fichier ligne par ligne ou caractère par caractère. En effet, la première fois qu’on appelle fgets() par exemple, le pointeur est généralement au début de notre fichier et c’est donc la première ligne de notre fichier est lue par défaut. Cependant, lors du deuxième appel à cette fonction, c’est bien la deuxième ligne de notre fichier qui va être lue.</br>
    Ce comportement est justement dû au fait que la fonction fgets() déplace le pointeur de fichier du début de la première ligne au début de la seconde ligne dans ce cas précis.</br>
    <strong>Pour savoir où se situe notre pointeur de fichier</strong>, on peut utiliser la fonction <strong>ftell()</strong> qui renvoie la position courante du pointeur. Nous allons devoir lui passer la valeur renvoyée par fopen() pour qu’elle fonctionne correctement.</p>
    <?php
        $ressource2 = fopen('texte.txt', 'rb');
        echo 'Le pointeur se trouve en position '. ftell($ressource2).'</br>';
        echo "</br>Test avec fgets()</br>";
        $i = 1;
        while(feof($ressource2)==false) {
            echo "Ligne n° " . $i . "</br>";
            echo 'Le curseur se trouve en position ' . ftell($ressource2).'</br>';
            $ligne = fgets($ressource2);
            $i++;
        }
    ?>
    <h3>Déplacer le curseur manuellement</h3>
    <p>Pour commencer la lecture d’un fichier à partir d’un certain point, ou pour écrire dans un fichier à partir d’un endroit précis ou pour toute autre manipulation de ce type, <em>nous allons avoir besoin de contrôler la position du curseur</em>. Pour cela, nous allons pouvoir utiliser la fonction <strong>fseek()</strong>.</br>
    Cette fonction va prendre en arguments
        <ul>
            <li>l’information renvoyée par fopen()</li>
            <li>un nombre correspondant à la nouvelle position en octets du pointeur.</li>
        </ul>
    La nouvelle position du pointeur sera par défaut calculée par rapport au début du fichier.</br>
    Pour modifier ce comportement et <em>faire en sorte que le nombre passé s’ajoute à la position courante du curseur, on peut ajouter la constante SEEK_CUR en troisième argument de fseek()</em>.</br>
    Notez cependant que si vous utilisez les modes a et a+ pour ouvrir votre fichier, utiliser la fonction fseek() ne produira aucun effet et votre curseur se placera toujours en fin de fichier.</p>
    <?php
        $ressource = fopen('texte.txt', 'rb');
        echo 'Rappel: ftell($ressource) renvoie la position du curseur.</br>';
        echo 'Le pointeur est au début du fichier, en position ' . ftell($ressource) . '.</br>'; // retourne 0
        echo 'Rappel: fgetc() lit caractère par caractère à chaque appel.</br>';
        echo 'La caractère <em>(ftell($res)+1)</em>: ' . (ftell($ressource)+1) . ' est un <em>fgetc($res)</em> ' . fgetc($ressource) . '.</br>'; // retourne 1 et 1
        echo 'Rappel fseek() positionne le curseur.</br>';
        echo 'On code <em>fseek($res, 20)</em>.</br>';
        fseek($ressource, 20);
        echo 'Le curseur se trouve donc maintenant en position ' . ftell($ressource) . '.</br>'; // retourne 20
        echo (ftell($ressource)+1) . ' = ' . fgetc($ressource) . '</br>';
        echo 'Utilisation de <em>SEEK_CUR</em> pour ajouter 40 à la position courante: <em>fseek($res, 40, SEEK_CUR)</em>.</br>';
        fseek($ressource, 40, SEEK_CUR);
        echo 'Le caractère ' . (ftell($ressource)+1) . ' est un ' . fgetc($ressource) . '.</br>';
        echo 'Le caractère ' . (ftell($ressource)+1) . ' est un ' . fgetc($ressource) . '.</br>';
        echo 'Le caractère ' . (ftell($ressource)+1) . ' est un ' . fgetc($ressource) . '.</br>';
        echo 'Le caractère ' . (ftell($ressource)+1) . ' est un ' . fgetc($ressource) . '.</br>';
    ?>
    <h2>Fermer un fichier</h2>
    <p>Pour fermer un fichier en PHP, nous utiliserons la fonction <strong>fclose()</strong>.On va une nouvelle fois passer le résultat renvoyé par fopen() en argument de cette fonction. Notez que la fermeture d’un fichier n’est pas strictement obligatoire. Cependant, cela est considéré comme une bonne pratique : cela évite d’user inutilement les ressources de votre serveur.</p>
    <?php
        $ressource = fopen('texte.txt', 'rb');
        fclose($ressource);
    ?>
    233
</body>
</html>