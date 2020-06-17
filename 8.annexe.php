<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curseur</title>
</head>
<body>
    <h1>Tests sur curseur</h1>
    <p>Création d'un fichier testCurseur.txt pour faire les tests.</p>
    <?php
        echo nl2br(file_get_contents('testCurseur.txt'));
        $ressource = fopen('testCurseur.txt', 'rb');
        fseek($ressource, 30);
        echo '</br>';
        echo 'Position du curseur = ' . ftell($ressource) . '</br>';
        echo 'Position ' . ftell($ressource) . ' = ' . fgetc($ressource) . '</br>'; // fgetc() a fait avancer le curseur d'une position
        echo 'Position ' . ftell($ressource) . ' = ' . fgetc($ressource) . '</br>'; // fgetc() a fait avancer le curseur d'une position
        echo 'Position ' . ftell($ressource) . ' = ' . fgetc($ressource) . '</br>'; // fgetc() a fait avancer le curseur d'une position
        fseek($ressource, -20, SEEK_CUR);
        echo 'Position ' . ftell($ressource) . ' = ' . fgetc($ressource) . '</br>'; // fgetc() a fait avancer le curseur d'une position
        echo 'Ramener le curseur au début avec rewind()</br>';
        rewind($ressource);
        //----------------------------
        echo 'Position ' . ftell($ressource) . ' = ' . fgetc($ressource) . '</br>'; // fgetc() a fait avancer le curseur d'une position, donc position 1
        fseek($ressource, 5, SEEK_CUR); // donc position 6
        echo fgetc($ressource).'</br>'; // fgetc() a mis en position 7
        echo fgetc($ressource).' en position ' . ftell($ressource) . '</br>'; // position 8
        fgetc($ressource); // position 9
        fgetc($ressource); // position 10
        fgetc($ressource); // position 11
        fgetc($ressource); // position 12
        echo 'Position curseur = ' . ftell($ressource) . '</br>';
    ?>
</body>
</html>