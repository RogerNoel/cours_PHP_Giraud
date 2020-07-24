<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO avancée 2</title>
</head>
<body>
    <h1>POO avancée partie 2</h1>

    <h2>Auto-chargement des classes</h2>
    <p><u>Rappel:</u> il est considéré comme une bonne pratique en PHP orienté objet de créer un fichier par classe. </br>
    L’un des inconvénients de cette façon de procéder, cependant, est qu’on va possiblement avoir à écrire de longues séries d’inclusion de classes (une inclusion par classe) dans nos scripts lorsque ceux-ci ont besoin de plusieurs classes.</br>
    Pour éviter de rallonger le code inutilement, nous avons un moyen de charger (inclure) automatiquement les classes d’un seul coup dans un fichier.</br>
    Pour cela, nous pouvons utiliser la fonction <em>spl_autoload_register()</em>.</br>
    Cette fonction permet d’enregistrer une (ou plusieurs) fonctions qui seront mises dans une file d’attente et que le PHP appelera automatiquement dès qu’on essayera d’instancier une classe.</br>
    L’idée est donc de passer une fonction qui permet de n’inclure que les classes dont on a besoin dans un script et de passer cette fonction à <em>spl_autoload_register()</em> afin qu’elle soit appelée dès que cela est nécessaire.</p>
    <p>On pourra soit utiliser une fonction nommée, soit idéalement créer une fonction anonyme:</p>
    <p>
        <em>
            <pre>
        spl_autoload_register(function($classe){
            require './classes/'.$classe.'.class.php';
        });

        $testAdmin3 = new Admin3('Nath', '3333', 'Sud');
        echo $testAdmin3->getPrixAbo();
        $testAbonne4 = new Abonne4('Papou', '999', 'Sud');
        echo $testAbonne4->getNom() . ' paie ' . $testAbonne4->getPrixAbo() . ' euros.';
            </pre>
        </em>
    </p>
    <?php
        spl_autoload_register(function($classe){
            require './classes/'.$classe.'.class.php';
        });

        $testAdmin3 = new Admin3('Nath', '3333', 'Sud');
        echo $testAdmin3->getPrixAbo().'</br>';
        $testAbonne4 = new Abonne4('Papou', '999', 'Sud');
        echo $testAbonne4->getNom() . ' paie ' . $testAbonne4->getPrixAbo() . ' euros.</br>';
    ?>
    <p>On utilise la fonction <em>spl_autoload_register()</em> en lui passant une <strong>fonction anonyme</strong> en argument <span style="font-size: 0.7em;">l'argument de cette fonction anonyme, soit <em>$classe</em>, permet de remplir un <em>require</em> pré-écrit</span> dont le rôle est d’inclure des fichiers de classe.</br>
    En résultat, la fonction <em>spl_autoload_register()</em> sera appelée dès qu’on instanciera une classe et elle tentera d’inclure la classe demandée en exécutant la fonction anonyme.</br>
    Notez que cette fonction tentera également de charger les éventuelles classes parents en commençant par les parents. Dans notre cas, la fonction <em>spl_autoload_register()</em> tentera d’inclure les fichiers <em>utilisateur.class.php, admin.class.php et abonne.class.php</em> situés dans le dossier <em>classes</em>.</br>
    On comprend tout l’intérêt de placer tous les fichiers de classes dans un même dossier et de respecter une norme d’écriture lorsqu’on nomme les fichiers de classe puisque cela nous permet de pouvoir écrire des instructions formatées comme le require de notre fonction <em>spl_autoload_register()</em>.</p>
    <p><strong>Remarque:</strong> si vous tentez d’inclure une classe qui est introuvable ou inaccessible le PHP renverra une erreur fatale.</br>
    On prendra en charge les erreurs et les exceptions en particulier en utilisant la classe <em>Exception</em>, mais ceci est un sujet relativement complexe qui justifie une partie de cours en soi. Nous verrons comment cela fonctionne en détail dans la prochaine partie.</p>
</body>
</html>