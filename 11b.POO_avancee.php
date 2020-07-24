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
            require_once './classes/'.$classe.'.class.php';
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
    <p><strong>Remarque:</strong> si vous tentez d’inclure une classe qui est introuvable ou inaccessible, le PHP renverra une erreur fatale.</br>
    On prendra en charge les erreurs et les exceptions en particulier en utilisant la classe <em>Exception</em>, mais ceci est un sujet relativement complexe qui justifie une partie de cours en soi. Nous verrons comment cela fonctionne en détail dans la prochaine partie.</p>

    <h2>Le mot clef final en PHP objet</h2>
    <p>Depuis la version 5 de PHP, <u>on peut empêcher les classes filles de surcharger une méthode en précisant le mot clef <em>final</em></u> avant la définition de celle-ci.</br>
    Si la classe elle-même est définie avec le mot clef final alors celle-ci ne pourra tout simplement pas être étendue. Cela peut être utile si vous souhaitez empêcher explicitement certains développeurs de surcharger certaines méthodes ou d’étendre certaines classes dans le cas d’un projet Open Source par exemple.</p>
    <h3>Définir une méthode finale</h3>
    <p>Illustrons cela avec quelques exemples, en commençant avec la définition d’une méthode finale. Pour cela, on peut écrire les classes <em>Utilisateur11</em> et <em>Admin11</em> en surchargeant par exemple la méthode <em>getNom()</em> définie dans la classe parent <em>Utilisateur11</em> depuis notre classe étendue <em>Admin11</em>:</p>
    <p>La méthode <em>getNom()</em> de <em>Utilisateur11</em>:</p>
    <p>
        <em>
            <pre>
    public function getNom() { echo $this->user_name;}
            </pre>
        </em>
    </p>
    <p>La méthode surchargée <em>getNom()</em> de <em>Admin11</em>:</p>
    <p>
        <em>
            <pre>
    public function getNom(){ echo $this->user_name . ' Admin.'; }
            </pre>
        </em>
    </p>
    <p>Lorsqu’on tente d’appeler la méthode <em>getNom()</em> depuis un objet de la classe <em>Admin11</em>, la définition de la méthode mère se retrouve bien surchargée et c’est la définition de la classe fille qui est utilisée.</p>
    <p>Si on définit la méthode <em>getNom()</em> comme <em>finale</em> dans la classe <em>Utilisateur11</em>:</p>
    <p>
        <em>
            <pre>
    <u>final</u> public function getNom() { echo $this->user_name;}
            </pre>
        </em>
    </p>
    <p>... maintenant que la méthode est définie avec le mot clef <em>final</em>, on n’a plus le droit de la surcharger dans une classe étendue. <u>Si on tente de faire cela, une erreur fatale sera levée par le PHP.</u></p>
    <h3>Définir une <em><u>classe</u> finale</em></h3>
    <p>Si on définit une classe avec le mot clef <em>final</em>, on indique que <u>la classe ne peut pas être étendue</u>. Là encore, si on tente tout de même d’étendre la classe, le PHP renverra une erreur fatale.</p>
    <p><em><pre>final class Maclasse{ ... }</pre></em></p>
    <p>Par définition, une classe finale est une classe dont l’implémentation est complète puisqu’en la déclarant comme finale on indique qu’on ne souhaite pas qu’elle puisse être étendue. Ainsi, aucune méthode abstraite n’est autorisée dans une classe finale.</p>

    <h2>Résolution statique à la volée - late static bindings</h2>
</body>
</html>