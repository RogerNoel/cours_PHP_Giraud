<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requires</title>
</head>
<body>
    <h1>Utilisation de "require" et "require_once"</h1>
    <?php
        require "./includes/menu.php";
        require_once "./includes/menu.php";
    ?>
    <p>Le suite du site ne sera pas lisible s'il le un "require" entraîne une erreur car le code sera planté.</p>
</body>
</html>