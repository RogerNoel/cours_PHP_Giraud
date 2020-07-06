<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les variables</title>
</head>
<body>
    <h1>Les variables</h1>
    <p>En PHP, les variables ne servent à stocker une information que temporairement. Plus précisément, une variable ne va exister que durant le temps de l’exécution du script l’utilisant.</p>
    <h2>Types de données PHP</h2>
    <ul>
        <li>String -> chaîne de caractères</li>
        <li>Integer -> nombre entier</li>
        <li>Float -> nombre décimal</li>
        <li>Boolean -> vrai/faux</li>
        <li>Array -> tableau</li>
        <li>Object -> objet</li>
        <li>NULL</li>
        <li>Resource</li>
    </ul>
    <p>La fonction <em>gettype()</em> renvoie le type d'une variable</p>
    <h3>Le type NULL</h3>
    <p>Il correspond à l'absence de valeur et sert à représenter des variables vides.</p>
    <?php
    $prenom;
    // var_dump($prenom);
    echo gettype($prenom);
    ?>
    <h3>Le type Resource</h3>
    <p>Variable qui contient une référence vers une ressource <strong>externe</strong> au PHP.</p>
    <h2>Opérateurs et concaténation</h2>
    <p>Dans cette leçon, nous allons nous concentrer sur les opérateurs arithmétiques, les opérateurs de chaines et les opérateurs d’affectation.</p>
    <h3>Les opérateurs de chaines et la concaténation en PHP</h3>
    <?php
        $machaine = "Le contenu de ma chaîne";
        echo "Avec des guillemets, la variable est interprétée: $machaine </br>";
        echo 'Avec des apostrophes, la variable $machaine fait juste partie de la chaîne affichée par echo'. "</br>";
        $prenom = "Roger";
        echo "je m'appelle {$prenom} et j'habite à Spa";
    ?>
    <p>Quand on utilise les guillemets, on préfèrera utiliser la méthode qui consiste  à utiliser des accolades pour entourer les variables, pour les mettre en évidence.</p>
    <h3>Les opérateurs arithmétiques</h3>
    <ul>
        <li>+ - * /</li>
        <li>% pour le modulo</li>
        <li>** pour l'exposant</li>
    </ul>
    <h4>Ordre de priorité des opérations</h4>
    <ol>
        <li>Élévation à la puissance</li>
        <li>Multiplication, division et modulo (tous au même niveau de priorité)</li>
        <li>Addition et soustraction (les deux au même niveau de priorité) </li>
    </ol>
    <?php
        $x = 2**3**2;
        echo "X vaut $x </br>";
        $x = 2**9;
        echo "X vaut $x </br>";
    ?>
    <p>Ainsi, si on écrit <em>$x = 1 – 2 – 3</em>, la variable $x va stocker la valeur -4 (les opérations se font de gauche à droite).</br>
    En revanche, si on écrit <em>$x = 2 ** 3 ** 2</em>, la variable $x stockera 512 qui correspond à 2 puissance 9 puisqu’on va commencer par calculer 3 ** 2 = 9 dans ce cas (les opérations se font de droite à gauche).</p>
    <p> <u>Nous pouvons forcer l’ordre de priorité</u>  en utilisant des couples de parenthèses pour indiquer qu’une opération doit se faire avant toutes les autres</p>
    <ul>
        <li>2 ** 3 - 4 * 4 / 8 =  6 car</li>
        <li>priorité exposant: 8 - 4 * 4 / 8 = 6 car</li>
        <li>réduction des * et des / dans n'importe quel ordre: 8 - 2 = 6</li>
    </ul>
    <p> <strong>Remarque:</strong>les opérateurs + et - peuvent également servir à convertir le type de valeur contenue dans une variable vers Integer ou Float selon ce qui est le plus approprié. </p>
    <h3>Les opérateurs d'affectation et opérateurs combinés</h3>
    <ul>
        <li>.= concatène puis affecte le résultat</li>
        <?php $prenom = "Roger"; $prenom .= " Noel"; echo $prenom;  ?>
        <li>+= additionne puis affecte le résultat</li>
        <?php $a = 10; $a += 3; echo $a;  ?>
        <li>-= soustrait puis affecte le résultat</li>
        <?php $a = 10; $a -= 3; echo $a;  ?>
        <li>*= multiplie puis affecte le résultat</li>
        <?php $a = 12; $a *= 3; echo $a;  ?>
        <li>/= divise puis affecte le résultat</li>
        <?php $a = 12; $a /= 3; echo $a;  ?>
        <li>%= calcule le modulo puis affecte le résultat</li>
        <?php $a = 10; $a %= 3; echo $a;  ?>
        <li>**= élève à la puissance puis affecte le résultat</li>
        <?php $a = 10; $a **= 3; echo $a;  ?>
    </ul>
</body>
</html>