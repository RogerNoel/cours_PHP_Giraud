<?php
    session_start();
    $_SESSION['prenom'] = 'Manon';
    $_SESSION['ville'] = 'Theux';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session</title>
</head>
<body>
    <h1>Fichier "session"</h1>
    <p>En haut de ce fichier, une session est ouverte et des variables de session sont créées.</p>
    <p>TEST: je vais créer ici une nouvelle variable de session.</p>
    <?php
        $_SESSION['test'] = "ça marche !";
    ?>
    <p>On peut donc créer des variables de session n'importe où dans le scrit où une session est ouverte.</p>
    <?php
        var_dump($_SESSION);
        echo session_id();
    ?>
    
</body>
</html>