<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expressions rationnelles</title>
    <style>
        .med_underline { text-decoration: underline; font-size: 1.1em;}
        table { border-collapse: collapse; }
        td { padding: 5px; border: 1px solid black; }
    </style>
</head>
<body>
    <h1>Expressions rationnelles</h1>
    <p>Les expressions régulières ne font pas partie du langage PHP en soi. Elles vont s’avérer très pratiques, notamment pour vérifier la conformité formelle des données envoyées par des utilisateurs via des formulaires.</p>
    <h2>Présentation des expressions régulières</h2>
    <p>Une expression régulière (« regex ») est une séquence de caractères qu’on va définir et qui va nous servir de schéma de recherche. Elles vont nous permettre de vérifier la présence de certains caractères dans une chaine de caractères en évaluant cette chaine selon l’expression régulière passée.</p>
    <h2>Regex POSIX contre regex PCRE</h2>
    <p>Il existe deux types d’expressions régulières, possédant des syntaxes et des possibilités légèrement différentes : les expressions régulières POSIX et PCRE. Nous allons donc utiliser les PCRE, qui sont un type de regex dont la syntaxe est tirée du langage Perl.</p>
    <h2>Création de premières expressions régulières</h2>
    <p>Les expressions régulières vont être formées,
        <ul>
            <li>d’un assemblage de caractères qui formera un schéma de recherche,</li>
            <li>et de délimiteurs.</li>
        </ul>
    <strong>L’ensemble « schéma de recherche + délimiteurs » est également appelé « masque ».</strong>
    Les caractères vont pouvoir être des caractères simples ou des caractères spéciaux qui auront une signification particulière.</br>
    Un délimiteur peut être n’importe quel caractère, tant qu’il n’est pas alphanumérique, un caractère blanc, l’antislash (« \ ») ou le caractère nul. De plus, si le délimiteur choisi est réutilisé dans notre expression régulière, alors il faudra échapper ou « protéger » le caractère dans la regex en le précédant d’un antislash.</br>
    <strong>Pour le moment, je vous conseille d’utiliser le caractère slash (« / ») comme délimiteur</strong>.</br>
    <em>En PHP, nous enfermerons généralement nos regex dans des variables pour pouvoir les manipuler facilement</em>.</p>
    <p>Exemple: <em>$masque = '/pierre/';</em></p>
    <p>Ce schéma de recherche permet de rechercher la présence de la séquence « pierre » dans une chaine de caractères. En soi, ici, notre regex ne nous sert pas à grand-chose. Cependant, nous pourrons utiliser des fonctions pour -par exemple- valider la présence de notre schéma de recherche dans une chaîne de caractères.</br>
    Le grand intérêt des expressions régulières est qu’elles permettent d’effectuer des recherches très puissantes. En effet, dans le langage des expressions régulières, beaucoup de caractères possèdent un sens spécial, ce qui va nous permettre d’effectuer des recherches très précises.</p>
    <p>Par exemple, les regex possèdent des « options ». Ces options permettent d’ajouter des critères supplémentaires aux recherches. Elles sont représentées par des lettres.</br>
    La lettre <em>i</em>, par exemple, permet de rendre la regex insensible à la casse. Les options doivent être placées en fin de regex, <u>après le délimiteur</u>, comme ceci :</p>
    <p><em>$masque = '/pierre/i'</em></p>
    <p class="med_underline">Nous allons découvrir les fonctions PHP permettant d’exploiter toute la puissance des expressions régulières.</p>
    <p>PHP dispose de fonctions internes qui permettent d’utiliser les masques pour par exemple rechercher une expression dans une chaine, la remplacer par une autre, etc.</br>
    <strong>Les fonctions PHP relatives aux regex commencent toutes par <em>preg_</em></strong>.</br>
    Voici la liste de ces fonctions, que nous allons étudier par la suite, ainsi qu’une courte
    description de leur action.</p>
    <table>
        <thead>
            <td>FONCTION</td>
            <td>DESCRIPTION</td>
        </thead>
        <tr>
            <td>preg_filter()</td>
            <td>Recherche et remplace</td>           
        </tr>
        <tr>
            <td>preg_grep()</td>
            <td>Recherche et retourne un tableau avec les résultats</td>           
        </tr>
        <tr>
            <td>preg_last_error()</td>
            <td>Retourne le code d’erreur de la dernière regex exécutée</td>           
        </tr>
        <tr>
            <td>preg_match()</td>
            <td>Compare une regex à une chaine de caractères</td>           
        </tr>
        <tr>
            <td>preg_match_all()</td>
            <td>Compare une regex à une chaine de caractères et renvoie tous les résultats</td>           
        </tr>
        <tr>
            <td>preg_quote()</td>
            <td>Échappe les caractères spéciaux dans une chaine</td>           
        </tr>
        <tr>
            <td>preg_replace()</td>
            <td>Recherche et remplace</td>           
        </tr>
        <tr>
            <td>preg_replace_callback()</td>
            <td>Recherche et remplace en utilisant une fonction de rappel</td>           
        </tr>
        <tr>
            <td>preg_replace_callback_array()</td>
            <td>Recherche et remplace en utilisant une fonction de rappel</td>           
        </tr>
        <tr>
            <td>preg_split()</td>
            <td>Découpe une chaine</td>           
        </tr>
    </table>
    <p class="med_underline">Dans un premier temps, nous allons voir comment utiliser chacune de ces fonctions. Cela permettra de voir immédiatement l’utilité des regex.</br>
    Nous approfondirons par la suite le sujet des expressions régulières en soi.</p>
    <h2>Les fonctions <em>preg_match()</em> et <em>preg_match_all()</em></h2>
    <p>Les fonctions <em>preg_match() et preg_match_all()</em> vont être les fonctions qu’on va le plus utiliser avec les expressions régulières.</br>
    <strong>Ces deux fonctions permettent de rechercher un schéma dans une chaine de caractères.</strong></br>
    La fonction <strong>preg_match()</strong> va renvoyer la valeur 1 si le schéma recherché est trouvé dans la chaine de caractères ou 0 dans le cas contraire.</br>
    La fonction <strong>preg_match_all()</strong> va renvoyer le nombre total de fois où le schéma de recherche a été trouvé dans la chaîne de caractères sous <em>forme de tableau</em> (?? ça me renvoie un int). Chacune de ces deux fonctions va pouvoir accepter jusqu’à 5 arguments mais seuls 2 arguments sont obligatoires à leur fonctionnement. Ces deux arguments sont:
        <ul>
            <li>le masque ou schéma de recherche passé sous forme de chaine de caractères</li>
            <li>la chaine de caractères dans laquelle effectuer la recherche.</li>
        </ul>
    </p>
    <?php
        $texte = file_get_contents('./fichiers/fichier2.txt');
        $masque = '/hommes/';
        $masque2 = '/des/';
        var_dump(preg_match($masque, $texte ));
        var_dump(preg_match_all($masque2, $texte));
    ?>
    <p>On peut donc passer d’autres arguments aux fonctions preg_match() et preg_match_all(), elles permettent d’effectuer des recherches plus ciblées ou d’obtenir des informations supplémentaires au sujet de notre recherche.
        <ol>
            <li>Le premier argument facultatif sera une variable dans laquelle vont être stockés les résultats de la recherche sous forme d’un tableau.</br>
            Dans le cas de preg_match(), le tableau sera un tableau numéroté. Nous verrons plus loin des exemples concrets. </br>
            Dans le cas de preg_match_all(), le tableau sera un tableau multidimensionnel ordonné. Nous illustrerons cela lorsque nous aurons une plus grande connaissance des regex.</li>
            <li>Le deuxième argument facultatif de nos fonctions va être un drapeau (une constante) qui permet de modifier la façon dont notre tableau passé en argument précédent va être créé. Nous ne rentrerons pas dans un tel niveau de précision ici.</li>
            <li>Le dernier argument facultatif permet de préciser à partir de quel endroit la recherche doit commencer dans la chaine de caractères à scanner, ceci pour n’effectuer une recherche que sur une partie de chaine. On va ici passer une valeur en octets.</li>
        </ol>
    </p>
    <?php
        $masque3 = '/des/';
        echo 'Nombre de "des" dans le texte: ' . preg_match_all($masque3, $texte) . '</br>';
        preg_match_all($masque3, $texte, $tab2[]);
        echo '----------</br>';
        echo 'print_r de $tab2: </br>';
        print_r($tab2);
        echo '</br>----------</br>';
        echo 'var_dump de $tab2: </br>';
        var_dump($tab2);
    ?>
    259
</body>
</html>