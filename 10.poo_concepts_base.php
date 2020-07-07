<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO</title>
</head>
<body>
    <h1>POO - Concepts de base</h1>
    <p>Jusqu’à présent, nous avons codé de manière <em>procédurale</em>, c’est-à-dire <u>en écrivant une suite de procédures et de fonctions</u> dont le rôle était d’effectuer différentes opérations sur des données généralement contenues dans des variables et ceci dans leur ordre d’écriture dans le script.</br>
    La POO est une façon différente d’écrire et d’arranger son code autour de <strong>classes</strong> et d’<em>objets qu’on va créer <u>à partir de ces classes</u></em>.</p>
    <p style="font-size: 1.2em;">Une <u>classe</u> est une entité qui va pouvoir contenir un ensemble de fonctions et de variables.</p>
    <p>Les intérêts principaux de la programmation orientée objet sont:
        <ul>
            <li>une structure générale du code plus claire,</li>
            <li>plus modulable,</li>
            <li>et plus facile à maintenir et à déboguer.</li>
        </ul>
    </p>

    <h2>Classes, objets et instances, première approche</h2>
    <p>La POO se base sur un concept fondamental qui est que tout élément dans un script est un objet ou va pouvoir être considéré comme un objet.</br>
    Pour comprendre ce qu’est précisément un objet, il faut avant tout comprendre ce qu’est une classe:</br></br>
    <span style="font-size: 1.2em;">une <u>classe</u> est un bloc de code qui va contenir différentes variables, fonctions et éventuellement constantes et qui va servir de plan de création -de <em>blueprint</em>- pour des objets similaires. Chaque objet créé à partir d’une même classe dispose des mêmes variables, fonctions et constantes définies dans la classe mais va pouvoir les implémenter différemment.</span></p>
    <p>Créons une première classe qu’on va appeler <em>Utilisateur</em>. En PHP, on crée une nouvelle classe avec le mot clef <strong><em>class</em></strong>. </br>
    <strong>Par convention</strong>, on placera généralement chaque nouvelle classe créée <u>dans un fichier à part et on placera également tous nos fichiers de classe dans un dossier qu’on pourra appeler classes</u> par exemple pour plus de simplicité.</br>
    On n’aura ensuite qu’à inclure les fichiers de classes nécessaires à l’exécution de notre script principal dans celui-ci grâce à une instruction <em><u>require</u></em> par exemple.</br>
    On va donc créer un nouveau fichier qu’on va appeler <em>utilisateur.class.php</em>.</br>
    Notez qu’on appellera généralement nos fichiers de classe <em>maClasse.class.php</em> afin de bien les différencier des autres et par convention une nouvelle fois.</br>
    Dans ce fichier de classe, nous allons donc pour le moment tout simplement créer une classe Utilisateur avec le mot clef <em>class</em>.</p>
    <p> <em>class Utilisateur {}</em> </p>
    <p>Ensuite on peut déjà l'inclure dans ce fichier, avec l'instruction <strong>require</strong>.</p>
    <?php
        require "./classes/utilisateur.class.php";
        $pierre = new Utilisateur;
    ?>
    <p>Nous pouvons créer avec <em>$pierre = new Utilisateur()</em> une nouvelle <strong>instance</strong> de notre <strong>classe</strong> <em>Utilisateur</em>.</br>
    Le mot clef <em>new</em> est utilisé pour instancier une classe: une instance correspond à la « copie » d’une classe. Le grand intérêt ici est qu’on va pouvoir effectuer des opérations sur chaque instance d’une classe sans affecter les autres instances.</br>
    Les termes <em>instance de classe</em> et <em>objet</em> ne désignent pas ondamentalement la même chose mais dans le cadre d’une utilisation pratique on pourra très souvent les confondre et c’est ce que nous allons faire dans ce cours. Pour information, la grande différence est que chaque instance de classe est unique et peut donc être identifiée de manière unique ce qui n’est pas le cas pour les objets d’une même classe./<br>
    Lorsqu’on instancie une classe, un objet est donc créé. Nous allons devoir "capturer" cet objet pour l’utiliser. Pour cela, nous allons généralement utiliser une variable qui deviendra alors une « variable objet » ou plus simplement un « objet ».</br>
    <em>Pour être tout à fait précis, la variable ne va exactement contenir l’objet en soi mais plutôt une <u>référence à l’objet</u>. Nous reparlerons de ce point relativement complexe en fin de partie et allons pour le moment considérer que notre variable contient notre objet.</em></p>

    <h2>Propriétés et méthodes</h2>
    302
</body>
</html>