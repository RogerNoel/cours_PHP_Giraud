<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les classes</title>
</head>
<body>
    <h1>Les classes</h1>
    <?php
        echo 'Commençons par créer un "blueprint" d\'un employé, on appellera ce "blueprint" une <em>classe</em>.</br>';

        class Employe {
            public $nom;
            public $prenom;
            public $age;

            public function presentation () {
                echo "Bonjour, je m'appelle $this->prenom $this->nom et j'ai $this->age ans.</br>";
            }
        }

        echo 'Avec le mot-clé <strong>new</strong>, on peut créer un <strong>objet</strong> qui sera une instance de cette <em>classe</em> à partir de laquelle il a été créé.</br>';

        $employe1 = new Employe();
        var_dump($employe1);
        $employe1->presentation();

        $employe1->nom = "NOEL";
        $employe1->prenom = "Roger";
        $employe1->age = 56;
        var_dump($employe1);

        $employe1->presentation();

        $employe2 = new Employe();

        $employe2->nom = "MARIE";
        $employe2->prenom = "Manon";
        $employe2->age = 25;

        $employe2 ->presentation();
    ?>
    <p> <strong>Une fonction qui appartient à un objet est une <em>méthode</em></br>
    Une variable qui appartient à un objet est une <em>propriété</em>.</strong></p>
    <p style="font-size: 1.3em;">Nous créons une instance de la classe et ensuite nous lui assignons des propriétés.</br>
    Nous allons voir la notion de <em>constructeur</em> pour passer les propriétés au moment de la création de l'objet. </p>
</body>
</html>