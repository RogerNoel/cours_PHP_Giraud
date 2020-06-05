<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Include/require</title>
</head>
<body>
    <h1>Inclure des fichiers</h1>
    <p>Il existe 4 structures de contrôle pratiques pour créer un site web:
        <ol>
            <li>include</li>
            <li>require</li>
            <li>include_once</li>
            <li>require_once</li>
        </ol>
    Elles permettent d'inclure le contenu de fichiers de code à l'intérieur d'autres fichiers de code.</br>
    Plutôt que de réécrire tout le code relatif, par exemple, à un menu qui sera le même sur toutes les pages, il est plus commode d'enregistrer le code de ce menu dans un fichier séparé que l’on appellera par exemple <em>menu.php</em>, et faire de même pour le code relatif à une entête et à un pied de page puis ensuite inclure directement ces fichiers sur chacune de nos pages.</br>
    Pour inclure un fichier dans un autre fichier, il faudra préciser son emplacement par rapport au fichier qui contient l’instruction include ou require de la même façon qu’on pourrait le faire pour faire un lien en ou pour inclure une image en HTML.
    </p>
    <h2>Différences entre ces 4 opérateurs</h2>
    <p>La seule différence entre les instructions include et require va se situer dans la réponse du PHP dans le cas où le fichier ne peut pas être inclus pour une quelconque raison (fichier introuvable, indisponible, etc...).</p>
    <p>Dans ce cas, si l’inclusion a été tentée avec <em> <strong>include</strong> </em>, le PHP renverra <u>un simple avertissement</u>  et le reste du script s’exécutera quand même tandis que si la même chose se produit avec <em> <strong>require</strong> </em>, une <u>erreur fatale</u>  sera retournée par PHP et l’exécution du script s’arrêtera immédiatement. L’instruction require est donc plus « stricte » que include.</p>
    <p>La différence entre les instructions <em>include et require</em>  et leurs variantes <em>include_once et require_once</em>  est qu’on va pouvoir inclure <u>plusieurs fois un même fichier avec include et require</u> tandis qu’en utilisant include_once et require_once cela ne sera pas possible: un même fichier ne pourra être inclus <u>qu’une seule fois</u>  dans un autre fichier.</p>
</body>
</html>