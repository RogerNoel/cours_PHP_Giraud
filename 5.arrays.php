<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>arrays</title>
</head>
<body>
    <h1>Les tableaux PHP</h1>
    <p>Il existe 3 sortes de tableaux en PHP:
        <ul>
            <li>Les tableaux indexés</li>
            <li>Les tableaux associatifs</li>
            <li>Les tableaux multidimentionnels (tableaux qui stockent d'autres tableaux en valeurs).</li>
        </ul>
    </p>

    <h2>Les tableaux indexés</h2>
    <p>On peut les créer de 2 manières:
        <ul>
            <li>$prenoms = array('Roger', 'Nath', 'Manon');</li>
            <li>$prenoms = ['Roger', 'Nath', 'Manon'];</li>
        </ul>
    </p>
    <p>On peut aussi le créer indice par indice: $prenoms[0] = 'Roger'; etc ...</p>
    <p>Pour parcourir un tableau, il faut faire une boucle <em>for</em>, et donc il faut connaître le nombre de valeurs y contenues: la fonction <strong>count()</strong> retourne le nombre d'éléments d'un tableau.</p>
    <?php
        $nombres = [2, 5, 12, 88];
        echo 'le tableau $nombres contient ' .count($nombres). ' éléments.</br>';
        for ($i = 0; $i < count($nombres); $i++) {
            echo "index $i contient " .$nombres[$i].'</br>';
        }
    ?>
    <p>Cette technique va très bien fonctionner tant que nos tableaux numérotés vont avoir des indices « naturels ». En effet, il est tout à fait possible d’attribuer les indices manuellement et de sauter certains indices pour stocker nos valeurs dans nos variables tableaux.</br>
    Dans ce cas-là, on ne pourra pas récupérer toutes les valeurs en bouclant sur les indices comme ci-dessus mais on utilisera plutôt une boucle foreach qui est une boucle spécialement créée pour les tableaux.</p>
    <?php
        $nombres = [2, 5, 12, 88];
        foreach($nombres as $item){
            global $newtab; // global pour le print_r hors de la fonction
            static $i = 0; // static pour ne pas réinitialiser à chaque passage
            $newtab[$i] = $item;
            $i++;
        }
        print_r($newtab); // Array ( [0] => 2 [1] => 5 [2] => 12 [3] => 88 )
    ?>

    <h2>Les tableaux associatifs</h2>
    <p>Un tableau associatif est un tableau qui va utiliser des clefs textuelles qu’on va associer à chaque valeur.</p>
    <h3>Créer un tableau associatif</h3>
    <p>Syntaxe: $ages = ['Roger' => 56, 'JaH' => 40];</p>
    <?php
        $villes = ['Roger' => 'Spa', 'Nath' => 'Ferrières'];
        $metiers['Roger'] = "WebDev";
        $metiers['Manon'] = "Instit";
        print_r($villes);
        echo "</br>";
        print_r($metiers);
        echo "</br>Pour parcourir un tableau associatif, on utilise la boucle <strong>foreach</strong> avec en paramètre <em>key => value</em></br>";

        $villes['JaH'] = "Trois-ponts";
        foreach($villes as $key => $value){
            echo "$key habite à $value</br>";
        }
    ?>

    <h2>Les tableaux multidimentionnels</h2>
    <p>Un tableau multidimensionnel est un tableau qui va lui-même contenir d’autres tableaux en valeurs.</p>
    <h3>Crée un tableau multidimensionnel</h3>
    <?php
        // plusieurs tableaux indexés hébergeant des tableaux indexés
        $suite = [
            [1,2,4,8,16],
            [2,4,8,16,32]
        ];
        echo ($suite[0][3]."</br>");
        print_r($suite[0][3]);
        echo "</br>";

        // tableaux indexés hébergeant des tableaux associatifs
        $utilisateurs = [
            ["nom" => "Roger", "age" => 56],
            ["nom" => "Manon", "age" => 20],
            ["nom" => "JaH", "age" => 40]
        ];
        echo ($utilisateurs[2]["nom"]."</br>");
        foreach($utilisateurs as $person) {
            foreach($person as $item) {
                static $j = 0;
                echo "</br>$j </br>";
                var_dump ($item);
                $j++;
            }
        }

        // tableaux associatifs hébergeant des tableaux associatifs
        $abonnes = [
            "Roger" => ["ville" => "Spa", "articles" => 5],
            "JaH" => ["ville" => "Trois-P", "articles" => 8],
            "Dom" => ["ville" => "Theux", "articles" => 2]
        ];
        $roger = $abonnes["Roger"];
        echo $roger['ville']."</br>";
        echo "Roger a créé ".$roger['articles'].' articles.</br>';
        echo $abonnes['Dom']['ville'];
    ?>
    <h3>Parcourir et afficher les valeurs d'un tableau multidimentionnel</h3>
    <p>Pour parcourir toutes les valeurs d’un tableau multidimensionnel, la meilleure manière de faire va être d’utiliser <u>plusieurs boucles foreach imbriquées</u>.</p>
    <?php   
        $suites = [
            [1,2,4,8,16],
            [2,4,8,16,32]
        ];
        foreach($suites as $index => $suite){
            echo 'suite '.($index+1).' : ';
            foreach($suite as $item){
                echo "$item - ";
            }
            echo "</br>";
        }
        // sur le tableau "abonnés"
        foreach($abonnes as $abonne => $infos){
            echo "Abonné $abonne : ";
            foreach($infos as $key => $value){
                echo "$key = $value - ";
            }
            echo "</br>";
        }
        var_dump($abonnes);
        echo "/<br>";
        print_r($abonnes);
    ?>
</body>
</html>