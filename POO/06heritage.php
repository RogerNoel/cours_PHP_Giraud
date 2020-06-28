<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Héritage</title>
</head>
<body>
    <h1>Notion d'héritage des objets</h1>
    <p>Nous avons notre classe "Employe":</p>
    <?php
        class Employe {
            public $nom;
            public $prenom;
            private $age;

            function __construct($nom, $prenom, $age){
                $this->nom = $nom;
                $this->prenom = $prenom;
                $this->setAge($age);
            }
            public function getAge(){
                return $this->age;
            }
            public function setAge($age){
                if(is_int($age) && $age > 0 && $age < 70){
                    $this->age = $age;
                } else {
                    throw new Exception("L'âge doit être un nombre compris entre 1 et 70");
                }
            }
            public function presentation(){
                echo "Bonjour, je m'appelle $this->prenom $this->nom et j'ai $this->age ans.</br>";
            }
        }
        $employeRoger = new Employe("NOEL", "Roger", 30);
        $employeRoger->presentation();
    ?>
    <p>Supposons qu'on veuille créer une classe "Contremaitre" qui aurait exactement les mêmes spécificités que la classe "Employe" avec en plus une méthode "conduire" et une voiture de fonction.</p>
    <p>Pour créer cette classe on devrait donc recopier entièrement le contenu de la classe "Employe" en y ajoutant les spécificités, nous aurions donc une répétition du code.</br>
    On peut considérer que cette classe "Contremaitre" est une classe "Employe" étendue: le mot-clef "extends" va recopier toutes les valeurs et méthodes d'une classe vers une nouvelle classe afin de ne pas tout recopier.</p>
    <?php
        class Contremaitre extends Employe {
            public $voiture;

            public function __construct($nom, $prenom, $age, $voiture){
                // pour ce qui concerne le nom, le prénom et l'âge, on peut réutiliser le constructeur de la classe parente, il suffit d'utiliser l'opérateur de portée ::
                parent::__construct($nom, $prenom, $age);
                $this->voiture = $voiture;
            }
            public function conduire(){
                echo "Le contremaître $this->prenom roule avec une $this->voiture.</br>";
            }
        }

        $contremaitreJean = new Contremaitre("LATRUIE", "Jean", 40, "Opel");
        $contremaitreJean->presentation();
        $contremaitreJean->conduire();
        $contremaitreJean->setAge(42);
        print_r($contremaitreJean);
    ?>
    <p style="font-size: 1.2em;">Les gros avantages de l'héritage sont 
        <ul>
            <li style="font-size: 1.2em;">qu'on évite de recopier beaucoup de code et,</li>
            <li style="font-size: 1.2em;">qu'il suffit de changer une méthode dans la classe parente pour automatiquement mettre à jour toutes les classes qui ont hérité de cette méthode.</li>
        </ul>
    </p>
</body>
</html>