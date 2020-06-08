<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les fonctions</title>
    <style>
        h1 {color: red;}
        h2 {color: blue;}
        h3 {color: purple;}
        h4 {color: brown;}
    </style>
</head>
<body>
    <h1>Introduction aux fonctions</h1>

    <h2>Définition des fonctions et fonctions internes</h2>
    <p>Série cohérente d’instructions créées pour effectuer une tâche précise. Pour exécuter le code contenu dans une fonction, il va falloir appeler la fonction.</p>
    <p>Les fonctions prêtes à l’emploi: il en existe plus de 1000 qui vont couvrir quasiment tous nos besoins.</p>

    <h2>Les fonctions définies par l'utilisateur</h2>
    <p>Pour déclarer une fonction, il faut écrire le mot clef <strong>function</strong>  puis préciser le nom de la fonction, ouvrir un couple de parenthèses et coder les instructions entre accolades</p>
    <p> <strong>Important:</strong> le nom des fonctions est <u>INSENSIBLE</u>  à la casse: si on créé une fonction nommée "bonjour()", la notation "bonJOUR()" fera référence à la même fonction.</p>
    <?php
        function hello() {
            echo "Salut à tous!</br>";
        }
        hello();
    ?>

    <h2>Les paramètres et arguments</h2>
    <p>Quelles différences entre un paramètre et un argument ?</br>
    On parlera de <u>paramètre</u>  lors de la <u>définition</u>  d’une fonction.</br>
    Un <strong>argument correspond à la valeur effective</strong> passée à une fonction.</p>
    <?php
        $prenom = "Roger";
        $ville = "Spa";
        function presentation($arg1, $arg2) {
            echo "je m'appelle $arg1 et j'habite $arg2";
        }
        presentation($prenom, $ville);
    ?>

    <h2>Contrôler le passage des arguments</h2>
    <h3>Passer des arguments par référence</h3>
    <p>Lorsqu’on passe une variable comme argument par valeur à une fonction, le fait de
modifier la valeur de la variable <strong>à l’intérieur</strong> <u>de la fonction</u>  NE VA PAS MODIFIER sa valeur <strong>à l’extérieur</strong> <u>de la fonction</u> .</p>
    <?php
        $a = 10;
        function interieur($parametre) {
            $parametre+= 1;
            echo '$a ' . " dans la fonction vaut $parametre.</br>";
        }
        interieur($a);
        echo '$a ' . " vaut toujours $a hors de la fonction. </br>";
    ?>
    <p>On <u>voudra parfois que nos fonctions puissent modifier la valeur des variables qu’on leur passe en argument</u> . </br>
    Pour cela, <strong>il va falloir passer ces arguments par référence.</strong></br>
    Pour indiquer qu’on souhaite passer un argument par référence à une fonction, <strong>il suffit d’ajouter le signe &</strong>  devant le paramètre en question <u>dans <strong>LA DEFINITION (donc au moment où on créé la fonction)</strong> des paramètres de la fonction</u>.</p>
    <?php
        $b = 0;
        function reference(&$parametre) {
            $parametre+= 1;
            echo '$b ' . " dans la fonction vaut $parametre.</br>";
        }
        reference($b);
        echo '$b ' . " vaut maintenant aussi $b hors de la fonction. </br>";
    ?>

    <h2>Définir des valeurs par défaut pour les paramètres</h2>
    <p>Cette valeur sera utilisée si aucun argument n’est fourni lors de l’appel de
la fonction.</br>
    <strong>Remarque</strong>: la valeur par défaut doit obligatoirement être une <u>CONSTANTE</u> et non une variable.</p>
    <p>Notez également que
        <ul>
            <li>si on définit une fonction avec plusieurs paramètres</li>
            <li>et qu’on choisit de donner des valeurs par défaut à seulement certains d’entre eux,</li>
        </ul>
    alors <u>il faudra placer les paramètres qui ont une valeur par défaut après</u>  ceux qui n’en possèdent pas dans la définition de la fonction.</br>
    Dans le cas contraire, le PHP renverra une erreur et notre fonction ne pourra pas être exécutée.</p>
    <?php
        function bonjour($prenom, $role='abonné') {
            echo "bonjour $prenom, vous êtes un $role.</br>";
        }
        bonjour("Roger");
        bonjour("Tom", "admin");

        function bonjour2($prenom, $role='abonné', $ville='non mentionné') {
            echo "bonjour $prenom, vous êtes un $role de $ville.</br>";
        }
        bonjour2("Roger");
        bonjour2("Tom", "rédacteur");
        bonjour2("Jean", "visiteur", "Spa");
        echo "<strong>Attention</strong> à l'ordre des arguments qu'on passe ! </br>";
        bonjour2("Jean", "Spa", "visiteur");
    ?>

    <h2>Créer des fonctions avec un nombre de paramètres variables</h2>
    <p>Rappel: On parlera de <strong>paramètre</strong> lors de la <strong>définition d’une fonction</strong>.</br>
    Un <u>argument</u> correspond à la <u>valeur effective</u> passée à une fonction.</p>
    <p>Nous allons encore pouvoir définir des fonctions qui vont pouvoir accepter un nombre variable d’arguments en valeurs. Pour cela, il suffit d’ajouter <em> <strong>…</strong></em> avant la liste des paramètres dans la définition de la fonction pour indiquer que la fonction pourra recevoir un nombre d’arguments variable.</p>
    <p>Cette syntaxe va créer un tableau avec nos différents arguments.</br>
    Il faudra donc utiliser une <strong>boucle foreach</strong> pour parcourir ce tableau.</p>
    <?php
        function bonjouratous(...$items){
            foreach($items as $item){
                echo "bonjour $item</br>";
            }
        }
        bonjouratous('Roger', 'Nath', 'Dom');
    ?>

    <h3>PHP est un langage au typage faible</h3>
    <p>Cela signifie de manière concrète <em>qu’on n’a pas besoin de spécifier le type de données attendues</em> lorsqu’on définit des paramètres pour une fonction car le PHP va déterminer lui-même le type des données passées à notre fonction en fonction de leur valeur.</br>
    Une conséquence de cela est qu’il va être possible de passer des arguments qui n’ont
    aucun sens à une fonction sans déclencher d’erreur. On va par exemple pouvoir parfaitement passer deux chaînes de caractères à une fonction addition() qui nécessite des valeurs de type nombre.</p>

    <h4>Le typage des arguments</h4>
    <p>Depuis sa dernière version majeure (PHP7), le PHP offre la possibilité de préciser le type de données attendues lorsqu’on définit une fonction. Si une donnée
    passée ne correspond pas au type attendu, le <strong>PHP essaiera de la convertir dans le bon type</strong> et <u>s’il n’y arrive pas une erreur sera cette fois-ci renvoyée</u>. Cela va permettre à nos fonctions de ne s’exécuter que si les valeurs passées en argument sont valides et donc d’obtenir toujours un résultat cohérent par rapport à nos attentes.</p>
    <p>Les types:
        <ul>
            <li>string</li>
            <li>int</li>
            <li>float</li>
            <li>bool</li>
            <li>array</li>
            <li>iterable (l'argument passé doit être de type array ou une instance de l'interface "Traversable", c'est-à-dire une interface permettant de détecter si une classe peut-être parcourue en utilisant foreach() )</li>
            <li>callable (l'argument passé doit être du type "callable" (soit une fonction de rappel))</li>
            <li>nom de classe/d'interface (l'argument passé doit être une instance de la classe ou de l'interface donnée)</li>
            <li>self (l'argument passé doit être une instance de la même classe qui a défini la méthode)</li>
            <li>object</li>
        </ul>
    Certains types inconnus seront développés plus tard.
    </p>
    <h5>Concrètement</h5>
    <?php
        function testtypes($a, $b){
            echo 'Sans typage: ' .$a. ' + ' .$b. ' = ' .($a+$b). '</br>';
        }

        function additiontypes(float $a, float $b){
            echo 'Avec typage "float": ' .$a. ' + ' .$b. ' = ' .($a+$b). '</br>';
        }

        testtypes(3, 4); // 3+4=7
        additiontypes(3, 4); // 3+4=7
        
        testtypes(3, "4Pierre"); // 3+4Pierre = 7 (4Pierre est converti en 4)
        additiontypes(3, "4Pierre"); // 3+4=7 (4Pierre est converti en 4)

        testtypes(3, "Pierre"); // 3+Pierre=3 (Pierre est converti en 0)
        echo " additiontypes(3, \"Pierre\");  fait planter le script</br>";

        testtypes(3, 4.5); // 3+4.5=7.5
        additiontypes(3, 4.5); // 3+4.5=7.5
        additiontypes(3.2, 4.5); // 3.2+4.5=7.7
    ?>
    <p>Dans les exemples, l’utilisation de l’opérateur arithmétique + fait que PHP va convertir les valeurs à gauche et à droite de l’opérateur en nombres. Si le PHP doit convertir une chaine de caractères, il va regarder si un nombre se situe au début de celle-ci. Si c’est le cas, il conserve le nombre. Sinon, la chaine sera évaluée à 0.</br>
    Notre deuxième fonction utilise le typage : on demande que les arguments fournis soient de type float (nombres décimaux). Ici, si le PHP n’arrive pas à convertir les arguments passés vers le type attendu, une erreur va être retournée.</p>

    <h4>Le typage strict</h4>
    <p>Il est possible d'<strong>activer un typage strict pour nos fonctions</strong>. En
utilisant le mode strict, les fonctions ne vont plus accepter que des arguments dont le type <u>correspond exactement au type demandé dans leur définition</u>.</br>
<strong>Remarque:</strong> Notez ici que l’ensemble des nombres entiers fait partie de l’ensemble des nombres décimaux: si on passe un nombre entier en argument d’une fonction qui attend un nombre décimal, la fonction s’exécutera normalement même avec le mode strict activé.</p>
    <p> Pour activer le typage strict, nous allons utiliser la structure de contrôle <em><strong>declare</strong></em> qui sert à ajouter des directives d’exécution dans un bloc de code.</br>
    Nous allons pouvoir passer trois directives différentes à <em>declare</em> :
        <ul>
            <li>la directive <em>ticks</em></li>
            <li>la directive <em>encoding</em></li>
            <li>celle qui nous intéresse ici: la directive <em><strong>strict_types</strong></em></li>
        </ul>
    </p>
    <p>Pour activer le mode strict, il faut écrire <strong>declare(strict_types= 1);</strong> entre des balises PHP <u>dès la première déclaration de notre fichier, ligne 1</u>.</p>
    <p><strong>Attention:</strong> le typage strict ne va s’appliquer que s’il est activé dans le fichier <u>depuis lequel la fonction est appelée</u>. Ainsi, si vous définissez une fonction dans un premier fichier qui possède le typage strict activé puis que vous appelez cette fonction dans un autre fichier qui ne possède pas le typage strict activé, le typage strict ne s’appliquera pas. </p>
    <p><em>Notez également que le typage strict ne s’applique que pour les déclarations de type scalaire, c’est-à-dire pour les types <u>string, int, float et bool</u>.</em></p>

    <h2>Contrôler les valeurs de retour d'une fonction</h2>
    <h3>Avantages et spécificités de l'instruction return</h3>
    <p>La structure de contrôle return permet de demander à une fonction de retourner un résultat qu’on va ensuite pouvoir stocker dans une variable ou autre pour le manipuler.</p>
    <?php
        function carre($a, $b){
            return $a**$b."</br>";
        }
        echo carre(2, 3);
    ?>
    <p>Avec <em>return</em> aucun résultat ne s’affiche: le résultat a bien été calculé et a bien été retourné, mais il attend qu’on en fasse quelque chose.</p>

    <h4>La déclaration des types de valeurs de retour</h4>
    <p>Depuis PHP7, nous pouvons -de façon similaire à la déclaration de type des arguments- pouvoir déclarer les types de retour.</br>
    On pourra utiliser les mêmes types que les types pour les arguments vus dans la leçon précédente.</p>
    <p><strong>Remarque:</strong> le typage strict <u>affecte également</u> les types de retour : si celui-ci est activé, la valeur retournée doit être du type attendu. Dans le cas contraire, une exception sera levée par le PHP.</p>
    <p>La syntaxe sera, par exemple la suivante: </br>
    function mafonction($a, $b)<strong><u>: int</u></strong>{code avec un return}</p>
    <p>Dans le cas où le typage strict n’est pas activé (qui est le cas par défaut), si les valeurs retournées ne sont pas du type attendu alors elles seront transtypées, ce qui signifie que PHP va essayer de transformer leur type pour qu’il corresponde au type attendu.</p>

    <h2>La portée des variables</h2>
    <h3>Définition: la portée des variables en PHP</h3>
    <p>En PHP, on peut déclarer des variables n’importe où dans notre script : au début
du script, à l’intérieur de boucles, au sein de nos fonctions, etc...</br>
L’idée principale à retenir ici est <u>que l’endroit dans le script où on déclare une variable va déterminer l’endroit où cette variable sera disponible.</u></br>
La <strong>« portée »</strong> d’une variable désigne justement la partie du script où la variable sera accessible.</br>
    Les variables peuvent avoir deux portées différentes:
        <ul>
            <li>portée globale: pour toute variable définie en dehors d'une fonction. </br>Cette variable sera accessible partout sauf dans les espaces locaux d'un script.</li>
            <li>portée locale: toute variable définie à l'intérieur d'une fonction aura une portée locale à cette fonction et sera détruite à la fin de l'exécution de cette fonction.</li>
        </ul>
    </p>
    <?php
        $x = 10;
        echo "La variable ".'$x globale vaut '.$x.'</br>';
        function portee1(){
            echo "La variable globale ".'$x appelée depuis une fonction: '.$x."</br>";
        }
        portee1();
        function portee2(){
            $x = 5;
            echo 'La variable $x déclarée dans une fonction y est disponible: $x vaut '.$x.'</br>';
        }
        portee2();
        function portee3(){
            $y = 0;
            $y++;
            echo 'La variable $y déclarée dans la fonction y est traitée et est détruite à la fin de cette fonction: $y vaut '.$y.'</br>';
        }
        portee3();
        echo "Si on rappelle la même fonction, la variable locale ".'$y sera réinitialisée.</br>';
        portee3();
        function portee4(){
            echo 'On déclare une variable locale $z et on lui attribue la valeur 1.</br>';
            $z = 1;
        }
        portee4();
        echo 'On essaye d\'appeler cette variable $z en dehors de la fonction: $z vaut: '.$z.'</br>';
    ?>

    <h4>Accéder à une <u>variable globale</u> depuis un espace local</h4>
    <p>Parfois, nous voudrons nous servir de variables possédant une portée globale (<em>c’est-à-dire définies en dehors d’une fonction</em>) à l’intérieur d’une fonction.</br>
    Pour cela, <strong>on utilise le mot clef global</strong> <u>avant la déclaration des variables qu’on souhaite utiliser dans notre fonction</u>. </br>
    Cela va nous permettre d’indiquer que les variables déclarées dans la fonction sont en fait nos variables globales.</p>
    <?php
        $x = 5;
        function portee5(){
            global $x;
            echo 'La valeur de $x globale est: '.$x.'</br>';
            $x++;
        }
        portee5();
        echo '$x contient maintenant '.$x.'</br>';
    ?>
    <p> <strong>Remarque:</strong> pour accéder localement à des variables globales, on peut aussi utiliser la variable <em>superglobale</em> <strong>$GLOBALS</strong>.</p>

    <h4>Accéder depuis l'espace global à une variable définie localement</h4>
    <p><u>Il n’y a aucun moyen d’accéder à une variable définie localement depuis l’espace global.</u></br>
    Cependant, on va tout de même pouvoir récupérer la valeur finale d’une variable définie
localement et la stocker dans une nouvelle variable globale en utilisant l’instruction return.</p>

    <h2>Le mot clé "static"</h2>
    <p><strong>Une variable définie localement va être détruite dès la fin de l’exécution de la fonction dans laquelle elle a été définie.</strong></br>
    <u>Parfois, nous voudrons pouvoir conserver la valeur</u> finale d’une variable locale pour pouvoir s’en resservir <u> <em>lors d’un prochain appel à la fonction</em> </u> . Cela va notamment être le cas pour des fonctions dont le but va être de compter quelque chose. </p>
    <p>Pour qu’une fonction de « souvienne » de la dernière valeur d’une variable définie dans la fonction, nous allons pouvoir utiliser le mot clef <em>static</em> devant la déclaration initiale de la variable: <em>static $x = 0;</em></br>
    La portée de la variable sera toujours locale, mais la variable ne sera pas détruite lors de la fin de l’exécution de la fonction mais plutôt conservée pour pouvoir être réutilisée lors d’une prochaine exécution.</br>
    <em>Notez par ailleurs que lorsque nous initialisons une variable en utilisant static, la variable ne sera initialisée que lors du premier appel de la fonction (si ce n’était pas le cas, le mot clef static n’aurait pas grand intérêt).</em></p>
    <?php
        function comptage(){
            static $compteur = 0;
            echo "Le compteur est à $compteur.</br>";
            $compteur++;
        }
        comptage();
        comptage();
    ?>

    <h2>Les constantes et constantes magiques PHP</h2>
    <h3>Définitions des constantes PHP</h3>
    <p>Les constantes, tout comme les variables, vont donc être des conteneurs qui vont nous servir à stocker une valeur.</p>
    <p>Cependant, à la différence des variables, <strong>la valeur stockée dans une constante ne va pas pouvoir être modifiée</strong> (sauf dans le cas des constantes magiques dont nous allons reparler plus tard).</br>
    Notez également que <u>les constantes vont par défaut être toutes accessibles dans tout le script</u> : on va pouvoir les définir n’importe où dans le script et pouvoir y accéder depuis n’importe quel autre endroit du script.</br>
    Notez de plus que par convention, <strong>les constantes seront toujours écrites en majuscules</strong> pour bien les différencier des autres objets du langage PHP.</p>

    <h3>Créer ou définir une constante</h3>
    <p>Pour définir une constante en PHP, nous allons pouvoir utiliser
        <ul>
            <li>la fonction define(): <em>define('NOMCONSTANTE', 'valeur');</em> </li>
            <li>ou le mot clef const (uniquement pour les données type str, int, float, bool et array).</li>
        </ul>
    pour les utiliser, il ne faudra pas préfixer avec le signe $.
    </p>
    <?php
        define('PATRONYME', 'Noel');
        echo "Généalogie ".PATRONYME.'</br>';
        function genea(){
            echo 'Généalogie des '.PATRONYME.'</br>'; // constante accessible partout
        }
        genea();
    ?>

    <h4>Les constantes prédéfinies et les constantes magiques</h4>
    <p>Le PHP fournit également un certain nombre de constantes prédéfinies qui vont
généralement nous donner des informations de type « meta » (par ex. version de PHP).</br>
Ces constantes prédéfinies ne vont pas toujours être toutes disponibles car certaines sont
définies par des extensions PHP. Une extension PHP est une librairie (un ensemble de
feuilles de codes) qui permettent d’ajouter des fonctionnalités au PHP de base.</br>
Parmi ces constantes prédéfinies, il y en a neuf qui vont retenir notre attention et qu’on
appelle des <em>constantes « magiques »</em>.</br>
Ces constantes se distinguent des autres puisque leur valeur va changer en fonction de l’endroit dans le script où elles vont être utilisées.</p>
<p>Les constantes magiques sont reconnaissables par le fait que <u>leur nom commence par
deux underscores et se termine de la même manière</u> (excepté pour une). </br>
Ce sont les suivantes :
    <ul>
        <li>__FILE__ : contient le chemin et le nom du fichier</li>
        <li>__DIR__ : contient le nom du dossier dans lequel le fichier se trouve</li>
        <li>__LINE__ : contient le n° de le ligne courante</li>
        <li>__FUNCTION__ : contient le nom de la fonction actuellement définie ou {closure} pour les fonctions anonymes</li>
        <li>__CLASS__ : contient le nom de la classe actuellement définie</li>
        <li>__METHOD__ : contient le nom de la méthode actuellement utilisée</li>
        <li>__NAMESPACE__ : contient le nom de l'espace de noms courant</li>
        <li>__TRAIT__ : contient le nom du trait (?)</li>
        <li>ClassName::class : contient le nom entièrement qualifié de classe (?)</li>
    </ul>
Pour le moment, on va se concentrer sur les quatre premières.
</p>
<?php
    echo 'Numéro de ligne '.__LINE__.'</br>';
    echo 'Chemin complet du fichier: '.__FILE__.'</br>';
    echo 'Dossier conteneur: '.__DIR__.'</br>';
    function roger(){
        echo 'Nom de la fonction appelée: '. __FUNCTION__.'</br>';
    }
    roger();
?>

</body>
</html>