<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espaces de Noms</title>
</head>
<body>
    <h1>Les espaces de noms</h1>
    <p>Les espaces de nom en PHP sont comme des dossiers virtuels qui servent à encapsuler (isoler) certains éléments de certains autres. Les espaces de noms permettent notamment d’éliminer les conflits possibles entre deux éléments de même nom.</br>
    Cette ambiguïté autour du nom de plusieurs éléments de même type peut survenir lorsqu’on a défini des fonctions, classes ou constantes personnalisées et qu’on fait appel à des extensions ou des bibliothèques externes PHP.</br>
    Une extension ou une bibliothèque externe est un ensemble de code qui ne fait pas partie du langage nativement mais qui a pour but de rajouter des fonctionnalités au langage de base en proposant notamment par exemple des classes préconstruites pour créer une connexion à une base de données ou pour filtrer des données externes.</br>
    Il est possible que certaines classes, fonctions ou constantes d’une extension que l'on veut utiliser possèdent des noms identiques à des classes, fonctions ou constantes personnalisées qu’on a défini dans un script. Sans définition d’un espace de noms, cela crééra évidemment des conflits.</br>
    Pour prendre un exemple concret, vous pouvez considérer que les espaces de noms fonctionnent comme les dossiers sur notre ordinateur. Alors qu’il est impossible de stocker deux fichiers de même nom dans un même dossier, on va tout à fait pouvoir stocker deux fichiers de même nom dans deux dossiers différents. En effet, dans ce dernier cas, il n’y a plus d’ambiguïté puisque les deux fichiers ont un chemin d’accès et de fait une adresse différente sur notre ordinateur.</p>
    <!-- ---------------------------- -->
    <h2>Définir un espace de noms simple</h2>
    <p>Pour définir un espace de noms, on utilise le mot clef <em><strong>namespace</strong></em> suivi de notre espace de noms: </p>
    <p><em><pre>
        namespace Exemple{
            // ici des classes, constantes, fonctions, traits ou interfaces 
        }
    </pre> </em></p>
    <p>Notez déjà que les noms d’espaces de noms <u>ne sont pas sensibles à la casse</u> et qu’on ne peut pas définir un espace de noms avec un nom commençant par « PHP ».</p>
    <p><strong><u>NOTE</u>:</strong> seuls
        <ul>
            <li>les traits</li>
            <li>les classes</li>
            <li>les interfaces</li>
            <li>les fonctions</li>
            <li>les constantes</li>
        </ul>
    seront affectés par un espace de noms c’est-à-dire pourront effectivement être différenciés du reste du code grâce à l’espace de noms.</br>
    <em>On pourra placer d’autres types d’éléments comme des variables dans un espace de noms mais ces éléments ne seront pas affectés par l’espace de noms</em>.</br>
    Par ailleurs, vous devez également savoir qu’un espace de noms <strong>doit être déclaré avant tout autre code</strong> dans un fichier <u>à l’exception de la commande declare</u> qui peut être déclarée avant.</p>
    <p>Nous avons créé plus haut un espace de noms simple qu’on appelle <em>Exemple</em> <u>dans un fichier séparé</u>. On enregistre le fichier sous le nom <em>exemple.namespace.php.</em> Ensuite, on définit différents éléments dans cet espace de noms.</br>
    <u>Note</u>: aucun autre code PHP ne pourra être défini en dehors d’un espace de noms. Si on souhaite créer du code « global » (du code en dehors d’un espace de noms défini), il faudra déclarer un <em>espace de noms sans nom</em>, en utilisant simplement le mot clef <em>namespace {...ici le code...}</em>.</p>
    <p>Finalement, notez également qu’on pourra définir et utiliser le même espace de noms dans plusieurs fichiers, ce qui sera très utile pour scinder le contenu d’un espace de noms entre plusieurs fichiers. On pourra également en théorie définir plusieurs espaces de noms dans un même fichier mais cela est considéré comme une mauvaise pratique et donc on essaiera tant que possible de l'éviter.</p>
    <!-- -------------------------------- -->
    <h2>Définir un sous-espace de noms</h2>
    <p>De la même façon qu’avec les dossiers réels, nous pouvons définir des niveaux de hiérarchie d’espaces de noms et ainsi créer des sous-espaces de noms. Pour cela, on précise les différents noms liés aux niveaux et séparés par des antislashs.</p>
    <p>
        <em>
            <pre>
                namespace Exemple\Sous{
                    // ... code ...
                }
            </pre>
        </em>
    </p>
    <p>Ici, j’enregistre mon sous espace de noms dans un nouveau fichier que j’appelle <em>sousexemple.namespace.php</em>. Mis à part la relation hiérarchique entre nos deux espaces, ceux-ci sont complètement différenciés et vont pouvoir contenir les éléments qu’ils souhaitent.</p>
    <!-- -------------------------------- -->
    <h2>Accéder aux éléments d'un espace de noms</h2>
    <p>Pour utiliser des éléments d’un espace de noms en particulier, il faut dire à PHP à quel espace de noms on fait référence. Pour cela, des règles similaires à la recherche d’un fichier sur notre ordinateur sont utilisées en PHP.</p>
    <p>Pour accéder à un élément d’un espace de noms, on peut déjà préciser un nom non qualifié, c’est-à-dire ne préciser que le nom de l’élément en question. Si on précise le nom d’un élément sans qualificatif dans un espace de noms nommé, alors c’est l’élément de même nom dans l’espace nommé qui sera utilisé.</p>
    <p>Si on précise le nom d’un élément sans qualificatif depuis l’espace global, alors c’est l’élément de même nom dans l’espace global qui sera utilisé.</br>
    Attention ici : dans le cas où on souhaite utiliser une fonction ou une constante avec un nom sans qualificatif depuis un espace de noms nommé et que la fonction ou la constante en question n’est pas trouvée dans l’espace, alors une fonction / constante du même nom sera cherchée dans l’espace global. Ce ne sera pas le cas pour une classe.</p>
    <p style="color: red;"><em>Voir exemple.namespace.php</em></p>
    <p>On peut également utiliser un <em>nom qualifié</em> pour utiliser un élément d’un espace de noms.</br>
    Le <em>nom qualifié</em> correspond au <u>nom de l’élément préfixé par son chemin d’accès à partir de l’endroit où il est appelé</u>.</br>
    Si on utilise l’écriture <em>sous\bonjour()</em> depuis notre espace de noms Exemple, par exemple, on indique qu’on souhaite accéder à la fonction <em>bonjour()</em>  située dans <em>exemple\sous\bonjour()</em>.</br>
    Finalement, on peut encore préciser un <strong>nom absolu</strong> pour accéder à un élément d’un espace de noms. Un nom absolu correspond au <u>chemin complet</u> de l’élément, c’est-à-dire au nom de l’élément préfixé de tous les espaces et sous espaces et commençant avec un antislash.</p>
    <?php
        include 'exemple.namespace.php';
        \Exemple\Sous\Salut();
        \Exemple\bonjour();
    ?>
    448
</body>
</html>