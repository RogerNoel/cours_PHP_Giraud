<?php
    setcookie('utilisateur', 'Roger NOEL');
    setcookie('preferences', 'dark_theme', time()+3600*24, '/', '', false, false);
    setcookie('ville', 'Jalhay');
    setcookie('ville', 'Spa');
    setcookie('preferences', '', time()-5);
    // nom - valeur - expiration - chemin - domaine - secure - httponly
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les cookies</title>
</head>
<body>
    <h1>Les cookies</h1>
    <h2>Présentation des cookies</h2>
    <p>Un cookie est un petit fichier texte qui ne peut contenir qu’une quantité limitée de données. Ils sont stockés sur les ordinateurs de vos visiteurs. </br>
    Les cookies vont toujours avoir une durée de vie limitée: on peut définir la date d’expiration d’un cookie.</br>
    Ils servent à faciliter la vie des utilisateurs en préenregistrant des données les concernant comme un nom d’utilisateur par exemple. Ainsi, dès qu’un utilisateur connu demande à accéder à une page de notre site, les cookies seront automatiquement envoyées dans la requête de l’utilisateur. Cela va nous permettre de l’identifier et de lui proposer une page personnalisée.</p>
    <h2>Créer un cookie</h2>
    <p>Pour créer un cookie en PHP, nous allons utiliser la fonction <strong>setcookie()</strong>.</br>
    <u>Une particularité notable de cette fonction est qu’il va falloir l’appeler avant d’écrire tout code HTML</u> (voir la permière ligne de code de cette page) pour qu’elle fonctionne puisque les cookies doivent être envoyés avant toute autre sortie.</br>
    Cette fonction peut accepter jusqu’à sept valeurs en arguments. Cependant, seul la première (le nom du cookie créé) est obligatoire.</br>
    Liste des arguments:
        <ul>
            <li>name: le nom du cookie</li>
            <li>value: valeur du cookie, aucune info sensible ne peut y être stockée !</li>
            <li>expires: timestamp ou, par défaut, fin de la session</li>
            <li>path: le chemin sur le serveur sur lequel le cookie sera disponible (?? pas clair !!)</li>
            <li>domain: indique le domaine ou sous-domaine pour lequel le cookie est disponible</li>
            <li>secure: indique si le cookie ne peut être transmis qu'au travers dune HTTPS</li>
            <li>httponly: indique si le cookie ne doit être accessible que par le protocole HTTP</li>
        </ul>
    </p>
    <h2>Récupération du cookie</h2>
    <?php
        var_dump($_COOKIE);
        if(isset($_COOKIE['utilisateur']) && isset($_COOKIE['ville']) ) {
            echo $_COOKIE['utilisateur'] . ' habite à ' . $_COOKIE['ville'] . '</br>';
        }
    ?>
    <h2>Modifier la valeur d'un cookie - Supprimer un cookie</h2>
    <p>Pour <u>modifier</u> la valeur d’un cookie, il faut appeler à nouveau setcookie() en lui passant le nom du cookie dont on souhaite changer la valeur et changer l’argument de type valeur passé à la fonction avec la nouvelle valeur souhaitée.</br>
    Pour <u>supprimer</u> un cookie, il faut appeler setcookie() en lui passant le nom du cookie qu’on souhaite supprimer et avec une date d’expiration déjà passée <em>time()-5</em> .</p>
</body>
</html>