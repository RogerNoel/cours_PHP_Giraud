<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO partie 1</title>
</head>
<body>
    <h1>Partie 1: données non structurées</h1>
    <p>Nous créons différents personnages qui ont un nom, un prénom et un âge et une fonction presentation() qui prendra ces arguments.</p>
    <?php
        $prenom = "Roger";
        $nom = "Noel";
        $age = 56;

        $prenom2 = "Anja";
        $nom2 = "Huwe";
        $age2 = 33;

        function presentation($nom, $prenom, $age) {
            echo 'Mon nom est ' . $nom . ' ' . $prenom . ' et j\'ai ' . $age . ' ans.</br>';
        }

        presentation($nom, $prenom, $age);
        presentation($nom2, $prenom2, $age2);
    ?>
    <p><strong>Constatations:</strong></br>
        <ul>
            <li>Cela demande bcp de variables (1 nom par personne, 1 prenom par personne, etc...)</li>
            <li>Nous devons mettre les paramètres à chaque appel de la fonction.</li>
        </ul>
    </p>
    <p>Nous allons structurer le code via un outil qui s'appelle les <strong>classes</strong>.</br>
    <strong>Nota bene:</strong> le nom d'une classe commence toujours par une <EM>MAJUSCULE</EM>.</p>
</body>
</html>

