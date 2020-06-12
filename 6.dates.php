<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les dates</title>
    <style>
        h1 {color: red; text-decoration: underline;}
        h2 {color: blue; text-decoration: underline;}
        h3 {text-decoration: underline;}
        h4 {font-style: italic;}
    </style>
</head>
<body>
    <h1>Manipuler des dates en PHP</h1>

        <h2>Le timestamp UNIX et la date</h2>
            <h3>Le timestamp UNIX</h3>
    <p>Le Timestamp représente le nombre de secondes écoulées depuis le 1er janvier
1970 à minuit (heure GMT) et jusqu’à une date donnée.</p>
    <p>Le Timestamp est le même pour un moment donné quel que soit le fuseau horaire puisque ce nombre représente le nombre de secondes écoulées depuis un point précis dans le temps (il n'est pas question de lieu).</p>
            <h3>Obtenir un timestamp et le timestamp actuel</h3>
                <h4>Obtenir le timestamp relatif à la date actuelle</h4>
    <p>Pour obtenir le Timestamp actuel, nous allons utiliser la fonction <strong>time()</strong>.</p>
    <?php
        echo "le timestamp actuel est " .time()."</br>";
    ?>
                <h4>Obtenir le timestamp d'une date donnée</h4>
    <p>Pour obtenir le Timestamp lié à une date donnée, il faut utiliser la fonction, soit:
        <ul>
            <li><strong>mktime()</strong> qui retourne le Timestamp UNIX d’une date</li>
            <li>ou la fonction <strong>gmmktime()</strong> qui retourne le Timestamp d’une date GMT.</li>
        </ul>
    </p>
    <?php
        // pour les arguments des fonctions voir plus bas
        echo "Timestamp actuel (6/9 à 16h) avec mktime(): " . mktime(16,0,0,6,9,2020) . "</br>";
        echo "Timestamp actuel avec gmmktime(): " . gmmktime(16,0,0,6,9,2020) . "</br>";
        echo "Timestamp actuel: ".time()."</br>";
        echo "Différence entre les 2: ".(gmmktime(16,0,0,6,9,2020) - time())."</br>";
        echo "Différence entre les 2 MOINS 2 heures: ".(gmmktime(16,0,0,6,9,2020) - time()-7200)."</br>";
    ?>
    <p>Ces deux fonctions vont s’utiliser de la même façon; il faut leur passer une série de nombres en arguments. <em>Ces nombres vont constituer une date</em> et vont représenter (dans l’ordre) les parties suivantes de la date dont on souhaite obtenir le Timestamp :
        <ol>
            <li>l'heure</li>
            <li>les minutes</li>
            <li>les secondes</li>
            <li>le mois</li>
            <li>le jour</li>
            <li>l'année</li>
        </ol>
    </p>
    <p><em>Les arguments sont tous facultatifs</em> et si certains sont omis ce sera la valeur actuelle de la date qui sera utilisée et donc le Timestamp actuel qui sera renvoyé.</br>
    <strong>Attention</strong> : lorsque des arguments sont omis, <u>la fonction considère que ce sont les derniers</u> car elle n’a aucun moyen de savoir quel argument est omis!</br>
    Ainsi, <u>il est impossible d’omettre juste le jour par exemple</u> puisque dans ce cas la fonction considérerait que la valeur du mois correspond au jour et celle de l’année au mois. Pour omettre l’argument « mois », il faudra également omettre le jour et l’année.</p>
    <p>Lorsqu’on travaille avec les dates, la chose la plus difficile à comprendre est généralement la façon dont vont être gérés les <strong>fuseaux horaires</strong>.</p>
    <p>La fonction <em>mktime()</em> calcule le Timestamp d’une date donnée en fonction du fuseau horaire du serveur. En Belgique, en été, nous sommes à GMT+2. Il est 17h30 chez moi, il est donc 15h30 sur un fuseau GMT. <strong>La fonction <em>mktime(</em>) va donc transformer mon heure en heure GMT et se baser sur 15h30 pour calculer le Timestamp</strong>.</p>
    <p>La fonction <strong>gmmktime()</strong>, en revanche, <u>considère que l’heure passée est une heure GMT</u>.</br>
    Cette fonction va donc calculer le Timestamp de l’heure exacte passée en paramètre.</br>
    <strong>Remarque !!!</strong> Je devrais avoir un écart de 7200 secondes entre mes deux Timestamps renvoyées par mktime() et gmmktime() : <em>incompréhensiblement</em> ce n'est pas le cas !!!</p>

                <h4>Obtenir un timestamp à partir d'une chaîne de caractères</h4>
    <p>On peut obtenir un Timestamp à partir d’une chaine de caractères en utilisant la fonction <strong>strtotime()</strong> qui transforme une chaine de caractères de format date ou temps en Timestamp.</p>
    <p> <strong>Attention:</strong> la chaîne de caractères doit correspondre à un des schémas bien définis <u>et en anglais</u>. En voici quelques-uns des plus courants (<u>l'heure est facultative</u>):
        <ul>
            <li>mm/dd/y</li>
            <?php echo "05/11/1980 10:00:00 = " . strtotime('05/11/1980 10:00:00') ?>
            <li>y-mm-dd</li>
            <?php echo "1980-05-11 10:00:00 = " . strtotime('1980-05-11 10:00:00') ?>
            <li>dd-mm-yy</li>
            <?php echo "11-05-1980 10:00:00 = " . strtotime('11-05-1980 10:00:00') ?>
            <li>dd-month y</li>
            <?php echo "11-may 1980 10:00:00 = " . strtotime('11-may 1980 10:00:00') ?>
            <li>month dd,y</li>
            <?php echo "may 11,1980 10:00:00 = " . strtotime('may 11,1980 10:00:00') ?>
        </ul>
    </p>
    <p><strong>NOTE:</strong> strtotime() accepte des formats de date relatifs
comme : « sunday », « monday », yesterday (hier à minuit), today (aujourd’hui à minuit), now (maintenant), tomorrow (demain à minuit), « first fri of January 2019 », « ago » comme « 2 days ago » ou « 3 months 2 days ago », notation avec des « + » et des « – » comme « +1 day » ou « – 3 weeks » ... On peut combiner ces formats de dates ensemble en respectant certaines règles pour créer des formats de dates complexes. Dans ce cours, nous allons cependant nous contenter de manipuler des dates simples car elles vont se révéler suffisantes dans l’immense majorité des cas.</p>
    <ul>
        <li> <?php echo "strtotime('next friday') : " .strtotime('next friday')."</br>" ?> </li>
        <li><?php echo "strtotime('2 days ago') : " .strtotime('2 days ago')."</br>" ?></li>
        <li><?php echo "strtotime('3 months 2 days ago') : " .strtotime('3 months 2 days ago')."</br>" ?></li>
    </ul>
            <h3>Obtenir une date à partir d'un timestamp</h3>
<p>Pour obtenir une date en PHP, on utilise la fonction <strong>getdate()</strong>. Cette fonction va accepter un Timestamp en argument et retourner un tableau associatif contenant les différentes informations relatives à la date liée au Timestamp.</br>
Si aucun argument n’est passé à getdate(), alors la fonction utilisera le Timestamp relatif
à la date courante et retournera donc la date actuelle locale.</p>
<?php
    $exemple =  getdate('1000');
    var_dump($exemple);
?>
<p>Détail des clés du tableau associatif:
    <ul>
        <li>seconds</li>
        <li>minutes</li>
        <li>hours</li>
        <li>mday = numéro du jour dans le mois</li>
        <li>wday = numéro du jour de la semaine (dimanche = 0)</li>
        <li>mon = numéro du mois</li>
        <li>year</li>
        <li>yday = numéro du jour de l'année (1 janvier = 0)</li>
        <li>weekday = jour de la semaine en forme texte</li>
        <li>month = mois sous forme texte</li>
        <li>0 = timestamp relatif à la date renvoyée</li>
    </ul>

</p>

        <h2>Obtenir et formater une date</h2>
            <h3>La fonction date() et les formats de date</h3>
<p>La fonction <strong>date()</strong> permet d’obtenir une date selon le format de notre
choix. Cette fonction va pouvoir prendre deux arguments. 
    <ul>
        <li>Le <u>premier argument correspond au format de date souhaité</u> et est <strong>obligatoire</strong>.</li>
        <li>Le deuxième argument est facultatif et va être un Timestamp relatif à la date qu’on souhaite retourner.</li>
    </ul> 
Si le Timestamp est omis, alors la fonction date() se basera sur la date courante du serveur.</br>
Pour indiquer le format de date qu’on souhaite voir renvoyer à la fonction date(), nous
allons lui passer une série de lettres qui vont avoir une signification spéciale.</p>
<p>On trouve <a href="https://www.php.net/manual/fr/function.date.php" target="_blank">sur cette page PHP</a> les caractères pour formater une date.</br>
En voici quelques exemples:</p>
<?php
    echo 'date("d/m/Y") donne ' . date('d/m/Y') . "</br>";
    echo 'date("l d m Y h:i:s") donne ' . date('l d m Y h:i:s') . "</br>";
    echo 'date("c") donne ' . date('c') . "</br>";
    echo 'date("r") donne ' . date('r') . "</br>";
?>
<p><strong>Note:</strong> il y a deux choses à noter ici :
    <ul>
        <li>on pourra séparer les différents caractères de dates avec des tirets, des points, des slashs ou des espaces pour rendre une date plus lisible,</li>
        <li>il faudra faire attention à la casse lorsqu’on définit un format d’heure puisque la plupart des caractères ont deux significations totalement différentes selon qu’on les écrit en minuscule ou en majuscule.</li>
    </ul>
</p>

            <h3>Formater une date: la gestion du décalage horaire</h3>
<p>La fonction date() formate une date localement, la date renvoyée va être la date locale avec le décalage horaire.</br>
Si on souhaite retourner une date GMT, alors on utilisera plutôt la fonction <strong>gmdate()</strong> qui va s’utiliser exactement de la même manière.</p>
<p>Par ailleurs, <em>il est également possible que la date renvoyée ne corresponde pas à celle de l’endroit où vous vous trouvez si le serveur qui héberge votre site se situe sur un autre
fuseau horaire</em>.</br>
Pour régler ce problème, on peut utiliser la fonction <strong>date_default_timezone_set()</strong> en lui passant un fuseau horaire sous un format valide pour définir le fuseau horaire qui devra être utilisé pour les fonctions relatives à la date utilisées dans le script.</br>
Le fuseau horaire qui va particulièrement nous intéresser va être Europe/Paris. Pour la liste complète des fuseaux horaires valides, je vous invite à lire la documentation officielle</p>
<p><em>Il semble donc qu'on n'utilise cette fonction qu'une seule fois dans le script. Mais il faudra tester si'il faut appeler cette fonction à chaque page où on travaille avec des dates.</em></p>
<p>Si on modifie le fuseau horaire de référence au milieu du code, le résultat de la fonction date() appelée ensuite va donc être différent de précédemment.</p>

            <h3>Transformer une date en français</h3>
<p>Par défaut, les dates vont être renvoyées en anglais par la plupart des serveurs. Pour
traduire en français, la solution recommandée sont <strong>setlocale()</strong>  et <strong>strftime()</strong>.</p>
<p>La fonction <em>setlocale()</em> permet de modifier/définir de nouvelles informations de localisation.</br>
On va pouvoir passer à cette fonction une constante qui définira les données qui doivent être définies localement : la comparaison de chaines de caractères, la monnaie, les chiffres et le séparateur décimal, les dates ou tout cela à la fois.</br>
Dans notre cas, nous allons modifier les informations de localisation pour le format de date et d’heure et pour cela <u>utiliser la constante LC_TIME</u>. En plus de cette constante, il faudra passer en deuxième argument de setlocale() un tableau qui va nous permettre de choisir la langue souhaitée pour nos informations de localisation.</br>
<em> <u>Remarque:</u> </em> la valeur « correcte » du deuxième argument censé déterminer la langue va pouvoir être différente d’un système d’opérations à l’autre car celle-ci n’est pas
standardisée. Pour le Français par exemple certains systèmes vont utiliser <em>fr</em>, d’autres <em>fr_FR</em> ou d’autres encore <em>fra</em>. Par sécurité, on va donc indiquer un <u>maximum de valeurs dans ce tableau</u> : la fonction setlocale() sélectionnera ensuite la première qui est reconnue.</p>
<p>Syntaxe: <em>setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);</em> </p>
<p>Avec <em>setlocale()</em>, nous avons défini des informations de localisation.</br>
<strong>Cependant, les fonctions date() et strtotime() par exemple vont ignorer ces informations et continuer de travailler uniquement en anglais.</strong></br>
<u>La seule fonction relative à la date qui supporte la localisation en PHP est la fonction <strong>strftime()</strong> et c’est donc celle que nous allons utiliser avec setlocale().</u></br>
Nous allons passer à cette fonction des caractères qui vont représenter des parties de
date, de la même façon qu’on avait pu le faire avec la fonction date().</br>
Attention cependant : les caractères ne vont pas forcément être les mêmes et signifier la
même chose que pour date() et nous allons cette fois-ci devoir les préfixer avec un %.</br>
<a href="https://www.php.net/manual/fr/function.strftime.php" target="_blank">Voici la liste de ces caractères.</a></p>
<?php
    echo 'Utilisation de strftime() avant un setlocale: '. strftime('%A %d %B %Y %I:%M:%S').'</br>';
    setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
    echo 'Ajout de setlocale(LC_TIME, [\'fr\', \'fra\', \'fr_FR\']) et rappel de la fonction précédente: ';
    echo 'Utilisation de strftime() APRES le setlocale: '. strftime('%A %d %B %Y %I:%M:%S').'</br>';
?>

        <h2>Comparer des dates et tester la validité des dates</h2>
            <h3>La comparaison de dates</h3>
<p>La comparaison de dates est une chose difficile en informatique et particulièrement en
PHP. <em>La raison principale à cela est qu’une date peut être écrite sous de multiples formats</em> : soit tout en chiffres, soit tout en lettres, soit avec un mélange de chiffres et de lettres, avec les mois avant ou après les jours, etc.</br>
Lorsqu’on utilise un opérateur de comparaison, les deux opérandes (ce qui se situe d’un
côté et de l’autre de l’opérateur) vont être comparés caractère par caractère. Cela rend
impossible la comparaison de dates dont le format n’est pas strictement identique ainsi
que la comparaison de dates écrites avec des lettres.</br>
<u>Nous allons donc ici généralement privilégier la comparaison des Timestamp liés aux
dates</u> puisque les Timestamp sont des nombres et qu’il est très facile de comparer deux
nombres en PHP.</br>
On va donc procéder en deux étapes : 
    <ul>
        <li>récupérer les Timestamp liés aux dates qu’on souhaite comparer avec une fonction comme strtotime() par exemple</li>
        <li>puis on va comparer les Timestamp.</li>
    </ul>
</p>
<p>En détail:
    <ol>
        <li>Utiliser setlocale() pour travailler en français.</li>
        <li>Stocker les deux dates (quel que soit leur format) dans deux variables.</li>
        <li>Transformer ces deux dates en deux timestamps (avec strtotime()) que l'on stockera dans deux autres variables.</li>
        <li>Retransformer ces deux timestamps en chaînes de caractères avec strftime() (car c'est la fonction qu'on utilise si on a fait un setlocale().</li>
    </ol>
</p>
<?php
    // point 1
    setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
    // point 2
    $date1 = "11-05-1980";
    $date2 = "14-november 2004";
    print_r($date1);
    echo "</br>";
    // point 3
    $timestampDate1 = strtotime($date1);
    $timestampDate2 = strtotime($date2);
    print_r($timestampDate1);
    echo "</br>";
    // point 4
    $date1Char = strftime('%A %d %B %Y', $timestampDate1);
    $date2Char = strftime('%A %d %B %Y', $timestampDate2);
    print_r($date1Char);
    echo "</br>";
    // comparaison
    if ($timestampDate1 < $timestampDate2){
        echo $date1Char . ' est avant ' . $date2Char . '</br>';
    } else {
        echo $date2Char . ' est avant ' . $date1Char . '</br>';
    }
?>

            <h3>La validation de dates</h3>
<p>Bien souvent, vous allez demander aux utilisateurs de vous envoyer des données. Cela va être par exemple le cas si vous créez un formulaire d’inscription sur votre site, ou
si vous possédez un site marchand. Vous demanderez alors certainement la date de naissance des utilisateurs.</br>
Vous ne devez jamais vous attendre à recevoir des données valides de la part de vos utilisateurs. Pour ces raisons, nous testerons et traiterons toujours les informations envoyées par nos utilisateurs, et notamment les dates.</p>

            <h3>Tester la validité d'une date</h3>
<p>Utiliser la fonction <strong>checkdate()</strong> avec 3 chiffres en arguments
    <ul>
        <li>le premier représente le <u>mois</u> à tester </li>
        <li>le second représente le <u>jour</u> à tester </li>
        <li>le troisième représente l' <u>année</u> à tester </li>
    </ul>
</p>
<p>Pour que la date soit validée, elle devra remplir 3 critères:
    <ul>
        <li>mois compris entre 1 et 12</li>
        <li>jour autorisé pour le mois donné; les bissextiles sont prises en compte</li>
        <li>année comprise entre 1 et 32767</li>
    </ul>
</p>
<?php
    var_dump(checkdate(2,29,1964)); // renvoie true car 1964 est bien une année bissextile
?>
<p> <u>Note </u> : la formule va vérifier la validité d'une date mais pas sa cohérence: un utilisateur pourra entrer une date future comme date de naisssance ! Il faudra, en fonction des circonstances, coder des contraintes de test.</p>

            <h3>Tester la validité d'un <span style="color: brown; font-style: italic;">format</span> de date locale</h3>
<p>On va également pouvoir vérifier si un <strong>format</strong> de date locale nous convient, c’est-à-dire vérifier la validité d’une date générée par la fonction strftime() en utilisant strptime().</br>
<strong>LA FONCTION strptime() NE FONCTIONNE PAS SOUS WINDOWS</strong>
    <ul>
        <li>On stocke un format de date qui nous convient: <em>$format1 = '%A %d %B %Y %H:%M:%S';</em> </li>
        <li>On teste la validité avec strptime(): <em>strptime($dateAtester, $format1);</em> </li>
        <li>Le test renverra un tableau détaillé s'il est validé ou <em>false</em> s'il a échoué. </li>
    </ul>
</p>

    <h1>Résumé des fonctions de dates</h1>
    <ul>
        <li>time() pour obtenir le timestamp actuel</li>
        <li>mktime() pour obtenir le timestamp d'une date passée en argument, mais cette date sera d'abord automatiquement convertie en date GMT</li>
        <li>gmmktime() pour obtenir le timestamp d'une date GMT passée en argument</li>
        <li>strtotime() transforme une chaîne de caractères en timestamp.</li>
        <li>getdate() prend un timestamp en argument et renvoie un tableau associatif avec les éléments d'une date.</li>
        <li>date() permet d’obtenir une date selon le format de notre choix, nécessite un argument pour déterminer le format et éventuellemnt un timestamp en 2° argument.</li>
        <li>gmdate() fait exactement la même chose sauf que la date renvoyée sera une date GMT.</li>
        <li>date_default_timezone_set() va prendre en argument un fuseau horaire. Elle permet de modifier le fuseau horaire par défaut si par exemple le serveur est sur un autre fuseau.</li>
        <li>setlocale() pour traduire les dates en français <strong>MAIS</strong> uniquement avec la fonction <strong>strftime()</strong>.</li>
        <li>checkdate() pour vérifier la validité d'une date. </li>
        <li>strptime() pour vérifier le <em>format</em> d'une date créé avec strftime()</br>
    <u>Attention</u>: ne fonctionne pas sous windows.  </li>
    </ul>
</body>
</html>