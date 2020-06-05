<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Includes</title>
</head>
<body>
    <h1>Titre du site</h1>
    <h2>Utilisation de "include" et "include_once"</h2>
    <?php
        include "./includes/menu.php";
        include_once "./includes/menu.php";
    ?>
    <p>Le suite du site sera lisible même si le "include" entraîne une erreur.</p>
</body>
</html>