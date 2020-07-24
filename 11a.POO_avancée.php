<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO avancée 1</title>
</head>
<body>
    <h1>Programmation orientée objet - Notions avancées</h1>

    <h2>Chainage de méthodes: principe et intérêt</h2>
    <p>Chainer des méthodes permet d’exécuter plusieurs méthodes d’affilée de façon simple et rapide en les écrivant à la suite les unes des autres, « en chaine ».</br>
    En pratique, il suffira d’utiliser l’opérateur d’objet pour chainer différentes méthodes. On écrira quelque chose de la forme <strong><em>$objet->methode1()->methode2()</em></strong>.</br>
    Cependant, pour pouvoir utiliser le chainage de méthodes, il faudra que les méthodes chainées retournent l'objet afin de pouvoir exécuter la méthode suivante. Dans le cas contraire, une erreur sera renvoyée.</p>

    <h2>Chainage de méthodes en pratique</h2>
    <p>Prenons immédiatement un exemple afin de bien comprendre comment fonctionne le chainage de méthodes. Pour cela, nous allons nous appuyer sur la classe Utilisateur10, qui aura deux nouvelles méthodes:</p>
    <p>
        <em>
            <pre>
    protected $x = 0;

    public function plusUn(){
        $this->x++;
        echo '$x vaut ' . $this->x;
        return $this;
    }

    public function moinsUn(){
        $this->x--;
        echo '$x vaut ' . $this->x;
        return $this;
    }
            </pre>
        </em>
    </p>
    <p><strong>Notez bien</strong> l’instruction <u><em>return $this</em></u> à la fin du code de chacune de nos deux méthodes.</br>
    <strong>Cette instruction est obligatoire</strong>. En effet, comme précisé plus haut, vous devez <u>impérativement</u> retourner l’objet en soi pour pouvoir utiliser le chainage de méthodes. Si vous omettez le <em>return $this</em> vous allez avoir une erreur.</br>
    La grande limitation des méthodes chainées est donc qu’on doit retourner l’objet afin que la méthode suivante s’exécute. On ne peut donc pas utiliser nos méthodes pour retourner une quelconque autre valeur puisqu’on ne peut retourner qu’une chose en PHP.</p>
    <p>Test de: <em>$pierre->plusUn()->plusUn()->moinsUn()->plusUn();</em></p>
    <?php
        require './classes/admin10.class.php';

        $pierre = new Admin10('Pierre', 'Nord', '2525');
        $pierre->plusUn()->plusUn()->moinsUn()->plusUn();
    ?>

    <h2>Closures et classes anonymes</h2>
    <p>Les <u>fonctions anonymes, ou closures</u>, sont des fonctions qui ne possèdent pas de nom.</br>
    On créé une fonction anonyme de la même façon qu'une fonction normale à la différence qu’on ne va ici pas préciser de nom:
    </p>
    <p>
        <em>
            <pre>
        function(){
            echo 'Fonction anonyme bien exécutée';
        }
            </pre>
        </em>
    </p>
    <?php
        function(){
            echo 'Fonction anonyme bien exécutée';
        }
    ?>

    <h3>Appel d'une fonction anonyme</h3>
    <p>Depuis PHP 7, il existe trois moyens simples d’appeler une fonction anonyme :
        <ol>
            <li>en les auto-invoquant,</li>
            <li>en les utilisant comme fonctions de rappel,</li>
            <li>en les utilisant comme valeurs de variables.</li>
        </ol>
    </p>
    <h4>Auto-invoquer une fonction anonyme</h4>
    <p>Auto-invoquer une fonction anonyme, c’est faire en sorte qu’elle s’appelle elle-même  de manière automatique. Pour cela, il suffit
        <ul>
            <li>d’entourer la fonction anonyme d’un premier couple de parenthèses</li>
            <li>et d’ajouter un autre couple de parenthèses à la suite du premier couple</li>
        </ul>
    comme cela :</p>
    <p>
        <em>
            <pre>
    (function(){
        echo 'Fonction anonyme bien exécutée';
    })();
            </pre>
        </em>
    </p>
    <?php
    (function(){
        echo 'Fonction anonyme bien exécutée';
    })();
    ?>
    <p>Créer des fonctions anonymes auto-invoquées est très intéressant <em>lorsqu’on ne voudra  effectuer une tâche qu’une seule fois</em>. Dans ce cas-là, en effet, il n’y a aucun intérêt de créer une fonction classique. </br>
    Par ailleurs, dans certains codes, <em>nous n’avons pas la possibilité d'appeler une fonction manuellement, il faut alors que la fonction s’exécute automatiquement</em>.</p>
    <h4>Utiliser une fonction anonyme comme fonction de rappel</h4>
    <p><u>Une fonction de rappel est une fonction qui va être appelée par une autre fonction</u>.</br>
    Pour ça, il faut passer la fonction de rappel en argument de la fonction appelante.</br>
    Les fonctions de rappel peuvent être de simples fonctions nommées, des fonctions anonymes, des méthodes d’objets ou des méthodes statiques <span style="font-size: 0.7em;">(rappel: une méthode statique est une méthode qui ne va pas appartenir à une instance de classe ou à un objet en particulier mais qui va plutôt appartenir à la classe dans laquelle elle a été définie)</span>.</br>
        <ul>
            <li>Dans le cas d’une fonction de rappel nommée, nous passerons le nom de la fonction de rappel en argument de la fonction appelante.</li>
            <li>Dans le cas d’une fonction de rappel anonyme, nous enfermerons la fonction dans une variable qu’on passera en argument de la fonction qui va l’appeler.</li>
        </ul>
    <strong>Remarque:</strong> toutes les fonctions n’acceptent pas des fonctions de rappel en arguments.</br>
    Seulement certaines comme la fonction usort() par exemple qui va servir à trier un tableau en utilisant une fonction de comparaison ou encore la fonction array_map() qui est la fonction généralement utilisée pour illustrer l’intérêt des closures.</br>
    La fonction array_map() va appliquer une fonction sur des éléments d’un tableau et retourner un nouveau tableau. On devra donc passer deux arguments à celle-ci : une fonction qui sera dans ce cas une closure et un tableau:</p>
    <p>
        <em>
            <pre>
        Voici une closure appelée $carre: 
        $carre = function(float $x){
            return $x**2;
        };

        $montableau = [1, 2, 3, 4];
        $nouveauTableau = array_map($carre, $montableau);
        print_r($nouveauTableau);
            </pre>
        </em>
    </p>
    <?php
        // Voici une closure:
        $carre = function(float $x){
            return $x**2;
        };

        $montableau = [1, 2, 3, 4];
        $nouveauTableau = array_map($carre, $montableau);
        echo '<pre> Le nouveau tableau: </br>';
        print_r($nouveauTableau);
        echo '</pre>';
    ?>
    <h4>Appeler des fonctions anonymes en utilisant des variables</h4>
    <p><u>Lorsqu’on assigne une fonction anonyme en valeur de variable, cette variable va automatiquement devenir un objet de la classe prédéfinie <em>Closure</em></u>.</br>
    La classe <em>Closure</em> possède des méthodes qui permettent de contrôler une closure après sa création.</br>
    Cette classe possède également une méthode magique <em>__invoke()</em> qui s'avère très utile puisqu’elle permet d'exécuter les closures simplement. <span style="font-size: 0.7em;">Rappel: la méthode <em>__invoke()</em> s’exécute dès qu’on se sert d’un objet comme d’une fonction</span>.</br>
    Cela va permettre d’utiliser la syntaxe suivante pour appeler les fonctions anonymes:</p>
    <p>
        <em>
            <pre>
        $texte = function(){
            echo 'Exécution d\'une fonction anonyme en utilisant une variable.';
        };
        $texte();
            </pre>
        </em>
    </p>
    <?php
        $texte = function(){
            echo 'Exécution d\'une fonction anonyme en utilisant une variable.';
        };
        $texte();
    ?>

    <h2>Définition et intérêt des classes anonymes</h2>
    <p>Les classes anonymes ont été implémentées récemment en PHP, puisque leur support n’a été ajouté qu’avec le PHP 7.</br>
    Les classes anonymes sont des classes qui ne possèdent pas de nom. On peut les stocker dans une variable. <u>Elles sont utiles dans le cas ou des objets simples et uniques ont besoin d’être créés à la volée (??? mais encore ...)</u>.</br>
    Créer des classes anonymes sert donc principalement à faire gagner du temps. On passera des arguments aux classes anonymes via la méthode constructeur et celles-ci pourront étendre d’autres classes ou encore implémenter des interfaces et (???)<em>utiliser des traits</em>(???) comme le ferait une classe ordinaire.</br>
    Notez qu’on pourra aussi imbriquer une classe anonyme à l’intérieur d’une autre classe. Toutefois, on n’aura dans ce cas pas accès aux méthodes ou propriétés privées ou protégées de la classe contenante. Pour utiliser des méthodes ou propriétés protégées de la classe contenante, la classe anonyme doit étendre celle-ci. Pour utiliser les propriétés privées de la classe contenant dans la classe anonyme, il faudra les passer via le constructeur.</p>
    <h3>Exemples</h3>
    <p>Création d'une classe anonyme stockée dans une variable qui devient de fait un objet:</p>
    <p>
        <em>
            <pre>
        $maClasseAnonyme = new class{
            public $userName;
            public const BONJOUR = 'bonjour';

            public function setNom($nom){
                $this->userName = $nom;
            }
            public function getNom(){
                return 'Le nom de l\'objet est: ' . $this->userName;
            }
        };
        $maClasseAnonyme->setNom('Roger');
        var_dump($maClasseAnonyme);
        echo $maClasseAnonyme->getNom();
            </pre>
        </em>
    </p>
    <?php
        $maClasseAnonyme = new class{
            public $userName;
            public const BONJOUR = 'bonjour';

            public function setNom($nom){
                $this->userName = $nom;
            }
            public function getNom(){
                return 'Le nom de l\'objet est: ' . $this->userName;
            }
        };
        $maClasseAnonyme->setNom('Roger');
        var_dump($maClasseAnonyme);
        echo $maClasseAnonyme->getNom() . '</br>';
    ?>
    <p>On peut encore assigner une classe anonyme à une variable en passant par une fonction:</p>
    <p>
        <em>
            <pre>
    function toto(){
        return new class{
            public $userName;
            public const BONJOUR = 'Bonjour';

            public function setNom($nom){
                $this->userName = $nom;
            }
            public function getNom(){
                return 'Le nom de l\'objet est: ' . $this->userName;
            }
        };
    }
    // on assigne la fonction à une variable $tintin: $tintin devient donc la classe anonyme
    $tintin = toto();
    // et donc $tintin acquiert les méthodes, propriétés et constantes de la classe anonyme
    $tintin->setNom('Tintin');
    echo $tintin::BONJOUR;
    echo $tintin->getNom();
            </pre>
        </em>
    </p>
    <?php
    // création d'une fonction nommée; elle créé une classe anonyme
    function toto(){
        return new class{
            public $userName;
            public const BONJOUR = 'Bonjour';

            public function setNom($nom){
                $this->userName = $nom;
            }
            public function getNom(){
                return 'Le nom de l\'objet est: ' . $this->userName;
            }
        };
    }
    // on assigne la fonction à une variable $tintin: $tintin devient donc la classe anonyme
    $tintin = toto();
    // et donc $tintin acquiert les méthodes, propriétés et constantes de la classe anonyme
    $tintin->setNom('Tintin');
    echo $tintin::BONJOUR;
    echo '</br>';
    echo $tintin->getNom();
    echo '</br>';
    ?>
    <p>Finalement, on peut également passer des arguments à une classe anonyme pour créer un constructeur.</p>
    <p>
        <em>
            <pre>
        function createClasseAnonyme($nom){
            return new class($nom){
                public $userName;
    
                public function __construct($nom){
                    $this->userName = $nom;
                }
                public function getNom(){
                    return 'Le nom de l\'objet est: ' . $this->userName;
                }
            };
        }

        $plouf = createClasseAnonyme('Machin');
        echo $plouf->getNom();
            </pre>
        </em>
    </p>
    <?php
        function createClasseAnonyme($nom){
            return new class($nom){
                public $userName;
    
                public function __construct($nom){
                    $this->userName = $nom;
                }
                public function getNom(){
                    return 'Le nom de l\'objet est: ' . $this->userName;
                }
            };
        }

        $plouf = createClasseAnonyme('Machin');
        echo $plouf->getNom();
    ?>
    <p>Finalement, retenez que <u>dans le cas où une classe anonyme est imbriquée dans une autre classe, la classe anonyme doit l’étendre afin de pouvoir utiliser ses propriétés et méthodes <strong>protégées</strong></u>.</br>
    Pour utiliser ses méthodes et propriétés privées, alors il faudra également les passer via le constructeur. Regardez plutôt l’exemple suivant :</p>
    <p>
        <em>
            <pre>
        class Parente{
            // propriété privée nécessitera un constructeur
            private $age = 30;    
            // propriété protégée
            protected $nom = 'Manon';   

            // on créé la fonction qui doit fabriquer une classe
            public function creationClasseAnonyme(){
                // extends pour récupérer les propriétés protégées
                return new class($this->age) extends Parente{ 
                
                    private $ageEnfant;
                    public function __construct($age)
                    {
                        $this->ageEnfant = $age;
                    }
                    public function getDatas(){
                        echo 'Nom: '. $this->nom . '. Age: ' . $this->ageEnfant;
                    }
                };
            }
        }
        $haddock = new Parente;
        $haddock->creationClasseAnonyme()->getDatas();
            </pre>
        </em>
    </p>
    <?php
        class Parente{
            // propriété privée nécessitera un constructeur
            private $age = 30;    
            // propriété protégée
            protected $nom = 'Manon';   

            // on créé la fonction qui doit fabriquer une classe
            public function creationClasseAnonyme(){
                // extends pour récupérer les propriétés protégées
                return new class($this->age) extends Parente{ 
                
                    private $ageEnfant;
                    public function __construct($age)
                    {
                        $this->ageEnfant = $age;
                    }
                    public function getDatas(){
                        echo 'Nom: '. $this->nom . '. Age: ' . $this->ageEnfant . '.</br>';
                    }
                };
            }
        }
        $haddock = new Parente;
        $haddock->creationClasseAnonyme()->getDatas();
    ?>
</body>
</html>