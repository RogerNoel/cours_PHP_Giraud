<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encapsulation</title>
</head>
<body>
    <h1>Notion d'encapsulation</h1>
    <p>Il s'agit de sécuriser le code contre les erreurs. Par exemple assigner une chaîne de caractères où on attend un integer (l'âge par exemple). Et donc s'il y a des calculs avec l'âge, c'est le plantage assuré.</p>
    <?php
        class Employe {
            public $nom;
            public $prenom;
            private $age;

            function __construct($nom, $prenom, $age)
            {
                $this->nom = $nom;
                $this->prenom = $prenom;
                $this->age = $age;
            }

            function presentation(){
                echo "Nom: $this->nom Prenom: $this->prenom, Age: $this->age.</br>";
            }
        }

        $employe1 = new Employe("LATRUIE", "Jean", 25);
        $employe1->presentation();
        $employe1->prenom = "Marcel";
        $employe1->presentation();
        // $employe1->age = 30; --> ceci va provoquer une erreur car la propriété "age" est private et ne peut donc être accessible de l'extérieur.
        echo '</br>Mais nous voulons garder la possibilité de changer l\'âge de l\'extérieur: on va alors utiliser les notions de <em>GETTERS ou accesseurs</em> et de <em>SETTERS ou mutateurs</em></br>
        Ces getters et setters seront en réalité des fonctions forcément publiques:
        <ul>
            <li>la fonction getter devra simplement retourner la valeur de la propriété,</li>
            <li>la fonction setter contiendra du code pour attribuer une nouvelle valeur</li>
        </ul>';

        class EmployeV2 {
            public $nom;
            public $prenom;
            private $age;

            function __construct($nom, $prenom, $age)
            {
                $this->nom = $nom;
                $this->prenom = $prenom;
                $this->age = $age;
            }

            public function getAge(){ // ici le getter
                return $this->age;
            }

            public function setAge($age){ // ici le setter
                $this->age = $age;
            }

            function presentation(){
                echo "Nom: $this->nom Prenom: $this->prenom, Age: $this->age.</br>";
            }

        }

        $employe2 = new EmployeV2("DURAND", "Jean", 30);
        $employe2->presentation();
        $employe2->setAge(15);
        $employe2->presentation();

        echo '</br>On peut imaginer dans un premier temps que cela n\'empêchera pas forcément d\'entrer des valeurs erronées, mais nous verrons par après les possibilités pour affiner le code.</br>';
    ?>
</body>
</html>