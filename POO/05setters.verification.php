<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setters</title>
</head>
<body>
    <h1>Vérification des entrées via les setters</h1>
    <p style="font-size: 1.2em;" >Au bout de ce code, le constructeur sera lui-même protégé par une méthode interne à la classe, ceci représente la notion de <em>protection par encapsulation.</em> </p>
    <p>A ce stade rien n'empêche de coder <em>$objet->age = "string et non int"</em>: il y a toujours moyen de coder des données de type erroné.</p>
    <p>La solution consiste à faire des vérifications dans la fonction du setter, par exemple vérifier que l'entrée est un entier et qu'il est compris entre deux extrêmes</p>
    <p>En cas d'échec dans la vérification, le code renverra une exception.</p>
    <?php
        class Personnage {
            public $pseudo;
            private $age;

            function __construct(string $pseudo, int $age)
            {
                $this->pseudo = $pseudo;
                $this->setage($age);

            }

            function getage(){
                return $this->age;
            }

            public function setage($age){
                if(!is_integer($age)){
                    throw new Exception("L'âge doit être un nombre.");
                } elseif($age < 1 || $age > 99){
                    throw new Exception("L'âge doit être compris entre 1 et 99.");
                } else {
                    $this->age = $age;
                }
            }

            function show(){
                echo "Pseudo: $this->pseudo, âge: $this->age.</br>";
            }
        }

        $item = new Personnage("Taaaz", 40);
        $item->show();
        $item->setage(10);
        $item->show();
        $item->setage(20);
        $item->show();
    ?>
    <p>Le setter <em>setage()</em> est une fonction publique qui vérifie que les conditions sont réunies pour encoder un âge cohérent.</br>
    En plus, puisqu'on a défini ce setter en public, on peut déjà l'utiliser au moment de la construction <em>__construct()</em> pour procéder à la vérification de l'âge lors de la construction de l'objet.</p>
</body>
</html>