<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abstraction</title>
</head>
<body>
    <h1>Notion d'abstraction</h1>
    <h2>Les classes abstraites: un contrat plus poussé.</h2>
    <p>Une <strong>classe abstraite</strong>, c'est comme une interface qui a des propriétés et méthodes qui peuvent déjà être définies.</p>
    <p>Pour le coup, on va supprimer l'interface <em>Travailleur</em>.</p>
    <p>
        Et nous allons implémenter une classe <em>Humain</em>, qui aura un nom et un âge, une méthode <em>__construct()</em>, des getters/setters.</br>
        Le plus simple et le plus logique, dans notre cas, est de:
            <ul>
                <li>Transférer le code de la classe <em>employe</em> vers celle <em>Humain</em>,</li>
                <li>étendre la classe <em>Employe</em> à la classe <em>Humain</em></li>
            </ul>
        <strong>Attention:</strong> de manière similaire à ce que nous avions fait avec l'interface, nous allons implanter dans la classe <em>Humain</em> une méthode <em>travailler()</em> complètement vide.</br>
        Et cela implique deux choses:
            <ol>
                <li>cette méthode sera précédée du mot-clef <em>abstract</em> sinon ça va planter: <em>abstract public function travailler();</em> </li>
                <li>Et quand une classe possède au moins une méthode abstraite, elle doit AUSSI être précédée du mot-clef <em>abstract: abstract class Humain {}</em>.</li>
            </ol>
        <strong>DONC</strong> si une classe veut étendre la classe abstraite <em>Humain</em>, elle doit <u>obligatoirement</u> redéfinir la méthode <em>travailler()</em>.
    </p>
    <p><u>NOTE:</u> une classe abstraite ne peut que <em>extends</em> une autre classe: il n'est pas possible de l'instancier puisqu'elle contient des méthodes vides puisque abstraites. Et c'est là la raison de vivre de ces classes abstraites: éviter qu'un autre codeur ne l'instancie.</p>
    <p>Nous allons créer une classe <em>Etudiant</em> qui étend la classe <em>Humain</em> avec une méthode <em>Travailler()</em> qui lui est propre.</p>
    <p>L'interface Travailleur n'existant plus, nous allons passer, en argument de la fonction <em>faireTravailler()</em> une instance de la classe <em>Humain</em>, comme ceci:</p>
    <p><em>function faireTravailler(Humain $objet){/<br>
    <span style="margin-left: 15px;">echo "Travail en cours: {$objet->travailler()};</span></br>
    }</em></p>
    <?php

    // le classe Humain qui doit être abstraite car elle contient au moins une méthode abstraite.
        abstract class Humain {
            public $nom;
            protected $age;

            public function __construct($age, $nom){
                $this->nom = $nom;
                $this->setage($age);
            }
            public function setAge($age){
                if(is_int($age) && $age > 1 && $age < 70){
                    $this->age = $age;
                } else {
                    throw new Exception("L'âge doit être un nombre compris entre 1 et 70.</br>");
                }
            }
            public function getAge(){
                return $this->age;
            }
            public function presentation(){
                echo "Salut, mon nom est $this->nom et j'ai $this->age ans.</br>";
            }
            abstract public function travailler();  //ABSTRACT
        }

        // la classe Employe qui étend la classe Humain et doit donc redéfinir la méthode travailler()
        class Employe extends Humain {
            public function travailler(){
                echo "L'employé $this->nom travaille.</br>";
            }
        }

        // la classe Etudiant qui étend la classe Humain et doit donc redéfinir la méthode travailler()
        
        class Etudiant extends Humain {
            public function travailler() {
                echo "Je me trouve un coin planqué pour glandouiller pendant que les autres triment.</br>";
            }
        }
        $etudiantDucon = new Etudiant(15, "Ducon");

        $employeJean = new Employe(30, "Jean");
        
        // création de la classe patron qui étend Employe et qui possède une voiture, une méthode conduire(), une méthode presentation() différente et une méthode travailler() différente
        class Patron extends Employe {
            public $voiture;

            public function __construct($age, $nom, $voiture){
                parent::__construct($nom, $age);
                $this->voiture = $voiture;
            }
            public function conduire(){
                echo "Le patron $this->nom conduit sa $this->voiture.</br>";
            }
            public function travailler(){
                echo "$this->nom est le patron et travaille dans son bureau.</br>";
            }
            public function presentation(){
                echo "Bonjour, je m'appelle $this->nom, j'ai $this->age ans et je suis le patron.</br>";
            }
        }
        // création d'un objet instance de la classe Patron, elle-même extension de la classe Employe, elle-même extension de la classe abstaite Humain
        $patronMax = new Patron("Max", 45, "Volvo");

        // création de la fonction faireTravailler()
        function faireTravailler(Humain $objet) {
            // Attention à mettre l'argument de echo() entre parenthèses !
            echo ("Travail en cours: {$objet->travailler()}"); 
        }
        faireTravailler($patronMax);
        faireTravailler($employeJean);
        faireTravailler($etudiantDucon);

        $employeJean->presentation();
        $patronMax->setAge(60);
        $patronMax->presentation();
    ?>
</body>
</html>