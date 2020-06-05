<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les boucles</title>
</head>
<body>
    <h1>Les boucles</h1>
    <h2>Introduction</h2>
    <p>Les boucles vont nous permettre d’exécuter plusieurs fois un bloc de code, c’est-à-dire d’exécuter un code « en boucle » tant qu’une condition donnée est vérifiée.</p>
    <h3>Opérateurs d'incrémentation et de décrémentation</h3>
    <p>Elles vont pouvoir être réalisées grâce aux opérateurs d’incrémentation ++ et de décrémentation --.</br>
Il y a 2 façons d'incrémenter/décrémenter une variable:
        <ul>
            <li>soit incrémenter/décrémenter la variable pour ensuite en retourner la valeur (pré-incrémentation),
                <ul>
                    <li><em>++$x</em> qui incrémente la valeur de X puis retourne sa nouvelle valeur.</li>
                    <li><em>--$x</em> qui décrémente la valeur de X puis retourne sa nouvelle valeur.</li>
                </ul>
            </li>
            <li>soit retourner la valeur de la variable pour ensuite l'incrémenter/décrémenter (post-incrémentation).
                <ul>
                    <li><em>$x++</em> qui retourne la valeur de X puis en incrémente la valeur.</li>
                    <li><em>$x--</em> qui retourne la valeur de X puis en décrémente la valeur.</li>
                </ul>
            </li>
        </ul>
    </p>
    <?php
        $x = 0; $y = 0; $a = 0; $b = 0; 
        echo "post incrémentation pour " . '$x: ' . $x++ . "</br>";
        echo '$x vaut maintenant ' . $x . "</br>";

        echo "post décrémentation pour " . '$y: ' . $y-- . "</br>";
        echo '$y vaut maintenant ' . $y . "</br>";

        echo "pré incrémentation pour " . '$a: ' . ++$a . "</br>";
        echo '$a vaut maintenant ' . $a . "</br>";

        echo "pré décrémentation pour " . '$b: ' . --$b . "</br>";
        echo '$b vaut maintenant ' . $b . "</br>";
    ?>
    <h2>La boucle WHILE</h2>
    <p>La boucle while va nous permettre d’exécuter un certain bloc de code « tant qu’une » condition donnée est vérifiée.</p>
    <?php
        $compteur = 1;
        while ($compteur <= 5) {
            echo "Tour n°$compteur</br>";
            $compteur+= 1;
        }
    ?>
    <h2>La boucle DO...WHILE</h2>
    <p>Même si une condition est fausse dès le départ, on effectuera toujours au moins un
passage au sein d’une boucle do…while, ce qui n’est pas le cas avec une boucle while.</p>
    <?php
        $a = 0;
        do {
            echo "Action avant le test," . '$a ' . "vaut $a.</br>";
            $a++;
        } while ($a < 0);
        $b = 0;

        do {
            echo "Action avant le test," . '$b ' . "vaut $b.</br>";
            $b++;
        } while ($b < 3);
    ?>
    <h2>La boucle FOR</h2>
    <p>Nous pouvons décomposer le fonctionnement d’une boucle for selon trois phases :
        <ul>
            <li>phase d’initialisation</li>
            <li>phase de test</li>
            <li>phase d’incrémentation</li>
        </ul>
    </p>
    <?php
        for ($compteur = 0; $compteur < 3; $compteur++) {
            echo "Le compteur est à $compteur.</br>";
        }
    ?>
    <h2>La boucle FOREACH</h2>
    <p>Fonctionnant sur les tableaux, on l'étudiera plus tard.</p>
</body>
</html>