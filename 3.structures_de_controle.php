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
    <?php
        $x = 4;
        $y = -12;
        $w = 1;
        if ($x >= 0 AND $x < 5) {
            echo "$x est supérieur à 0 et inférieur à 5. </br>";
        }
        if ($x >= 0 AND $y >= 0) {
            echo "$x et $y sont supérieurs à 0. </br>";
        }
        if ($x >= 0 OR $y >= 0) {
            echo "$x ou $y (ou les deux) est supérieur ou égal à 0.</br> ";
        }
        if ($x >= 0 XOR $y >= 0) {
            echo "$x ou $y (uniquement une de ces valeurs) est supérieure ou égale à 0.</br> ";
        }
        if ($x >= 0 XOR $w >= 0) {
            echo "$x ou $w (uniquement une de ces valeurs) est supérieure ou égale à 0.</br> ";
        }
    ?>
    <p>Si on ajoute des comparaisons dans la condition, il faudra faire très attention à la priorité des différents opérateurs ou utiliser des parenthèses pour forcer la priorité de certains d'entre eux.</p>
    <?php
        $x = 4;
        $y = -12;
        $z = 1;
        // cond 1 : true, true et true
        echo "<p>S'il n'y a que des AND, il faut simplement que toutes les comparaisons soient vraies.</p>";
        if ($x >= 0 AND $x <= 5 AND $y <= 0) {
            echo"Cond 1 true</br>";
        }
        // cond 2 : true, true et true
        if ($x >= 0 AND $x <= 4 AND $y <= 0) {
            echo"Cond 2 true</br>";
        }
        echo "<p>Quand il y a AND et XOR, on vérifie d'abord (true ou false) la comparaison AND avec ses 2 opérandes, ensuite on compare avec XOR, le premier résultat avec le second opérande de XOR.</p>";
        // cond 3 : du AND résulte un false; on a donc false XOR $z >=0; soit false XOR true => true
        if ($x >= 0 AND $y >= 0 XOR $z >= 0) {
            echo "Cond 3 true</br>";
        }
        // cond 4 : du AND résulte un true; on a ensuite true XOR $z >= 0; soit true XOR true => False (car seulement un seul des opérandes de XOR doit être true)
        if ($x >= 0 AND $y < 0 XOR $z >= 0) {
            echo "Cond 4 true</br>";
        }
        // cond 5 : les parenthèses donnent la priorité au XOR qui donne true; on a donc $x > 0 AND true; il en résulte true AND true, qui donne true
        if ($x >= 0 AND ($y >= 0 XOR $z >= 0)) {
            echo "Cond 5 true</br>";
        }
    ?>
    <h3>Inverser la valeur logique d'une variable, d'une condition ou d'un test</h3>
    <p>L'opérateur logique permet d'inverser l'évaluation d'une comparaison; chaque fois que PHP va évaluer quelque chose à true, l'opérateur ! va inverser le résultat en false et inversement.</p>
    <p><strong>ATTENTION:</strong> il y a une différence fondamentale entre les expressions (!$x >= 0) et (!($x >= 0)) !! Il faut bien regarder où se situe le ! par rapport aux parenthèses. Dans la première expression, PHP va commencer par évaluer !$x et !$y et renvoyer un booléen.</p>
    <?php
    $x = 4;
    $y = -12;
    var_dump($x);
    echo "Un var_dump sur " . '$x' . " renvoie INT 4</br>";
    var_dump(!$x);
    echo "Un var_dump sur " . '!$x' . " renvoie BOOLEAN false</br>";
    var_dump(!$x >= 0);
    echo "Nous avons donc ici l'expression \"false >= 0\", or false VAUT 0 et donc 0 >= 0 = TRUE";
    var_dump(!$y);
    echo "Un var_dump sur " . '!$y' . " renvoie BOOLEAN false aussi</br>";
    var_dump(!($x >= 0));
    echo "Par contre, dans le cas de l'expression \"!(" .'$x'." >= 0)\", l'évaluation de l'expression ".'$x'." >= 0 vaut true mais le résultat est inversé par !, donc nous avons FALSE</br>"; 
    echo 'Evaluation de (!($x >= 0) AND !($y >= 0))'. "</br>";
    if (!($x >= 0) AND !($y >= 0)) {
        echo "true</br>";
    }
    var_dump(!($x >= 0));
    var_dump(!($y >= 0));
    echo 'Evaluation de (!($x >= 0 AND $y >= 0))'. "</br>";
    echo "!(true AND false)</br>";
    echo "!(false)</br>";
    echo "true</br>";
    ?>
    <h2>Les opérateurs ternaire et fusion null</h2>
    <p>Ces deux opérateurs vont nous permettre d'écrire des conditions plus condensées. Elles vont permettre d'accélérer la vitesse d'exécution du code.</p>
    <h3>L'opérateur ternaire</h3>
    <p><strong>Attention:</strong> il faut éviter d'imbriquer les structures ternaires.</br>
    La structure est <em>test ? code si vrai : code si faux</em>. </p>
    <?php
        $age = 16;
        echo $age >= 18 ? "majeur</br>" : "mineur</br>";
        // ci-après, on stocke qqch dans $texte selon le résultat de la ternaire
        $texte = $age > 5 ? "plus de 5" : $age = 15;
        echo "texte vaut $texte </br>";
        echo "age vaut $age</br>";
        echo "Si on omet la partie entre le ? et le : , 1 (true) sera renvoyé si la condition se vérifie</br>";
        echo $age > 12 ? : "faux</br>";
    ?>

    <h3>L'opérateur fusion null</h3>
    <p>La structure est <em>test ?? code si résultat du test est NULL</em>.</p>
    <?php
        $test;
        echo $test ?? "NULL</br>";
        $test2 = "roger</br>";
        echo $test2 ?? "NULL</br>";
    ?>
    <h2>L'instruction switch</h2>
    <?php
        $cote = 10;
        switch($cote) {
            case 0:
                echo '$cote vaut ' . $cote . ": note nulle</br>";
                break;
            case 1:
                echo '$cote vaut ' . $cote . ": note insuffisante</br>";
                break;
            case 2:
                echo '$cote vaut ' . $cote . ": note faible</br>";
                break;
            default:
                echo '$cote vaut ' . $cote . ": note suffisante</br>";
        }
    ?>
</body>
</html>