<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO avancée 3</title>
</head>
<body>
    <h1>POO avancée - partie 3</h1>

    <h2>L’interface Iterator et le parcours d’objets</h2>
    <p>Nous allons apprendre à parcourir rapidement les propriétés visibles d’un objet en utilisant une boucle <em>foreach</em> et découvrir l’interface <em>Iterator</em> et implémenter certaines de ses méthodes.</p>

    <h2>Parcourir un objet en utilisant une boucle <em>foreach</em></h2>
    <p>Le PHP permet de parcourir simplement un objet afin d’afficher la liste de ses propriétés et leurs valeurs en utilisant une boucle foreach.</br>
    <strong>Remarque</strong>: <u>par défaut</u>, seules les propriétés visibles (publiques) seront lues.</p>

    <p>Création d'une classe</p>
    <p>
        <em>
            <pre>
        class Test{
            public $variablePublique1 = 'Variable publique 1';
            public $variablePublique2 = 'Variable publique 2';
            public $variablePublique3 = 'Variable publique 3';
            protected $variableProtegee = 'Variable protégée';
            private $variablePrivee = 'Variable privée';
        }

        $untest = new Test();

        foreach($untest as $cle => $valeur){
            echo $cle . ' => ' . $valeur . '.';
        }
            </pre>
        </em>
    </p>
    <?php
        class Test{
            public $variablePublique1 = 'Variable publique 1';
            public $variablePublique2 = 'Variable publique 2';
            public $variablePublique3 = 'Variable publique 3';
            protected $variableProtegee = 'Variable protégée';
            private $variablePrivee = 'Variable privée';
        }

        $untest = new Test();

        foreach($untest as $cle => $valeur){
            echo $cle . ' => ' . $valeur . '.</br>';
        }
    ?>
    <p>Jusque là, ça se passe exactement comme avec un tableau. Et seules les propriétés publiques ont été affichées.</p>
    <p>On va pouvoir gérer la façon dont un objet doit être traversé ou parcouru en implémentant une <u>interface</u> <em><strong>Iterator</strong></em> qui est une <em>interface prédéfinie</em> en PHP.</p>
    <p>L’interface <em>Iterator</em> définit des méthodes qu’on peut implémenter pour itérer des objets en interne. On peut ainsi passer en revue certaines valeurs de nos objets à des moments choisis.</br>
    L’interface Iterator possède notamment cinq méthodes qu’il sera intéressant d’implémenter:
        <ul>
            <li>La méthode current()</li>
            <li>La méthode next()</li>
            <li>La méthode rewind()</li>
            <li>La méthode key()</li>
            <li>La méthode valid()</li>
        </ul>
    <strong><u>Rappel:</u></strong> une interface n’est qu’un plan de base qui spécifie une liste de méthodes que les classes qui implémentent l’interface devront définir.</br>
    Les interfaces prédéfinies comme <em>Iterator</em> ne servent donc qu’à produire un code plus compréhensible et plus structuré (notamment car les autres développeurs vont «reconnaître» l’utilisation d’une interface prédéfinie et donc immédiatement comprendre ce qu’on cherche à faire). Nous devrons donc définir les méthodes définies dans <em>Iterator</em> dans la classe qui implémente cette interface.</br>
    Généralement, on se basera sur le nom des méthodes pour définir une implémentation cohérente et utile. En effet, vous devez savoir que <u>les fonctions <em>current(), next(), rewind() et key()</em> existent toutes déjà en tant que fonctions prédéfinies en PHP</u>. Nous allons donc les utiliser pour définir l’implémentation de nos méthodes.</p>

    <p>Voici le code de test:</p>
    <p>
        <em>
            <pre>
        $tableauTest = ['C1'=>'V1', 'C2'=>'V2', 'C3'=>'V3'];

        $objet = new Pwet0008($tableauTest);
            foreach($objet as $k=>$v){
            echo 'Clef ' . $k . ' => ' . $v . './br';
        }
            </pre>
        </em>
    </p>
    <p style="color: red;"><em>Voir ici création de la classe en PHP</em></p>
    <?php
        class Pwet0008 implements Iterator{
            private $tableau = [];

            public function __construct(array $tb)
            {
                $this->tableau = $tb;
            }

            public function info(){
                var_dump($this->tableau);
            }
            
            public function rewind()
            {
                echo 'Retour au début du tableau.</br>';
                reset($this->tableau);  // replace le pointeur au début du tableau.
            }

            public function valid()
            {
                $cle = key($this->tableau);
                $tableau = ($cle !== NULL && $cle !== FALSE);
                echo $cle . ' Valide: ';
                var_dump($tableau);
                echo '</br>';
                return $tableau;
            }

            public function current()
            {
                $tableau = current($this->tableau);
                // current() retourne la VALEUR de l’élément courant du tableau, c’est-à-dire de l’élément actuellement parcouru (l’élément au niveau duquel est situé le pointeur interne du tableau).
                echo 'Elément actuel: ' . $tableau . '.</br>';
                return $tableau;
            }

            public function key()
            
            {
                $tableau = key($this->tableau);
                // key() retourne la CLEF liée à la valeur de l’élément courant du tableau.
                echo 'Clé: ' . $tableau . '.</br>';
                return $tableau;
            }

            public function next()
            {
                $tableau = next($this->tableau);
                // next() avance le pointeur d’un élément et retourne la VALEUR de l’élément au niveau duquel se situe le pointeur.
                echo 'Elément suivant: ' . $tableau . '.</br>';
                return $tableau;
            }
        }

        echo '<u>Résultat:</u></br></br>';

        $tableauTest = ['C1'=>'V1', 'C2'=>'V2', 'C3'=>'V3'];
        $objet = new Pwet0008($tableauTest);
        $objet->info();
        foreach($objet as $k=>$v){
            echo 'Clef ' . $k . ' => ' . $v . '.</br></br>';
        }
    ?>
    <p><u><strong>Commentaires</strong></u>:</br>
    <u>Une première remarque</u>: une <em>méthode de classe</em> est un élément différent d’une <em>fonction en PHP</em>. En effet, la fonction <em>current()</em> par exemple est une fonction prédéfinie (ou prête à l’emploi) en PHP et on ne peut donc pas la redéfinir. <u>En revanche</u>, la <em>méthode current()</em> n’est pas prédéfinie et on va donc pouvoir définir son implémentation.</br>
    La classe implémente l’interface <em>Iterator</em>. Elle possède ici une propriété privée <em>$tableau</em> qui est un tableau vide au départ et définit un constructeur qui accepte un tableau en argument et le place dans la propriété privée <em>$tableau</em>. Ensuite, la classe se contente d’implémenter les méthodes de l’interface Iterator.</br>
    Il convient d’expliquer ce que font les <u>fonctions prédéfinies</u> <em>current(), next(), rewind() et key()</em> pour comprendre le code ci-dessus.</p>
    <p>La fonction <strong>reset()</strong> replace le pointeur interne au début du tableau et retourne la valeur du premier élément du tableau (avec une instruction de type return).</p>
    <p>La fonction <strong>current()</strong> retourne la valeur de l’élément courant du tableau, c’est-à-dire de l’élément actuellement parcouru (l’élément au niveau duquel est situé le pointeur interne du tableau).</p>
    <p>La fonction <strong>key()</strong> retourne la <u>clef</u> liée à la valeur de l’élément courant du tableau.</p>
    <p>La fonction <strong>next()</strong> avance le pointeur interne d’un tableau d’un élément et retourne la valeur de l’élément au niveau duquel se situe le pointeur.</p>
    <p>Une fois la classe définie, on l’instancie en lui passant un tableau associatif qui va être utilisé comme argument pour le constructeur.</br>
    Finalement, on utilise une boucle <em>foreach</em> pour parcourir l’objet créé à partir de la classe.</p>
    <p style="font-size: 1.1em;">Ce qu’il faut alors bien comprendre est que le <strong>PHP a un comportement bien défini</strong> lorsqu’on utilise un objet qui implémente l’interface <em>Iterator</em> et notamment lorsqu’on essaie de le parcourir avec une boucle foreach.</br>
    Expliquons précisément ce qui se passe dans le cas présent. Tout d’abord, on sait qu’une interface impose aux classes qui l’implémentent de définir toutes ses méthodes.</br>
    Lorsqu’on crée un objet qui implémente l’interface <em>Iterator</em>, le PHP sait donc que l’objet va posséder des méthodes rewind(), current(), key(), next() et valid() et il va donc pouvoir les exécuter <strong>selon un ordre prédéfini</strong>. </br>
    Lorsqu’on utilise une boucle <em>foreach</em> avec un objet qui implémente l’interface <em>Iterator</em>, le PHP va <strong>automatiquement</strong> 
        <ul>
            <li>commencer par appeler <em>Iterator::rewind()</em> avant le premier passage dans la boucle ce qui va dans notre cas afficher le texte <em>Retour au début du tableau</em> et va placer le pointeur interne du tableau au début de celui-ci,</li>
            <li>ensuite, avant chaque nouveau passage dans la boucle, <em>Iterator::valid()</em> est appelée et si false est retourné, on sort de la boucle,</li>
            <li>Dans le cas contraire,
                <ul>
                    <li><em>Iterator::current()</em></li>
                    <li>et <em>Iterator::key()</em> sont appelées.</li>
                </ul>
            </li>
            <li>Finalement, après chaque passage dans la boucle, <em>Iterator::next()</em> est appelée et on recommence l’appel aux mêmes méthodes dans le même ordre (excepté pour <em>rewind()</em> qui n’est appelée qu’une fois en tout début de boucle).</li>
        </ul>
    </p>
        <!-- ------------------------------------------------ -->
    <h2>Passage d’objets (en arguments) : identifiants et références</h2>
    <h3>Le passage (en arguments) de variables par valeur ou par <em>référence</em> (alias)</h3>
    <p>Nous avons vu qu’il existe deux façons de passer une variable (à une fonction par exemple) en PHP : 
        <ul>
            <li>on peut la passer par valeur (ce qui est le comportement par défaut),</li>
            <li>ou la passer par référence en utilisant le symbole <strong>&</strong>  devant le nom de la variable.</li>
        </ul>
    Lorsqu’on parle de <em>passage par référence</em> en PHP, on devrait en fait plutôt parler d’<strong>alias</strong> au sens strict du terme pour être cohérent par rapport à la plupart des autres langages de programmation.</br>
    <u>Un <em>alias</em> est un moyen d’accéder au contenu d’une même variable en utilisant un autre nom</u>. Pour le dire simplement, créer un alias signifie déclarer un autre nom de variable qui va partager la même valeur que la variable de départ.</br>
    Ainsi, lorsqu’on modifie la valeur de l’alias, on modifie également la valeur de la variable de base puisque ces deux éléments partagent la même valeur.</br>
    <u>Au contraire</u>, lorsqu’on passe une variable par valeur (ce qui est le comportement par défaut en PHP), on travaille avec une « copie » de la variable de départ: les deux copies sont alors indépendantes et lorsqu’on modifie le contenu de la copie, le contenu de la variable d’origine n’est pas modifié.</br>
    Démonstration (<span style="color: red;">voir code PHP</span>):</p>
    <?php
        $x=1;
        $y=$x;  // $y vaut 1
        $z=&$y;  // $z et $y auront toujours la même valeur: la dernière mise à jour
        $y=2;   // $z et $y valent 2
        $a=1;
        $b=2;
        $z=6;
        echo '$y vaut ' . $y .'</br>';
        $y=22;
        echo '$z vaut ' . $z .'</br>';

        echo '<u>Passage par valeur</u>:</br>';

        function passageParValeur($param){
            $param = 5;
            echo 'Valeur du paramètre dans la fonction = ' . $param . '</br></br>';
        }

        passageParValeur($a);

        echo 'Valeur du paramètre $a hors de la fonction = ' . $a . '</br></br>';

        echo '<u>Passage par référence</u>:</br>';
        
        function passageParReference(&$param){
            $param = 7;
            echo 'Valeur du paramètre dans la fonction = ' . $param . '</br></br>';
        }
        
        passageParReference($x);

        echo 'Valeur du paramètre hors de la fonction = ' . $x . '</br></br>';

        passageParReference($z);

        echo 'Valeur du paramètre $z hors de la fonction = ' . $z . '</br>';
        echo 'Valeur du paramètre $y hors de la fonction = ' . $y . '</br>';
    ?>
    <h3>Le passage des objets en PHP</h3>
    <p>Lorsqu’on crée une nouvelle instance de classe en PHP et qu’on assigne le résultat dans une variable, <u>on assigne pas véritablement l’objet en soi</u> à notre variable objet mais simplement un <strong>identifiant</strong> d’objet qu’on appelle également parfois un <em>pointeur</em>.</br>
    Cet identifiant sera utilisé pour accéder à l’objet en soi.</br>
    <u>La variable objet créée stocke donc un identifiant d’objet (<em>pointeur</em>)</u> qui permet lui-même d’accéder aux propriétés de l’objet.</br>
    Pour accéder à l’objet via son identifiant (<em>pointeur</em>), on va utiliser l’opérateur <em>-></em> qu’on connait bien. Ainsi,
        <ul>
            <li>lorsqu’on passe une variable objet en argument d’une fonction,</li>
            <li>lorsqu’on demande à une fonction de retourner une variable objet,</li>
            <li>lorsqu’on assigne une variable objet à une autre variable objet,</li>
        </ul>
    ce sont des <u>copies</u> de l’identifiant (<em>pointeur</em>) pointant vers le même objet qui sont passées.</br>
    Comme les copies de l’identifiant (<em>pointeur</em>) pointent toujours vers le même objet, on dit que <em>les objets sont passés par référence</em>. Ce n’est cependant pas strictement vrai: encore une fois, ce sont des identifiants d’objets (<em>pointeur</em>) pointant vers le même objet qui vont être passés par valeur.</p>
    <p>Regardez plutôt l’exemple suivant:</p>
    <p>
        <em>
            <pre>
        class Utilisateur{
            protected $user_name;
            public function __construct($name)
            {
                $this->user_name = $name;
            }
            public function getNom(){
                echo $this->user_name;
            }
            public function setNom($name){
                $this->user_name = $name;
            }
        }
        $roger = new Utilisateur('Roger');
        $roger->getNom();           // Roger
        $roger->setNom('Tom');  
        $roger->getNom();           // Tom
        $autre = $roger;
        $autre->getNom();           // Tom
        $autre->setNom('Tarzan');
        $roger->getNom();           // Tarzan
            </pre>
        </em>
    </p>
    <p>En effet, <em>$roger</em> et <em>$autre</em> contiennent deux copies d’identifiant (<em>pointeurs</em>) <u>permettant d’accéder au même objet</u>. <em><strong>C’est la raison pour laquelle le résultat ici peut faire penser que les objets ont été passés par référence</strong></em>. Ce n’est toutefois pas le cas, <u>ce sont des copies d’identifiant (<em>pointeur</em>) pointant vers le même objet</u> qui sont passées par valeur.</br>
    Pour passer un identifiant d’objet par référence, nous utiliserons le signe <strong>&</strong>.</p>
    <p>Regardez le nouvel exemple ci-dessous pour bien comprendre la différence entre un passage par référence et un passage par valeur via un identifiant:</p>
    <p>
        <em>
            <pre>
        class test2{
            public $x = 1;
            public function modif(){
                $this->x = 2;
            }
        }

        function tesZero($obj){
            $obj = 0;
        }

        function tesVraimentZero(&$obj){
            $obj = 0;
        }

        $variableObjet = new test2;
        $variableObjet->modif();
        echo 'Après modif(): ';     // object(test2)[3] public 'x' => int 2
        var_dump($variableObjet);
        tesZero($variableObjet);
        echo 'Après tesZero(): ';  // object(test2)[3] public 'x' => int 2
        var_dump($variableObjet);
        tesVraimentZero($variableObjet);
        echo 'Après tesVraimentZero(): '; // int 0
        var_dump($variableObjet);
                </pre>
        </em>
    </p>
    <p>On définit une classe <em>test2</em> qui contient une propriété et une méthode publiques et on instancie la classe puis on assigne l’identifiant d’objet à la variable objet $variableObjet.</br>
    On définit également deux fonctions en dehors de la classe.</br>
    On appelle ensuite la méthode <em>modif()</em> dont le rôle est de modifier la valeur de la propriété $x de l’objet courant puis on affiche les informations relatives à la objet grâce à <em>var_dump()</em>: on constate que la propriété $x stocke bien la valeur 2.</br>
    Ensuite, on utilise la fonction <em>tesZero()</em> en lui passant $variableObjet en argument: le rôle de cette fonction est d’assigner la valeur 0 à la variable passée en argument.</br>
    <u>Pourtant, lorsqu’on <em>var_dump()</em> à nouveau $variableObjet, on s’aperçoit que le même objet que précédemment est renvoyé</u>: cela est dû au fait qu’ici la fonction <em>tesZero()</em> n’a modifié que l’identifiant d’objet <em>(pointeur)</em> et non pas l’objet en soi.</br>
    La fonction <em>tesVraimentZero()</em> utilise -elle- le passage par référence <strong>&</strong>. Dans ce cas-là, c’est bien une référence à l’objet qui va être passée et on va donc bien pouvoir écraser l’objet cette fois-ci.</br>
    Précisons ici que ces notions sont des notions abstraites et complexes et qu’il faut généralement beaucoup de pratique et une très bonne connaissance au préalable du langage pour bien les comprendre et surtout comprendre leurs implications.</br>
    Si certaines choses vous échappent pour le moment, c’est tout à fait normal, car il faut du temps et du recul pour maitriser parfaitement un langage.</p>
</body>
</html>