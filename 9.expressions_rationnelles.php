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
        thead { text-align: center; }
        .first { text-align: center; font-size: 1.5em; }
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
    // $resultat = [];
        $texte = file_get_contents('./fichiers/fichier2.txt');
        $nom = 'Mon nom est Roger Noel';
        $masqueNom = '/o/';
        if(preg_match($masqueNom, $nom)){
            print_r(preg_match_all($masqueNom, $nom, $resultat));
            echo '</br>';
            var_dump($resultat);
        } else {
            echo 'le masque ne figure pas dans le texte.</br>';
        }
        $masque = '/hommes/';
        $masque2 = '/des/';
        var_dump(preg_match($masque, $texte));
        var_dump(preg_match_all($masque2, $texte));
    ?>
    <p>On peut donc passer d’autres arguments aux fonctions preg_match() et preg_match_all(), elles permettent d’effectuer des recherches plus ciblées ou d’obtenir des informations supplémentaires au sujet de notre recherche.
        <ol>
            <li>Le premier argument facultatif sera une variable dans laquelle vont être stockés les résultats de la recherche sous forme d’un tableau.</br>
            Dans le cas de preg_match(), le tableau sera un tableau numéroté. Nous verrons plus loin des exemples concrets. </br>
            Dans le cas de preg_match_all(), le tableau sera un tableau <u>multidimensionnel ordonné</u>. Nous illustrerons cela lorsque nous aurons une plus grande connaissance des regex.</li>
            <li>Le deuxième argument facultatif de nos fonctions va être un drapeau (une constante) qui permet de modifier la façon dont notre tableau passé en argument précédent va être créé. Nous ne rentrerons pas dans un tel niveau de précision ici.</li>
            <li>Le dernier argument facultatif permet de préciser à partir de quel endroit la recherche doit commencer dans la chaine de caractères à scanner, ceci pour n’effectuer une recherche que sur une partie de chaine. On va ici passer une valeur en octets.</li>
        </ol>
    </p>
    <?php
        $masque3 = '/des/';
        echo 'Nombre de "des" dans le texte: ' . preg_match_all($masque3, $texte) . '</br>';
        preg_match_all($masque3, $texte, $tab2);
        echo '----------</br>';
        echo 'print_r de $tab2: </br>';
        print_r($tab2);
        echo '</br>----------</br>';
        echo 'var_dump de $tab2: </br>';
        var_dump($tab2);
    ?>
    <h3>Etude de l'exemple de la page 259</h3>
    <?php
        echo '1. Initialisation du masque et de la chaîne.</br>';
        $masque = '/r/';
        $chaine = 'Je suis Pierre Giraud';
        echo '2. On fait un <em>preg_match($masque, $chaine, $match)</em>.</br>';
        echo '<strong><em>Conclusion:</em> 
            <ol>
                <li>On n\'est pas obligé d\'initialiser le tableau qui servira d\'argument.</li>
                <li>Quand on initie ce tableau directement en argument, on n\a pas besoin de mettre des crochets [].</li>
            </ol> </strong>';
        preg_match($masque, $chaine, $match);
        echo '3. Un tableau $match[] a été créé avec le résultat de la fonction, faisons un print_r() de ce tableau:</br>';
        print_r($match);
        echo '</br>4. Maintenant on fait un preg_match_all($masque, $chaine, $match_all) en créant donc un autre tableau.</br>';
        preg_match_all($masque, $chaine, $match_all);
        echo '5. On fait un print_r() de ce nouveau tableau $match_all;</br>';
        print_r($match_all);
        echo '</br><strong><em>6. Rappel:</em></strong> preg_match_all() sans l\'argument tableau renvoie le nombre d\'occurences trouvées: </br>';
        echo '7. Le nombre d\'occurences de ' . $match_all[0][0] . ' trouvées est: ' . preg_match_all($masque, $chaine) . '.</br>';
        echo '8. On récupère "l\'exemplaire" du masque soit avec $match[0], soit avec $match_all[0][0], en l\'occurence ici : ' . $match[0] . '.</br>';
        echo '9. Donc, nous avons vu que preg_match_all($masque, $chaine) renvoie le nombre d\'occcurences dans tout le document.</br>
        Et nous savons que pour déterminer une position de départ pour la recherche, il faut écrire cette position en 5° argument.</br>
        Mais pour écrire ce 5° argument, il faut bien écrire le 3° et le 4°, même s\'ils ne servent à rien, à savoir:
            <ul>
                <li>le 3°: c\'est-à-dire le tableau de récupération des résultats et</li>
                <li>le 4°: le flag, qui détermine la façon dont le tableau précédent sera créé.</li>
            </ul>
        Pour le tableau en 3° argument, on met le nom qu\'on veut puisqu\'on ne l\'utilisera pas; pour le 4° argument, on utilisera la constante PREG_PATTERN_ORDER qui est simplement la constante par défaut.</br>
        Et donc si on veut commencer la recherche à partir de la 8° position:</br>
        <em>preg_match_all($masque, $chaine, $onsenfout, PREG_PATTERN_ORDER, 8)</em>.';
        echo 'codons $res = preg_match_all($masque, $chaine) et faisons un print_r() du résultat:</br>';
        $res = preg_match_all($masque, $chaine, $x, PREG_PATTERN_ORDER, 8);
        print_r($res);
    ?>
    <h2>Les fonctions preg_filter(), preg_replace(), preg_replace_callback() et preg_replace_callback_array</h2>
    <p>La fonction <strong>preg_filter()</strong> permet d’effectuer une recherche dans une chaine de caractères selon un schéma de recherche et de remplacer les correspondances par une autre chaine.</br>
    On va passer trois arguments à cette fonction : un schéma de recherche, une chaine de remplacement et la chaine dans laquelle faire la recherche.</br>
    La fonction preg_filter() va ensuite renvoyer la chaine transformée mais <em>la chaine de départ ne sera pas modifiée</em>.</p>
    <?php
        $masque = '/tom/';
        $chaine = 'tomber';
        $chaineTransformee = preg_filter($masque, 'plom', $chaine);
        echo $chaine . ' est devenu ' . $chaineTransformee . '.</br>';
    ?>
    <p>La fonction <strong>preg_replace()</strong> fonctionne exactement comme preg_filter(). La différence entre ces deux fonctions va être dans la valeur retournée si le schéma de recherche n’est pas trouvé dans la chaine de caractères. En effet, dans ce cas-là, la fonction preg_filter() va renvoyer la valeur null (correspondant à l’absence de valeur) tandis que preg_replace() va renvoyer la chaine de caractères de départ.</p>
    <?php
        $masque = '/u/';
        $chaine = 'Roger';
        echo 'Test négatif avec preg_filter().</br>';
        echo 'La valeur renvoyée est:</br>';
        var_dump(preg_filter($masque, 'pwet', $chaine));
        echo 'Test négatif avec preg_replace(); la valeur renvoyée est:</br>';
        var_dump(preg_replace($masque, 'pwet', $chaine));
        echo 'La valeur renvoyé en cas d\'échec est donc bien la chaîne d\'origine.</br>';
    ?>
    <p>Finalement, les fonctions <strong>preg_replace_callback()</strong> et <strong>preg_replace_callback_array()</strong> fonctionnent selon le même principe général que preg_replace() à la différence qu’il faudra préciser <em>une fonction de rappel</em> plutôt qu’une valeur de remplacement.</br>
    Ce sujet est un peu complexe, nous laisserons donc cette fonction de côté pour l’instant.</p>
    <h2>La fonction preg_grep()</h2>
    <p>La fonction <strong>preg_grep()</strong> va nous permettre de rechercher un certain schéma dans un tableau. Les résultats trouvés (les correspondances) seront renvoyés dans un <u>nouveau tableau en conservant les indices du premier tableau</u>.</p>
    <?php
        $prenoms = ['nath', 'tom', 'manon', 'nathalie'];
        $masque = '/nath/';
        $newtab = preg_grep($masque, $prenoms);
        var_dump($newtab);
    ?>
    <h2>La fonction grep_split()</h2>
    <p>La fonction <strong>preg_split()</strong> va éclater une chaine de caractères en fonction d’un schéma de recherche et renvoyer un tableau.</br>
    A chaque fois que le schéma de recherche est trouvé dans la chaine de départ, preg_split() crée un nouvel élément dans le tableau renvoyé.</p>
    <?php
        $chaine = 'ephemere';
        $masque = '/e/';
        echo 'Exemple de preg_split() avec masque /e/ sur la chaîne "éphémère": </br>';
        var_dump(preg_split($masque, $chaine));
    ?>
    <h2>Fonction preg_quote()</h2>
    <p>La fonction <strong>preg_quote()</strong> va nous permettre d’échapper certains caractères spéciaux pour les regex. Utiliser preg_quote() correspond à placer un antislash (le caractère d’échappement ou de protection) devant chaque caractère spécial.Cette fonction peut s’avérer utile lorsque notre schéma de recherche possède beaucoup de caractères spéciaux dont on veut échapper le sens.</br>
    Nous reparlerons des caractères spéciaux et de l’échappement des caractères plus tard dans cette partie.</p>
    <h2>La fonction preg_last_error()</h2>
    <p>La fonction <strong>preg_last_error()</strong> va être surtout utilisée pour du <u>débogage</u>. En effet, celle-ci va retourner le code d’erreur correspondant à la dernière regex utilisée. <u>On pourra donc utiliser cette fonction lorsqu’une de nos regex ne fonctionne pas, afin d’avoir plus d’informations sur la nature du problème</u>.
    </p>
    <h1>Les classes de caractères des regex</h1>
    <p>Nous allons découvrir les classes de caractères et commencer à créer des masques relativement complexes et intéressants pour les expressions régulières.</p>
    <p>Les classes de caractères permettent de fournir <em>différents choix de correspondance</em> pour un caractère en spécifiant un ensemble de caractères qui vont pouvoir être trouvés. En d’autres termes, elles permettent de rechercher n’importe quel caractère d’une chaine qui fait partie de la classe de caractères fournie dans le masque.</br>
    Pour déclarer une classe de caractères dans notre masque, nous allons utiliser une paire de crochets [ ] qui vont délimiter la classe en question.</br>
    Prenons immédiatement un exemple concret en utilisant des classes de caractères simples:</p>
    <?php
        echo 'La chaine de caractères est: "Bonjour, je suis Roger Noel.".</br>';
        $chaine = 'Bonjour, je suis Roger Noel.';

        echo 'Résultat de preg_match_all() avec le premier masque: <em>/[aeiouy]/</em></br>';
        $masque1 = '/[aeiouy]/';
        preg_match_all($masque1, $chaine, $tab1);
        print_r($tab1);
        echo '<u>Cette classe de caractères permet de rechercher tous les caractères qui y sont compris.</u></br></br>';

        echo 'Résultat de preg_match_all() avec le second masque: <em>/j[aeiouy]/</em></br>';
        $masque2 = '/j[aeiouy]/';
        preg_match_all($masque2, $chaine, $tab2);
        print_r($tab2);
        echo '</br><u>Ce masque permet de rechercher tous les caractères "j" qui sont immédiatement suivis d\'un des caractères compris dans la classe.</u></br></br>';

        echo 'Résultat de preg_match_all() avec le troisième masque: <em>/[aeiouy][aeiouy]/</em></br>';
        $masque3 = '/[aeiouy][aeiouy]/';
        preg_match_all($masque3, $chaine, $tab3);
        print_r($tab3);
        echo '</br><u>Ce masque permet de rechercher tous les caractères compris dans la première classe qui sont immédiatement suivis d\'un des caractères compris dans la seconde classe.</u></br></br>';

        echo 'Résultat de preg_match_all() avec le quatrième masque: <em>/n[aeiouy][aeiouy]/i</em></br>';
        $masque4 = '/n[aeiouy][aeiouy]/i';
        preg_match_all($masque4, $chaine, $tab4);
        print_r($tab4);
        echo '</br><u>Ce masque permet de rechercher tous les caractères compris dans la première classe qui sont immédiatement suivis d\'un des caractères compris dans la seconde classe.</u></br>Pour rappel, le "i" après le délimiteur rend la recherche insensible à la casse.';
    ?>
    <h2>Les classes de caractères et les métacaractères</h2>
    <p>Dans le langage des expressions régulières, de nombreux caractères vont avoir une signification spéciale; ils permettent de spécifier qu’on recherche tel caractère (ou telle séquence de caractères) un certain nombre de fois ou à une certaine place dans une chaine.</br>
    Ces caractères spéciaux qu’on appelle <strong>métacaractères</strong> permettent de créer des schémas ou masques de recherche très puissants. On a pu en voir un premier exemple avec les caractères crochets [ ] qui permettent de définir une classe de caractères.</br>
    Au sein des classes de caractères, nous n’avons accès qu’à 3 métacaractères, c’est-à-dire qu’il n’existe que trois caractères qui possèdent un sens spécial lorsqu’ils sont placés tels quels dans une classe de caractères.</br>
    Ces métacaractères sont les suivants:</p>
    <table>
        <thead>
            <td>Métacaractère</td>
            <td>Description</td>
        </thead>
        <tr>
            <td class="first">\</td>
            <td>Caractère de <em>protection</em> qui va avoir plusieurs usages (on va pouvoir s’en servir pour <u>donner un sens spécial à des caractères qui n’en possèdent pas</u> ou au contraire pour neutraliser le sens spécial des métacaractères).</td>
        </tr>
        <tr>
            <td class = first>^</td>
            <td>Si placé au tout début d’une classe, permet de </em>nier (inverser)</em> la classe c’est-à-dire de chercher tout caractère <u>qui n’appartient pas à la classe</u>.</td>
        </tr>
        <tr>
            <td class = first>-</td>
            <td>Entre deux caractères, permet d’indiquer un <em>intervalle</em> de caractères.</td>
        </tr>
    </table>
    <p>Si on veut rechercher le caractère <em>qui représente</em> un métacaractère et sans en utiliser son sens "métacaractère" (par exemple si on souhaite rechercher le signe "-"), il faudra alors <u>le protéger avec un antislash</u>.</br>
    <em>Attention:</em> pour rechercher le caractère antislash avec une regex (c’est-à-dire à partir d’un masque stocké sous forme de chaine de caractères), il faudra préciser 4 antislashs d’affilée. En effet, l’analyseur PHP va considérer les 1er et 3è antislash comme des caractères d’échappement et ne conserver donc que les 2è et 4è antislash. Puis la regex va considérer le 1er des deux antislashs restants comme un caractère d'échappement et va donc rechercher le caractère antislash placé derrière.</br>
    <em>Notez</em> qu’il faudra également protéger les signes crochets fermants ainsi que le délimiteur de masque choisi si on souhaite les inclure dans une recherche dans une classe de caractères car dans le cas contraire le PHP penserait qu’on termine une classe de caractères ou notre masque.</p>
    <?php
        echo '<h4>Tests des métacaractères:</h4>';
        echo 'La chaine de caractères est: "Bonjour, qui suis-je ? Je suis [Pierre] \0/ ^^".</br></br>';
        $chaine = 'Bonjour, qui suis-je ? Je suis [Pierre] \0/ ^^';
        // liste des masques
        $masque1 = '/[^aeiouy]/';
        $masque2 = '/[\^aeiouy]/'; // échappement du ^
        $masque3 = '/[aei^ouy]/'; // pas besoin d'échapper le ^ ici car il ne représente pas un métacaractère (si c'en était un il serait en début de classe)
        $masque4 = '/[a-z]o/';
        $masque5 = '/[a-zA-Z]o/';
        $masque6 = '/[a\-z]/'; // le - est échappé, on recherche donc les 3 caractères a, - et z
        $masque7 = '/[0-9az-]/';
        $masque8 = '/[\/[\]\\\\]/'; // on recherche /, [, ] et \

        echo 'Le masque 1 <em>/[^aeiouy]/</em> commence par un "^" et inverse donc la recherche:</br>';
        preg_match_all($masque1, $chaine, $tab1);
        echo 'Caractères trouvés: ' . implode(', ', $tab1[0]) . '.</br>';
        echo '</br>';
        
        echo 'Le masque 2 <em>/[\^aeiouy]/</em> commence par un "^" échappé et recherche donc le caractère "^" ainsi que les suivants:</br>';
        preg_match_all($masque2, $chaine, $tab2);
        echo 'Caractères trouvés: ' . implode(', ', $tab2[0]) . '.</br>';
        echo '</br>';

        echo 'Le masque 3 <em>/[aei^ouy]/</em> fait la même recherche car le caractère "^" ne peut être un métacaractère car il ne débute pas la séquence de la classe:</br>';
        preg_match_all($masque3, $chaine, $tab3);
        echo 'Caractères trouvés: ' . implode(', ', $tab3[0]) . '.</br>';
        echo '</br>';

        echo 'Le masque 4 <em>/[a-z]o/</em> recherche n\'importe quel caractère MINUSCULE qui précède un "o":</br>';
        preg_match_all($masque4, $chaine, $tab4);
        echo 'Caractères trouvés: ' . implode(', ', $tab4[0]) . '.</br>';
        echo '</br>';

        echo 'Le masque 5 <em>/[a-zA-Z]o/</em> recherche n\'importe quel caractère majuscule ou minuscule qui précède un "o":</br>';
        preg_match_all($masque5, $chaine, $tab5);
        echo 'Caractères trouvés: ' . implode(', ', $tab5[0]) . '.</br>';
        echo '</br>';

        echo 'Le masque 6 <em>/[a\-z]/</em> va rechercher les caractères "a", "-" et "z". En effet "-" est échappé et perd donc son métacaractère :</br>';
        preg_match_all($masque6, $chaine, $tab6);
        echo 'Caractères trouvés: ' . implode(', ', $tab6[0]) . '.</br>';
        echo '</br>';

        echo 'Le masque 7 <em>/[0-9az-]/</em> va rechercher les chiffres de 0 à 9, les lettres "a" et "z" ainsi que le caractère "-". En effet le tiret est en fin de classe et ne représente donc pas une "plage" entre deux extrêmes:</br>';
        preg_match_all($masque7, $chaine, $tab7);
        echo 'Caractères trouvés: ' . implode(', ', $tab7[0]) . '.</br>';
        echo '</br>';

        echo 'Explication du masque 8:
            <ul>
                <li>le 1° antislash échappe le /, sinon PHP croit qu\'il représente la fin du masque</li>
                <li>le 2° antislash échappe le ], sinon PHP croit qu\'il représente la fin de la classe</li>
                <li>Les 4 antislash qui se suivent ont été expliqués plus haut: ils servent à rechercher un antislash dans la chaîne</li>
            </ul>
            Conclusion le masque 8 recherche les caractères /, [, ] et \.</br>';
        preg_match_all($masque8, $chaine, $tab8);
        echo 'Caractères trouvés: ' . implode(', ', $tab8[0]) . '.</br>';
        echo '</br>';
        echo 'Pour la présentation des textes on utilise la fonction <em>implode()</em> qui renvoie les items d\'un tableau sous forme de string en spécifiant un séparateur personnalisé.';
    ?>
    <h2>Les classes de caractères abrégées ou prédéfinies</h2>
    <p>Le caractère d’échappement antislash va pouvoir avoir plusieurs rôles ou plusieurs sens dans un contexte d’utilisation au sein d’expressions régulières. On a déjà vu que l’antislash nous permettait de protéger certains métacaractères, c’est-à-dire que le métacaractères ne prendra pas sa signification spéciale mais pourra être cherché en tant que caractère simple.</br>
    <em>L’antislash va encore pouvoir être utilisé au sein de classes de caractères avec certains caractères « normaux » pour au contraire leur donner une signification spéciale.</em></br>
    On va ainsi pouvoir utiliser des <strong><em>classes abrégées ou prédéfinies</em></strong>  pour indiquer qu’<u>on recherche un type de valeurs plutôt qu’une valeur ou qu’une plage de valeurs en particuliers</u>.</br>
    Les classes abrégées disponibles sont les suivantes (faites bien attention aux emplois de majuscules et de minuscules ici !):</p>
    <table>
        <thead>
            <td>Classe abrégée</td>
            <td>Description</td>
        </thead>
        <tr>
            <td>\w</td>
            <td>Équivalent à [a-zA-Z0-9 ], donc toutes lettres min ou maj et les chiffres.</td>
        </tr>
        <tr>
            <td>\W</td>
            <td>Inverse du précédent, soit [^a-zA-Z0-9_].</td>
        </tr>
        <tr>
            <td>\d</td>
            <td>Un chiffre, soit [0-9].</td>
        </tr>
        <tr>
            <td>\D</td>
            <td>Tout caractère qui n'est pas un chiffre, soit [^0-9].</td>
        </tr>
        <tr>
            <td>\s</td>
            <td>Représente un caractère blanc (espace, retour chariot, retour à la ligne).</td>
        </tr>
        <tr>
            <td>\S</td>
            <td>Représente tout caractère qui n'est pas un caractère blanc.</td>
        </tr>
        <tr>
            <td>\h</td>
            <td>Représente un espace horizontal.</td>
        </tr>
        <tr>
            <td>\H</td>
            <td>Représente tout caractère qui n'est pas un espace horizontal.</td>
        </tr>
        <tr>
            <td>\v</td>
            <td>Représente un caractère vertical.</td>
        </tr>
        <tr>
            <td>\V</td>
            <td>Représente tout caractère qui n'est pas un espace vertical.</td>
        </tr>
    </table>
    <h3>Tests sur les classes de caractère abrégées</h3>
    <?php
        echo "On créé une chaîne= \"Je suis Pierre, j'ai 29 ans. Et vous ?\"";
        $chaine = "Je suis Pierre, j'ai 29 ans. Et vous ?";
        echo "Ensuite, on commence par créer des masques.</br>";

        echo "<strong>Premier masque</strong> = /[\W]/</br>";
        $masque1 = '/[\W]/'; // [^a-zA-Z0-9 ]
        echo "preg_match_all() du masque 1 sur la chaîne:</br>";
        preg_match_all($masque1, $chaine, $tab1);
        var_dump($tab1);

        echo "<strong>Second masque</strong> = /[\d]/</br>";
        $masque2 = '/[\d]/'; // [0-9]
        echo "preg_match_all() du masque 2 sur la chaîne:</br>";
        preg_match_all($masque2, $chaine, $tab2);
        var_dump($tab2);

        echo "<strong>Troisième masque</strong> = /[\h]/</br>";
        $masque3 = '/[\h]/'; // espace horizontal
        echo "preg_match_all() du masque 3 sur la chaîne:</br>";
        preg_match_all($masque3, $chaine, $tab3);
        var_dump($tab3);
        echo "La chaîne contient " . preg_match_all($masque3, $chaine) . " espaces.</br>";
    ?>
    <h2>Les métacaractères des regex PHP</h2>
    <p>Nous avons appris à créer des classes de caractères et avons découvert qu’on pouvait insérer dans nos classes de caractères des caractères qui possèdent une signification spéciale : les métacaractères.</br>
    Nous n’avons accès qu’à <u>trois métacaractères</u> au sein des classes de caractères : les métacaractères <span style="font-weight: bold; font-size: 1.2em; color: red;">^</span>, <span style="font-weight: bold; font-size: 1.2em; color: red;">-</span> et <span style="font-weight: bold; font-size: 1.2em; color: red;">\</span>.</br>
    A l’extérieur des classes de caractères, cependant, nous allons pouvoir en utiliser de nombreux autres.</p>
    <h3>Le point</h3>
    <p>Le métacaractère . (point) va nous permettre de rechercher n’importe quel caractère à l’exception du caractère représentant une nouvelle ligne qui est en PHP le \n.</p>
    <?php
        echo "On créé une chaîne= \"Pierre, 29 ans. Et vous ?\"";
        $chaine = "Pierre, 29 ans. Et vous ?";
        echo "Masque 1 = /./</br>";
        $masque1 = '/./'; 
        echo "preg_match_all() du masque 1 sur la chaîne: </br>";
        preg_match_all($masque1, $chaine, $tab1);
        var_dump($tab1);
        echo "Le point spécifié <strong>en dehors</strong> d'une classe est un métacaractère qui permet de rechercher n'importe quel caractère sauf une nouvelle ligne.</br>";
        echo "-----------</br>";
        echo "Masque 2 = /[.]/</br>";
        $masque2 = '/[.]/'; 
        preg_match_all($masque2, $chaine, $tab2);
        var_dump($tab2);
        echo "Le point spécifié <strong>dans</strong> une classe sert simplement à rechercher les points (.) dans la chaîne.</br>";
    ?>
    <p> <strong>Il est important de bien intégrer qu'il n’existe que trois métacaractères, c’est-à-dire trois caractères qui vont posséder un sens spécial à l’intérieur des classes de caractères (^ - \). </br>
    <u>Les métacaractères que nous étudions dans cette partie ne vont avoir un sens spécial qu’<span style="color:red;">en dehors</span> des classes de caractères.</u></strong> </p>
    <p>Le métacaractère | (barre verticale) sert à séparer des <em>alternatives</em>.</br>
    Concrètement, ce métacaractère va nous permettre de créer des masques qui vont pouvoir chercher une séquence de caractères ou une autre.</p>
    <?php
        echo "Masque /er|re/ sur la chaine \"Pierre, 29 ans. Et vous ?\"</br>";
        $masquePipe = '/er|re/';
        preg_match_all($masquePipe, $chaine, $tab);
        var_dump($tab);
    ?>
    <p>On utilise le métacaractère | pour créer une <strong>alternative</strong> dans notre masque.</br>
    Ce masque va nous permettre de chercher soit la séquence de caractères « er » soit la séquence « re » dans la chaine de caractères à analyser.</p>
    <h3>Les ancres</h3>
    <p>Les deux métacaractères ^ et $ vont nous permettre <em>« d’ancrer »</em> des masques.
        <ul>
            <li>Le métacaractère ^, <u>lorsqu’il est utilisé en dehors d’une classe</u>, va posséder une signification différente de lors de l’utilisation dans une classe.</br>
            Attention donc à ne pas confondre les deux sens !</br>
            <strong>Utiliser le métacaractère ^ en dehors d’une classe</strong> permet de vérifier si le caractère qui suit directement le ^ du masque <em>est le premier de la chaine de caractères à analyser</em>. Il faudra placer le ^ au début du masque ou tout au moins en début d’alternative pour qu’il exprime ce sens.</br>
            Pour rappel, le ^ dans une classe inverse la recherche.</li>
            <li>Inversement, le métacaractère $ permet de vérifier la présence du caractère <strong>précédant</strong> le métacaractère en fin de chaine.</br>
            Il faudra placer le métacaractère $ en fin de du masque ou tout au moins en fin d’alternative pour qu’il exprime ce sens.</li>
        </ul>
    </p>
    <h4>Quelques exemples:</h4>
    <p>Le masque <em>/^p/</em> recherche la lettre p minuscule en début de chaîne.</br>
    Le masque <em>/^p|^P/</em> recherche un p (maj ou min) en début de chaîne.</br>
    Le masque <em>/^[A-Z]/</em> recherche une lettre majuscule en début de chaîne.</br>
    Le masque <em>/\?/</em> recherche un ? en fin de chaîne.</br>
    Le masque <em>/^p\?$|^P\?$/</em> recherche une chaîne qui commencerait par un p minuscule et se terminerait par un ? OU qui commencerait par un P majuscule et se terminerait par un ?</p>
    <p><u>Remarque:</u> nous avons protégé le caractère ? à chaque utilisation dans ces masques car c’est également un métacaractère (que étudierons après) et car nous voulions chercher la présence du caractère « ? ».</p>
    <h3>Les quantificateurs</h3>
    <p>Les quantificateurs sont des métacaractères qui permettent de rechercher une certaine quantité d’un caractère ou d’une séquence de caractères.</br>
    Les quantificateurs disponibles sont les suivants :
        <table>
            <thead>
                <td>Quantificateur</td>
                <td>Description</td>
            </thead>
            <tr>
                <td>a{X}</td>
                <td>On veut une séquence de X fois "a".</td>
            </tr>
            <tr>
                <td>a{X,Y}</td>
                <td>On veut une séquence de X à Y fois "a". </td>
            </tr>
            <tr>
                <td>a{X,}</td>
                <td>On veut une séquence d'au moins X fois "a" sans limite supérieure.</td>
            </tr>
            <tr>
                <td>a?</td>
                <td>On veut 0 ou 1 "a". Équivalent à a{0,1}.</td>
            </tr>
            <tr>
                <td>a+</td>
                <td>On veut au moins 1 fois "a". Équivalent à a{1,}.</td>
            </tr>
            <tr>
                <td>a*</td>
                <td>On veut 0, 1 ou plusieurs "a". Équivalent à a{0,}</td>
            </tr>
        </table>
    </p>
    <?php
        echo "La chaîne 1 est: \"Pierre, 29 ans. Et vous ?\"</br>";
        $chaine1 = "Pierre, 29 ans. Et vous ?";
        echo "La chaine 2 est \"0665656565\"";
        $chaine2 = "0665656565";
        echo "1. preg_match_all() du masque <em>/er?/</em> sur la chaîne 1: </br>";
        $masque1 = "/er?/";
        preg_match_all($masque1, $chaine1, $tab1);
        var_dump($tab1);
        echo "Le masque recherche \"e\" suivi de (r?), soit 0 ou 1 fois \"r\": donc on recherche e ou er.</br>";

        echo "2. preg_match_all() du masque <em>/er+/</em> sur la chaîne 1: </br>";
        $masque2 = "/er+/";
        preg_match_all($masque2, $chaine1, $tab2);
        var_dump($tab2);
        echo "Le masque recherche \"e\" suivi de (r+), soit au moins 1 \"r\": donc e suivi d'un nombre indéféni de r.</br>";

        echo "3. preg_match_all() du masque <em>/^[A-Z].{10,}\?$/</em> sur la chaîne 1: </br>";
        $masque3 = '/^[A-Z].{10,}\?$/';
        preg_match_all($masque3, $chaine1, $tab3);
        var_dump($tab3);
        echo "Dans ce cas nous avons 3 critères dans la recherche:
            <ul>
                <li><em>^[A-Z]</em> qui recherche une majuscule comme 1° caractère.</li>
                <li><em>.{10,}</em> qui recherche une séquence d'au moins 10 caractères (nouvelle ligne \\n exclus).</li>
                <li><em>\?$</em> qui recherche un point d'interrogation en dernier caractère.</li>
            </ul>";

        $masque4 = '/^\d{10,10}$/';
        preg_match_all($masque4, $chaine2, $tab4);
        var_dump($tab4);
        echo "Doit contenir exactement et uniquement 10 chiffres.</br>
        Il n'y a pas d'explication dans le cours mais voici comment j'interprète ce masque:
            <ul>
                <li><em>^\d</em>: commence par un chiffre.</li>
                <li><em>\d{10,10}$</em>: ($) se termine par {10,10} 10 et uniquement 10 (\d) chiffres.</li>
            </ul>";
    ?>
    <h3>Les sous-masques</h3>
    <p>Les métacaractères <span style="font-weight: bolder; color: red;">(</span> et <span style="font-weight: bolder; color: red;">)</span> vont être utilisés pour délimiter des sous masques.</br>
    <strong>Un sous masque est une partie d’un masque délimitée par un couple de parenthèses.</strong> Ces parenthèses vont nous permettre
        <ul>
            <li>d’isoler des alternatives</li>
            <li>ou de définir sur quelle partie du masque un quantificateur doit s’appliquer.</li>
        </ul>
    De manière très schématique, et même si ce n’est pas strictement vrai, vous pouvez considérer qu’on va en faire le même usage que lors d’opérations mathématiques, c’est-à-dire qu’on va s’en servir pour prioriser les calculs.</br>
    Par défaut, les sous masques vont être <em>capturants</em>. Cela signifie tout simplement que <em>lorsqu’un sous masque est trouvé dans la chaine de caractères, la partie de cette chaine sera capturée (en fait renvoyée)</em>.</p>
    <?php
        echo "la chaine1 contient \"Je suis Pierre et j'ai 29 ans.\".</br> ";
        echo "</br>";
        $chaine1 = "Je suis Pierre et j'ai 29 ans.</br>";

        echo "<strong>1.</strong> Création du masque1 <em>/er|t/</em> et preg_match_all() sur la chaine1.</br>";
        $masque1 = "/er|t/";
        preg_match_all($masque1, $chaine1, $tab1);
        var_dump($tab1);
        echo "<strong>Résultat:</strong> Le masque recherche les occurences de \"er\" et de \"t\".</br>";
        echo "</br>";

        echo "<strong>2.</strong> Création du masque2 <em>/e(r|t)/</em> et preg_match_all() sur la chaine1.</br>";
        $masque2 = "/e(r|t)/";
        preg_match_all($masque2, $chaine1, $tab2);
        var_dump($tab2);
        echo "<strong>Résultat:</strong> Ce masque contient un sous masque. Le masque nous permet de chercher « er », « et », « r » et « t » car les sous masques sont <strong>capturants:</strong> si un motif du sous masque correspond, la partie de la chaine de caractères dans laquelle on recherche sera capturée. Ici, le sous masque chercher « r » ou « t ». Dès que ces caractères vont être trouvés dans la chaine, ils vont être capturés et renvoyés.</br>";
        echo "</br>";

        echo "<strong>3.</strong> Création du masque3 <em>/er{2}/</em> et preg_match_all() sur la chaine1.</br>";
        $masque3 = "/er{2}/";
        preg_match_all($masque3, $chaine1, $tab3);
        var_dump($tab3);
        echo "<strong>Résultat:</strong> pour rappel, a{X} recherche X occurences de « a ».</br>
        Ce masque recherche donc un « e » suivi de 2 « r ».</br>";
        echo "</br>";

        echo "<strong>4.</strong> Création du masque4 <em>/(er){2}/</em> et preg_match_all() sur la chaine1.</br>";
        $masque4 = "/(er){2}/";
        preg_match_all($masque4, $chaine1, $tab4);
        var_dump($tab4);
        echo "<strong>Résultat:</strong> pour rappel, a{X} recherche X occurences de « a ».</br>
        Ce masque recherche donc une suite de 2 occurences de « er ».</br>";
        echo "</br>";
    ?>
    <h3>Les assertions</h3>
    
</body>
</html>