<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abstraction</title>
</head>
<body>
    <h1>Notion d'abstraction</h1>
    <p>A ce stade, nous avons,
        <ul>
            <li> une <em>interface</em>,</li>
            <li>une classe <em>Employe</em> qui implémente cette interface,</li>
            <li>une classe <em>Patron</em> qui étend la classe Employe,</li>
            <li>et une fonction <em>faireTravailler($objet)</em>.</li>
        </ul>
    </p>
    <?php
    // L'interface
        interface Travailleur {
            public function travailler();
        }
    // le classe Employe
        class Employe implements Travailleur {
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
            public function travailler(){
                echo "$this->nom, $this->age ans, travaille sur une machine.</br>";
            }
        }
        $employeJean = new Employe(30, "Jean");
        echo ($employeJean->getAge().' ans</br>');
        $employeJean->presentation();
        $employeJean->setAge(32);
        $employeJean->presentation();
        $employeJean->travailler();
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
        $patronMax = new Patron("Max", 45, "Volvo");
        $patronMax->presentation();
        $patronMax->setAge(50);
        $patronMax->presentation();
        $patronMax->travailler();
        $patronMax->conduire();
        // creéation de la fonction faireTravailler()
        function faireTravailler(Travailleur $objet) {
            echo $objet->travailler();
        }
        faireTravailler($patronMax);
        faireTravailler($employeJean);
    ?>
</body>
</html>