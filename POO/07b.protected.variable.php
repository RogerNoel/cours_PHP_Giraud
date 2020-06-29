<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variable protégée</title>
</head>
<body>
    <h1>Reprise des classes "Parent" et "Enfant" en utilisant la portée "protected".</h1>
    <?php
        class Papa {
            public $prenom;
            protected $age;

            public function getAge(){
                return $this->age;
            }
            public function setAge($age){
                if(is_int($age)){
                    $this->age = $age;
                } else {
                    throw new Exception("L'âge doit être un nombre.");
                }
            }
            public function __construct($age, $prenom){
                $this->prenom = $prenom;
                $this->setAge($age);
            }
            public function presentation(){
                echo "Je suis $this->prenom et j'ai $this->age ans.</br>";
            }
        }
        $roger = new Papa(30, "Roger");
        $roger->presentation();
        $roger->setAge(50);
        $roger->presentation();
        // print_r($roger->age); test sur protected
        class Mome extends Papa {
            public $jouet;
            public function __construct($age, $prenom, $jouet){
                parent::__construct($age, $prenom);
                $this->jouet = $jouet;
            }
            public function presentation(){
                echo "AREUUUUH je suis $this->prenom et j'ai $this->age ans.</br>";
            }
            public function jouer(){
                echo "Je joue avec mon jouet $this->jouet.</br>";
            }
        }

        $manon = new Mome(9, "Manon", "Lego");
        $manon->presentation();
        $manon->setAge(10);
        print_r($manon);
        echo '</br>'.$manon->getAge().' ans</br>';
        $manon->presentation();
        $manon->setAge(20);
        $manon->presentation();
        $manon->jouer();
    ?>
</body>
</html>