<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redéfinition et interpolation</title>
</head>
<body>
    <h1>Notion de redéfinition et d'interpolation</h1>
    <p>La classe "Contremaitre2" hérite de la méthode presentation() de la classe "Employe2".</br>
    Mais comment fait-on si on veut que la classe "Contremaitre2" se présente différemment ?</br>
    Nous avons la la classe "Employe2":</p>
    <?php
        class Employe2 {
            public $nom;
            private $age;

            public function __construct($nom, $age){
                $this->nom = $nom;
                $this->setAge($age);
            }
            public function setAge($age){
                if(is_int($age) && $age > 1 && $age < 70){
                    $this->age = $age;
                } else {
                    throw new Exception("L'âge doit être un entier compris entre 1 et 70.");
                }
            }
            public function getAge(){
                return $this->age;
            }
            public function presentation(){
                echo "Salut, je suis $this->nom, et j'ai $this->age ans.</br>";
            }
        }

        $employeRoger = new Employe2("Roger", 49);
        $employeRoger->presentation();
        $employeRoger->setAge(56);
        $employeRoger->presentation();
    ?>
    <p>On créé une classe "Contremaitre2" qui étend la classe "Employe2".</p>
    <?php
        class Contremaitre2 extends Employe2 {
            public $auto;

            public function __construct($nom, $age, $auto){
                parent::__construct($nom, $age);
                $this->auto = $auto;
            }
            public function conduire(){
                echo "Le contremaître $this->nom conduit une $this->auto.</br>";
            }
            public function presentation(){
                echo "Bonjour, je suis $this->nom, et j'ai {$this->getAge()} ans.</br>";
            }
        }
        $contremaitreSimon = new Contremaitre2("Simon", 30, "Mazda");
        $contremaitreSimon->presentation();
        $contremaitreSimon->conduire();
    ?>
    <p>La présentation est forcément la même pour les 2 classes à ce stade puisqu'une classe hérite de la méthode de l'autre classe.</br>
    Comment faire si le contremaître doit dire "Bonjour" au lieu de "Salut" ?</br>
    On peut réécrire ("<em>SPECIALISER</em>") la fonction presentation() dans la classe "Contremaitre"; on appelle cela une "<em>REDÉFINITION</em>".</p>
    <p>Si on recopie la fonction presentation() de la classe "Employe" en changeant simplement le "Salut" en "Bonjour", <u>ça va planter</u>.</br>
    <strong>Pourquoi ?</strong> : parce que la nouvelle fonction presentation() que nous écrivons dans la classe "Contremaitre" appelle la variable $age, or <em>cette variable reçue pas héritage est <strong>privée</strong> !</em> On en peut donc pas y avoir accès de l'extérieur.</br>
    Mais si la variable est privée, la fonction getAge(), elle, est bien publique: on peut donc l'appeler pour afficher l'âge, genre "j'ai <strong>{</strong>$this->getAge()<strong>}</strong> ans.".</br>
    <span style="font-size: 1.2em;">Cette syntaxe <strong>entre accolades {}</strong> s'appelle une <u>INTERPOLLATION</u>.</span>
    </p>
    <p>En définitive, elle consiste simplemnt à récupérer une variable privée via son GETTER.</p>
    <h2>La portée "protected"</h2>
    <p>Il existe une manière plus "propre" est de changer la portée "private" en porte <u>"protected"</u>.</br>
    Ce système donne la possibilité aux classes qui héritent d'une variable d'en lire/modifier la propriété sans pour autant rendre cette variable publique: <em>protected $age;</em>.

    </p>
</body>
</html>