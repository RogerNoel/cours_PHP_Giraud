<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Structures de contrôle</title>
    <style>
        td {border: 1px solid black; border-collapse: collapse; text-align: center; padding: 5px; }
    </style>
</head>
<body>
    <h1>Les structures de contrôle</h1>
    <p>Opérateurs de comparaison</p>
    <ul>
        <li>==</li>
        <li>===</li>
        <li>!=</li>
        <li>!==</li>
        <li><></li>
        <li>< et ></li>
        <li></li>
        <li><= et =></li>
    </ul>
    <h2>3 nouveaux opérateurs</h2>
    <ul>
        <li>
            <strong>Spaceship <=></strong>  qui va comparer deux opérandes et renvoyer
            <ul>
                <li>0 s'ils sont égaux</li>
                <li>-1 si celui de gauche est plus petit</li>
                <li>1 si l'opérande de gauche est plus grand</li>
            </ul>

        </li>
        <li>
            <strong>Fusion null ??</strong>  pour comparer deux variables, va renvoyer
            <ul>
                <li>La valeur de l'opérande de droite si la valeur de l'opérande de gauche est NULL</li>
                <li>la valeur de l'opérande de gauche dans tous les autres cas</li>
            </ul>
        </li>
        <li> <strong>L'opérateur ternaire ?:</strong> </li>
    </ul>
    <h2>Les conditions</h2>
    <?php
        $permission = true;
        if ($permission){
            echo "permission accordée, une seule fois </br>";
            $permission = false;
        } else {
            echo "permission denied </br>";
        }
        if ($permission){
            echo "permission accordée, une seule fois </br>";
            $permission = false;
        } else {
            echo "permission denied </br>";
        }
        $nombre = 5;
        if ($nombre == 1) {
            echo "nombre vaut 1 </br>";
        } elseif ($nombre == 0) {
            echo "nombre vaut 0 </br>";
        } else {
            echo "nombre est différent de 0 ou de 1</br>";
        }
    ?>
    <h3>Ordre de priorité et associativité des opérateurs </h3>
    <h4>Associativité:</h4>
    <ul>
        <li>Propriété d'une opération dans laquelle les termes peuvent être groupés de différentes façons sans que le résultat de l'opération soit modifié.</li>
        <li>Propriété d'une opération qui permet d'en regrouper les termes sans en changer le résultat.</li>
    </ul>
    <p>Soit une expression <em>1-2-3</em>. Quelle sera sa valeur ? -4 ou 2 ?</br>Doit-on évaluer l'expression de gauche à droite et commencer par <em>1-2</em> ou de droite à gauche en commençant par <em>2-3</em> ?</br>
    <strong>C'est la règle d'associativité qui dicte cela.</strong>  Cette règle définit comment les expressions dont tous les opérateurs ont le même niveau de priorité sont évaluées.
</p>
<p>L'opérateur de soustraction est associatif de gauche à droite, c'est-à-dire qu'il faut  évaluer l'expression comme ceci:</br> 
<u>1 - 2</u> - 3</br>
= -1 - 3</br>
= -4
</p>
<p> <a href="https://www.ukonline.be/cours/java/apprendre-java/chapitre2-3" target="_blank">Documentation</a> </p>
<p> <u>Il y a deux choses à savoir:</u> 
        <ul>
            <li>les opérateurs <strong> <, <=, > et => </strong> ont une priorité plus importante que les opérateurs <strong> ==, ===, !=, !== et <> </strong>, qui ont eux-même une priorité plus importante que l'opérateur <strong>??</strong>.</li>
            <li>Les opérateurs de comparaison sont <strong>non-associatifs</strong> <span style="font-size: 12px;" >(sauf l'opérateur ?? dont l'associativité se fait pas la droite, )</span> ce qui signifie que, -si ils ont une priorité équivalente- on ne pourra pas les utiliser entre eux: comme par exemple <em>2<4>2</em> car les opérateurs < et > ont le même ordre de priorité et sont non-associatifs. </li>
        </ul>
</p>
<p>Exemple: <em>2 < 4 == false</em>: PHP va d'abord effectuer <em>2 < 4</em> (qui est true) et comparer ensuite <em>true == false</em> qui est false. </p>
<?php
    $x = 4;
    $y = 2;
    if ($x <= 1 == false) {
        echo "$x contient une valeur supérieure à 1</br>";
    }
    if (($x != $y) == false) { 
    // les parenthèses sont nécessaires car les opérateurs de comparaison != et == ont une priorité équivalente et on ne peut les utiliser entre eux: les parenthèses augmentent le niveau de priorité d'une partie et l'expression devient ainsi valide.
        echo "$x contient une valeur supérieure à 1</br>";
    }
?>
<h2>Utiliser les opérateurs logiques pour créer des conditions robustes</h2>
<h3>Imbrication des conditions</h3>
<?php
    $inscrit = true;
    $age = 16;
    if ($inscrit) {
        if ($age >= 18) {
            echo "Utilisateur inscrit et majeur. </br>";
        } else {
            echo "Utilisateur inscrit et mineur. </br>";
        }
    } else {
        echo "Utilisateur inconnu. </br>";
    }
?>
<h3>Présentation des opérateurs logiques</h3>
<ul>
    <li>AND ou &&</li>
    <li>OR ou ||</li>
    <li>XOR (qui renverra true uniquement si <u>une seule</u> comparaison vaut true </li>
    <li>!</li>
</ul>
<h3> <strong>Récapitulatif</strong> ordre de priorité des opérateurs</h3>
<table>
    <thead>
        <td>OPERATEUR</td>
        <td>ASSOCIATIVITE</td>
    </thead>
    <tr>
        <td>**</td>
        <td>droite</td>
    </tr>
    <tr>
        <td>++ (incrémentation) et -- (décrémentation)</td>
        <td>droite</td>
    </tr>
    <tr>
        <td>!</td>
        <td>droite</td>
    </tr>
    <tr>
        <td>* , / , %</td>
        <td>gauche</td>
    </tr>
    <tr>
        <td>+ , - , .</td>
        <td>gauche</td>
    </tr>
    <tr>
        <td>< , <= , => , ></td>
        <td>non-associatif</td>
    </tr>
    <tr>
        <td>== , === , != , !== , <> , <=></td>
        <td>non-associatif</td>
    </tr>
    <tr>
        <td>&&</td>
        <td>gauche</td>
    </tr>
    <tr>
        <td>||</td>
        <td>gauche</td>
    </tr>
    <tr>
        <td>??</td>
        <td>droite</td>
    </tr>
    <tr>
        <td>?: (ternaire)</td>
        <td>gauche</td>
    </tr>
    <tr>
        <td>= , += , -= , *= , /= , %= , **= , .=</td>
        <td>droite</td>
    </tr>
    <tr>
        <td>AND</td>
        <td>gauche</td>
    </tr>
    <tr>
        <td>XOR</td>
        <td>gauche</td>
    </tr>
    <tr>
        <td>OR</td>
        <td>gauche</td>
    </tr>
</table>
<h3>Utilisation des opérateurs logiques avec les conditions</h3>
</body>
</html>