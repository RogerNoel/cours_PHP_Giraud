<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO</title>
    <style>
        .retrait {margin-left: 15px;}
    </style>
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
        require "./classes/utilisateur1.class.php";
        $pierre = new Utilisateur;
    ?>
    <p>Nous pouvons créer avec <em>$pierre = new Utilisateur()</em> une nouvelle <strong>instance</strong> de notre <strong>classe</strong> <em>Utilisateur</em>.</br>
    Le mot clef <em>new</em> est utilisé pour instancier une classe: une instance correspond à la « copie » d’une classe. Le grand intérêt ici est qu’on va pouvoir effectuer des opérations sur chaque instance d’une classe sans affecter les autres instances.</br>
    Les termes <em>instance de classe</em> et <em>objet</em> ne désignent pas fondamentalement la même chose mais dans le cadre d’une utilisation pratique on pourra très souvent les confondre et c’est ce que nous allons faire dans ce cours. Pour information, la grande différence est que chaque instance de classe est unique et peut donc être identifiée de manière unique ce qui n’est pas le cas pour les objets d’une même classe.</br>
    Lorsqu’on instancie une classe, un objet est donc créé. Nous allons devoir "capturer" cet objet pour l’utiliser. Pour cela, nous allons généralement utiliser une variable qui deviendra alors une « variable objet » ou plus simplement un « objet ».</br>
    <em>Pour être tout à fait précis, la variable ne va exactement contenir l’objet en soi mais plutôt une <u>référence à l’objet</u>. Nous reparlerons de ce point relativement complexe en fin de partie et allons pour le moment considérer que notre variable contient notre objet.</em></p>

    <h2>Propriétés et méthodes</h2>
    <h3>Les propriétés: définition et usages</h3>
    <p>Nous avons créé une classe Utilisateur qui ne contient pas de code. On peut créer des variables à l’intérieur des classes. <strong>Les variables créées dans les classes sont appelées des propriétés</strong>, afin de bien les différencier des variables « classiques » créées en dehors des classes.</br>
    Reprenons notre classe <em>Utilisateur</em> et ajoutons lui deux propriétés <u>publiques</u> qu’on va appeler <em>$user_name</em> et <em>$user_pass</em>.</p>
    <p>Le mot clef <em>public</em> signifie qu’on peut accéder aux propriétés depuis l’intérieur et l’extérieur de la classe.</p>
    <p>Ici, nous déclarons les propriétés sans leur attribuer de valeur: les valeurs seront passées lors de la création d’un nouvel objet.</br>
    <strong>NOTE:</strong> il est tout-à-fait permis d’initialiser une propriété dans la classe, c’est-à-dire lui attribuer une valeur de référence <u>à la condition que ce soit une valeur constante</u>.</p>
    <p>Plus haut nous avons créé un utilisateur nommé <em>pierre</em>. Nous allons attribuer des valeurs a ses propriétés et ensuite créer une autre utilisatrice <em>mathilde</em> et lui attribuer d'autres valeurs:</p>
    <p><em>$pierre->user_name = 'Pierre';</br>
    $pierre->user_pass = 'abcdef';</br>
    $mathilde = new Utilisateur;</br>
    $mathilde->user_name = 'Mathilde';</br>
    $mathilde->user_pass = '123456';</em></p>
    <?php
        $pierre->user_name = 'Pierre';
        $pierre->user_pass = 'abcdef';
        $mathilde = new Utilisateur;
        $mathilde->user_name = 'Mathilde';
        $mathilde->user_pass = '123456';
        var_dump($mathilde);
    ?>
    <p ><span style="font-weight: bold;">Pour accéder aux propriétés définies originellement dans la classe depuis nos objets, <u>on utilise l’opérateur -> qui est appelé opérateur objet</u>.</span> Cet opérateur sert à indiquer à PHP qu’on souhaite accéder à un élément défini dans la classe via un objet créé à partir de cette classe. Notez qu’on ne précise pas de signe $ avant le nom de la propriété à laquelle on souhaite accéder dans ce cas.</p>
    <p><u>Note:</u> Dans le cas présent, on peut accéder à la propriété depuis l'objet (c’est-à-dire depuis l’extérieur de la classe) car nous l’avons définie (la propriété) avec le mot clef <em>public</em>.</p>
    <h3>Les méthodes: définition et usage</h3>
    <p>Nous pourrons déclarer des fonctions à l’intérieur des classes.</br>
    <strong>Les fonctions définies à l’intérieur d’une classe sont appelées des méthodes.</strong></br>
    Nous allons créer dans les classes des méthodes dont le rôle sera de récupérer ou de mettre à jour les valeurs des propriétés.</p>
    <p>Dans la classe Utilisateur, nous allons créer trois méthodes qu’on va appeler
        <ul>
            <li>getNom(): pour récupérer la valeur contenue dans la propriété $user_name.</li>
            <li>setNom(): pour définir ou modifier la valeur contenue dans $user_name.</li>
            <li>setPass(): pour définir ou modifier la valeur contenue dans $user_pass.</li>
        </ul>
    </p>
    <p><Strong>Notes:</Strong></br>
    1. Les méthodes qui servent à définir / modifier / mettre à jour une valeur sont appelées des <u>setters</u>.</br>
    2. On fera commencer leur nom par <em>set</em> afin de bien les identifier comme on l’a fait pour nos méthodes setNom() et setPass().</br>
    3. Les méthodes qui servent à récupérer des valeurs sont appelées des <u>getters</u> et on fera commencer leur nom par get.</p>
    <p><em>public function getNom(){</br>
    <span class="retait"></span>return $this->user_name;</br>
    }</br>
    </br>
    public function setNom($name){</br>
    <span class="retrait">$this->user_name = $name;</span></br>
    }</br>
    </br>
    public function setPasse($pass){</br>
    <span class="retrait">$this->user_pass = $pass;</span></br>
    }</em></p>
    <?php
        echo 'Le nom de l\'objet $pierre est: '.$pierre->getNom().'</br>';
        echo 'Changement du mot de passe de l\'objet $pierre avec <em>setPasse()</em>.</br>';
        $pierre->setPasse('qsdfgh');
        print_r($pierre->user_pass);
    ?>
    <p>A présent que nous avons des méthodes pour accéder/modifier les valeurs depuis l'extérieur (puisque les méthodes sont publiques), nous pourrions changer le niveau d'accessibilité des propriétés de la classe de <em>public</em> à <em>private</em>.</br>
    Dans un premier temps, nous n'allons pas le faire, car cela créérait des erreurs dans les lignes précédentes du cours, lignes où nous accédons justement à ces propriétés à partir de l'extérieur.</p>
    <p><u>Remarque</u>: on utilise un nouveau mot clef dans ces deux méthodes : le mot clef <em><u>$this</u></em>. Ce mot clef est appelé <strong>pseudo-variable</strong> et sert à faire référence à l’objet couramment utilisé.</p>
    <?php
        require('./classes/utilisateur2.class.php');
    ?>

    <h2>Constructeurs et destructeurs d'objets</h2>

    <h3>La méthode constructeur: définition et usage</h3>
    <p>La méthode constructeur sera appelée (exécutée) automatiquement à chaque fois qu’on va instancier une classe. Le constructeur permet d’initialiser des propriétés dès la création d’un objet, ce qui sera très intéressant dans de nombreuses situations.</br>
    Pour illustrer l’intérêt du constructeur, créons une classe Utilisateur2.</p>
    <?php
        $roger = new Utilisateur2('Roger', 'taaaz1964');
        var_dump($roger);
        $roger->setPasse('pwet');
        var_dump($roger);
        echo $roger->getNom().'</br>';
    ?>
    <h3>La méthode destructeur</h3>
    <p>De la même façon, on pourra définir une méthode destructeur ou plus simplement un destructeur de classe. Elle permettra de nettoyer les ressources avant que PHP ne libère l’objet de la mémoire.</br>
    Les variables-objets, comme n’importe quelle autre variable « classique », ne sont actives que durant le temps d’exécution du script puis sont ensuite détruites.</br>
    Cependant, dans certains cas, on voudra avoir la possibilité d'effectuer certaines actions juste avant que les  objets ne soient détruits (comme par exemple sauvegarder des valeurs de propriétés mises à jour ou fermer des connexions à une base de données ouvertes avec l’objet). Dans ces cas-là, on pourra effectuer ces opérations dans le destructeur puisque <strong>la méthode destructeur sera appelée automatiquement juste avant qu’un objet ne soit détruit</strong>.</br>
    Il est difficile d’expliquer concrètement l’intérêt d’un destructeur à des personnes qui n’ont pas une connaissance poussée du PHP. On pourra illustrer cela de manière plus concrète lorsqu’on parlera des bases de données. On utilisera la syntaxe function __destruct() pour créer un destructeur. <em>Notez qu’à la différence du constructeur, il est interdit de définir des paramètres dans un destructeur</em>.</p>

    <h2>Encapsulation et visibilité des propriétés et méthodes</h2>
    <p style="font-size: 1.2em;">Encapsulation: principe de regroupement des données, et du code qui les utilise, au sein d’une même unité.</p> 
    <p>On utilisera le principe d’encapsulation afin de protéger certaines données des interférences extérieures en forçant l’utilisateur à utiliser les méthodes définies pour manipuler les données (getters et setters).</br>
    Dans le contexte de la POO en PHP, l’encapsulation correspond au groupement des données (propriétés, etc.) et des données permettant de les manipuler au sein d’une classe.</br>
    L’encapsulation sera très intéressante pour empêcher que certaines propriétés ne soient manipulées depuis l’extérieur de la classe. Pour définir qui va pouvoir accéder aux différentes propriétés, méthodes et constantes des classes, on utilisera des limiteurs d’accès (ou des niveaux de visibilité) qui seront représentés par les mots-clefs
        <ul>
            <li>public</li>
            <li>private</li>
            <li>protected</li>
        </ul>
    Une bonne implémentation du principe d’encapsulation permettra de créer des codes comportant de nombreux avantages. Parmi ceux-ci, le plus important est que l’encapsulation garantira l’intégrité de la structure d’une classe en forçant l’utilisateur à passer par un chemin prédéfini pour modifier une donnée.</br>
    Le principe d’encapsulation est l’un des piliers de la POO et l’un des concepts fondamentaux -avec l’héritage- de l’orienté objet en PHP.</br>
    Le principe d’encapsulation et la définition des niveaux de visibilité devront être au centre des préoccupations notamment lors de la création d’une interface modulable comme par exemple la création d’un site auquel d’autres développeurs vont pouvoir ajouter des fonctionnalités comme WordPress ou PrestaShop (avec les modules) ou lors de la création d’un module pour une interface modulable.</br>
    L’immense majorité de ces structures sont construites en POO car c’est la façon de coder qui présente la plus grande modularité et qui permet la maintenance la plus facile car on va éclater notre code selon différentes classes. Il faudra néanmoins bien réfléchir à qui peut avoir accès à tel ou tel élément de telle classe afin de garantir l’intégrité de la structure et éviter des conflits entre des éléments de classes (propriétés, méthodes, etc.).</p>
    <h3>Les niveaux de visibilité en POO PHP</h3>
    <p>Les propriétés, méthodes ou constantes définies avec le mot clef <strong>public</strong> seront accessibles partout, c’est-à-dire depuis l’intérieur ou l’extérieur de la classe.</p>
    <p>Les propriétés, méthodes ou constantes définies avec le mot clef <strong>private</strong> ne seront accessibles que depuis l’intérieur de la classe qui les a définies.</p>
    <p>Les propriétés, méthodes ou constantes définies avec le mot clef <strong>protected</strong> ne seront accessibles que <em>depuis l’intérieur de la classe qui les a définies ainsi que depuis les classes qui en héritent ou la classe parente</em>.</br>
    Nous reparlerons du concept d’héritage plus tard dans le cours.</p>
    <p>Lors de la définition de propriétés dans une classe, il faudra obligatoirement définir un niveau de visibilité pour chaque propriété. <em>Dans le cas contraire, une erreur sera renvoyée.</em></br>
    Pour les méthodes et constantes, en revanche, nous ne sommes pas obligés de définir un niveau de visibilité même si je vous recommande fortement de la faire à chaque fois.</br>
    Les méthodes et constantes pour lesquelles nous n’avons défini aucun niveau de visibilité de manière explicite seront définies automatiquement comme publiques.</p>
    <p>Dans la classe <em>Utilisateur2</em> que nous avons créée, les méthodes sont définies comme publiques, ce qui signifie qu’on va pouvoir les exécuter depuis l’extérieur de la classe. Lorsqu’on crée un nouvel objet dans le script à partir de la classe, par exemple, on appelle (implicitement) le constructeur depuis l’extérieur de la classe.</br>
    On a le droit de le faire puisque le constructeur est défini comme public. Ensuite, le constructeur modifiera la valeur des propriétés depuis l’intérieur de la classe et c’est cela qu’il faut bien comprendre : on peut modifier la valeur des propriétés indirectement car c’est bien le constructeur défini dans la classe qui les modifie.</br>
    La même chose se passe avec la méthode getNom() qui affiche la valeur de la propriété $user_name. Cette méthode est définie comme publique, ce qui signifie qu’on peut l’appeler depuis l’extérieur de la classe. Ensuite, cette méthode va récupérer la valeur de $user_name depuis l’intérieur de la classe puisque c’est là qu’elle a été définie.</p>
    <p>L’idée à retenir est qu’on ne peut pas accéder directement aux propriétés définies comme privées depuis le script principal (c’est-à-dire depuis l’extérieur de la classe). Il faut passer par les fonctions publiques qui permettront de les manipuler depuis l’intérieur de la classe.</p>
    <h3>Comment bien choisir le niveau de visibilité des différents éléments d’une classe?</h3>
    <p>Cette problématique est relativement complexe car il n’y a pas de directive absolue. De manière générale, on essaiera toujours de protéger un maximum notre code de l’extérieur et donc de définir le niveau d’accessibilité minimum possible.</br>
    Ensuite, il faudra s’interroger sur le niveau de "sensibilité" de chaque élément et aussi sur les impacts que peuvent avoir chaque niveau d’accès à un élément sur le reste d’une classe tout en identifiant les différents autres éléments qui vont avoir besoin d’accéder à cet élément pour fonctionner.</br>
    Il n’y a pas vraiment de recette magique : il faut avoir une bonne expérience du PHP et réfléchir un maximum avant d’écrire son code pour construire le code le plus cohérent et le plus sécurisé possible. Encore une fois, cela ne s’acquière qu’avec la pratique.</br>
    <strong>Pour le moment, vous pouvez retenir le principe suivant qui fonctionnera dans la majorité des cas (mais qui n’est pas un principe absolu, attention) : on définira généralement nos <u>méthodes</u> avec le mot clef public et nos <u>propriétés</u> avec les mots clefs protected ou private.</strong></p>
</body>
</html>