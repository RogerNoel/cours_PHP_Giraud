<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les constructeurs</title>
</head>
<body>
    <h1>Notion de "constructeur"</h1>
    <p>Nous pouvons passer les propriétés de l'objet lors de sa création, en utilisant la fonction <strong>__construct()</strong></p>
    <p>Cette fonction sera automatiquement appelée à l'utilisation du mot-clé <em>new</em>.</p>
    <?php
        class Employe {
            public $nom;
            public $prenom;
            public $age;

            public function __construct($nom, $prenom, $age)
            {
                $this->nom = $nom;
                $this->prenom = $prenom;
                $this->age = $age;
            }

            public function presentation() {
                echo "Nom: $this->nom, Prénom: $this->prenom, âge: $this->age.</br>";
            }
        }

        $employe1 = new Employe("NOEL", "Roger", 56);
        $employe1->presentation();

        $employe2 = new Employe("DUMAS", "Alex", 50);
        $employe2->presentation();
        $employe2->age = 40;
        $employe2->presentation();
    ?>
    <p style="font-size: 1.3em;">La procédure de création des objets est plus rapide. Il faut maintenant pouvoir contrôler les valeurs qu'on donne à l'objet grâce à la notion d'<strong>ENCAPSULATION</strong>.</p>
</body>
</html>