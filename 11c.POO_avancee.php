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
    <p><em>Voir ici création de la classe en PHP</em></p>
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
            // retourne la VALEUR de l’élément courant du tableau, c’est-à-dire de l’élément actuellement parcouru (l’élément au niveau duquel est situé le pointeur interne du tableau).
            {
                $tableau = current($this->tableau);
                echo 'Elément actuel: ' . $tableau . '.</br>';
                return $tableau;
            }

            public function key()
            // retourne la CLEF liée à la valeur de l’élément courant du tableau.
            {
                $tableau = key($this->tableau);
                echo 'Clé: ' . $tableau . '.</br>';
                return $tableau;
            }

            public function next()
            // avance le pointeur d’un élément et retourne la VALEUR de l’élément au niveau duquel se situe le pointeur.
            {
                $tableau = next($this->tableau);
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
    <p>Ce qu’il faut alors bien comprendre est que le <strong>PHP a un comportement bien défini</strong> lorsqu’on utilise un objet qui implémente l’interface <em>Iterator</em> et notamment lorsqu’on essaie de le parcourir avec une boucle foreach.</br>
    Expliquons précisément ce qui se passe dans le cas présent. Tout d’abord, on sait qu’une interface impose aux classes qui l’implémentent de définir toutes ses méthodes.</br>
    Lorsqu’on crée un objet qui implémente l’interface <em>Iterator</em>, le PHP sait donc que l’objet va posséder des méthodes rewind(), current(), key(), next() et valid() et il va donc pouvoir les exécuter <strong>selon un ordre prédéfini</strong>. </br>
    Lorsqu’on utilise une boucle <em>foreach</em> avec un objet qui implémente l’interface <em>Iterator</em>, le PHP va <strong>automatiquement</strong> 
        <ul>
            <li>commencer par appeler <em>Iterator::rewind()</em> avant le premier passage dans la boucle ce qui va dans notre cas <em>echo</em> le texte <em>Retour au début du tableau</em> et va placer le pointeur interne du tableau au début de celui-ci,</li>
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
</body>
</html>