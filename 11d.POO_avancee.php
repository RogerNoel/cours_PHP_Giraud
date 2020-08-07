<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO avancée 4 </title>
</head>
<body>
    <!-- ------------------------- -->
    <h1>POO avancée - Partie 4</h1>
    <!-- ---------------------------- -->
    <h2>Le clonage d'objets</h2>
    <p>Dans la leçon précédente, on a vu que les <u>variables objets</u> stockaient en fait des identifiants d’objets (pointeurs) servant à accéder aux objets. </br>
    Lorsqu’on instancie une fois une classe, on crée un objet et on stocke généralement un identifiant d’objet <em>(pointeur)</em> dans une variable qu’on appelle une <u>variable objet</u> <span style="font-size: 0.8em;">ou un objet par simplification</span>. Si on assigne le contenu de la <u>variable objet</u> dans une nouvelle variable, on ne va créer qu’une copie de l’identifiant pointeur qui va continuer à pointer vers le même objet.</br>
    Cependant, dans certains cas, on voudra plutôt créer une copie d’un objet en soi. C’est exactement ce que va nous permettre de réaliser le <strong>clonage d’objet</strong> que nous allons étudier dans cette nouvelle partie.</p>
    <p style="color: red;">Voir code PHP, rappel du cours précédent pour bien comprendre les notions d'<em>identifiant pointeur</em> et de <em>référence</em></p>
    <?php
        class Humain{
            protected $name;
            public function __construct($name)
            {
                $this->name = $name;
            }
            public function getName(){
                echo $this->name.'</br>';
            }
            public function setName($name){
                $this->name = $name;
            }
        }
        $roger = new Humain('roger');
        $roger->getName();
        $tom = $roger;
        $tom->getName();
        $tom->setName('Patapouf');
        $roger->getName();
        echo '...........</br>';
        // -------------- Rappel du mot-clef &
        $x = 1;     // je créé une variable qui prend la valeur 1
        function double($item){ // fonction qui affiche la valeur de la variable entrée puis ensuite lui assigne la valeur 5
            echo '$x dans la fonction avant return = ' . $item . '</br>';
            return $item = 7; // stocké plus bas dans $recupX
        }
        // ATTENTION: ici on teste -> 1) l'argument $item dans la fonction et 2) l'argument &item et ensuite on étudie le résultat
        double($x);
        echo $x . '</br>';      // le $x en dehors de la fonction
        echo '...........</br>';
        $recupX = double($x); // on récupère l'argument devenu 5 pour l'afficher juste en dessous
        echo $recupX . '</br>';
        echo $x . '</br>';  // le $x en dehors de la fonction
        // faire précéder l'argument par & affecte aussi la valeur originale.
    ?>
    <p>Parfois, on voudra <em>copier</em> un objet afin de manipuler une copie indépendante plutôt que l’objet original.</br>
    Dans ces cas-là, on <em>clonera</em> l’objet. Pour cela, utilisera le mot clef <em><strong>clone</strong></em> qui appellera la méthode magique <em>__clone()</em> de l’objet <u>si celle-ci a été définie</u>. Notez qu’<em>on ne peut pas</em> directement appeler la méthode <em>__clone()</em>.</br>
    Lorsqu’on clone un objet, le PHP crééra une copie <em>« superficielle »</em> de toutes les propriétés relatives à l’objet, ce qui signifie que les propriétés qui sont des références à d’autres variables (objets) demeureront des références.</br>
    Dès que le clonage d’objet a été effectué, la méthode <em>__clone()</em> du nouvel objet (le clone) sera automatiquement appelée. Cela va généralement nous permettre de mettre à jour les propriétés souhaitées.</p>
    <h3>Exemple de clonage d'objet</h3>
    <p>Pour cloner un objet en pratique nous allons simplement devoir utiliser le mot clef clone et éventuellement pouvoir définir une méthode __clone() qui va nous permettre de mettre à jour les éléments du clone par rapport à l’original.</p>
    <p>
        <em>
            <pre>
                <strong>Dans la classe:</strong>

            public function __clone()
            {
                $this->nom = $this->nom . ' (clone)';
            }

                <strong>Ensuite, dans le code</strong>

            $tom = clone $roger;

            </pre>
        </em>
    </p>
    <?php
        class Moi{
            protected $nom;
            protected $age;
            public function __construct($name)
            {
                $this->nom = $name;
            }
            public function __clone()
            {
                $this->nom = $this->nom . ' (clone)';
            }
            public function presentation(){
                echo 'Hi I am ' . $this->nom . '.</br>';
            }
            public function setName($name){
                $this->nom = $name;
            }
            public function getName(){
                return $this->nom;
            }
        }
        $roger = new Moi('Roger');
        $roger->presentation();
        $tom = clone $roger;
        var_dump($tom);
        $roger->setName('Roro');
        var_dump($tom);
        var_dump($roger);
        $nomTom = $tom->getName();
        echo '$tom a pour nom "' . $nomTom . '"</br>';
        $roger->setName('Roger');
    ?>
    <p>On a créé une copie indépendante de l’objet de départ (et donc une nouvelle instance de la classe): on ne s’est pas contenté de créer une copie d’un identifiant pointant vers le même objet.</p>
    <h3>Comparer les objets</h3>
    <p>De la même manière que nous pouvons comparer différentes variables qui stockent des valeurs simples (une chaine de caractères, un chiffre, un booléen, etc.), on  peut également comparer des <em>variables objets</em>, ce qui sera très utile pour s’assurer par exemple qu’un objet est unique.</br></p>
    <h4>Principe de la comparaison d’objets</h4>
    <p>Pour comparer deux variables objets entre elles, nous allons utiliser aussi des opérateurs de comparaison. Cependant, étant donné que les valeurs comparées sont dans ce cas des valeurs complexes (car un objet est composé de diverses propriétés et méthodes), nous n’utiliserons pas ces opérateurs de comparaison aussi librement que lors de la comparaison de valeurs simples.</br>
    La première chose à savoir est qu’on ne pourra tester que l’égalité (en valeur ou en identité) entre les objets. <span style="font-size: 0.8;">Cela n’aurait aucun sens de demander au PHP si un objet est « inférieur » ou « supérieur » à un autre puisqu’un objet regroupe un ensemble de propriétés et de méthodes.</span></br>
        <ul>
            <li>En utilisant l’opérateur de comparaison simple <em>==</em>, les objets vont être considérés comme égaux s’ils possèdent <u>les mêmes attributs et valeurs</u> (valeurs qui seront comparées à nouveau avec <em>==</em> et si ce sont des instances de la même classe.</li>
            <li>En utilisant l’opérateur d’identité <em>===</em>, en revanche, les objets ne seront considérés comme égaux que s’ils font référence à la même instance de la même classe.</li>
        </ul>
    </p>
    <h3>Comparer les objets en pratique</h3>
    <p>

    </p>
    <p>
        <em>
            <pre>
        // $roger = instance de Moi
        // $roger2 = instance de Moi
        // $tom = clone de $roger
        // $robot = $roger (soit deux pointeurs vers $roger)
            </pre>
        </em>
    </p>
    <?php
        $roger2 = new Moi('Roger');
        $robot = $roger;
        // $roger = instance de Moi
        // $roger2 = instance de Moi
        // $tom = clone de $roger
        // $robot = $roger (soit deux pointeurs vers $roger)
        echo '$roger==$roger2';
        var_dump($roger==$roger2);
        echo '$roger===$roger2';
        var_dump($roger===$roger2);
        echo '$roger==$tom';
        var_dump($roger==$tom);
        echo '$roger===$tom';
        var_dump($roger===$tom);
        echo '$roger==$robot';
        var_dump($roger==$robot);
        echo '$roger===$robot';
        var_dump($roger===$robot);
        echo '$roger2==$tom';
        var_dump($roger2==$tom);
        echo '$roger2===$tom';
        var_dump($roger2===$tom);
        echo '$roger2==$robot';
        var_dump($roger2==$robot);
        echo '$roger2===$robot';
        var_dump($roger2===$robot);
        echo '$roger2===$robot';
        var_dump($tom==$robot);
        echo '$tom===$robot';
        var_dump($tom===$robot);
?>
</body>
</html>