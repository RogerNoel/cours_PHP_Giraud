<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO partie 3</title>
</head>
<body>
    <h1>POO - feuille 3</h1>

    <h2>Propriétés et méthodes statiques</h2>

    <h3>Définition des propriétés et méthodes statiques</h3>
    <p><u>Une propriété/méthode statique va appartenir à la classe dans laquelle elle a été définie</u> et non à une instance de classe ou à un objet en particulier.</p>
    <p>Les méthodes/propriétés statiques
    <ul>
        <li>auront donc la même définition et la même valeur pour toutes les instances d’une classe,</li>
        <li>et nous pourrons accéder à ces éléments sans avoir besoin d’instancier la classe.</li>
    </ul>    
    Pour être tout à fait précis, <em>nous ne pourrons pas accéder à une propriété statique depuis un objet</em>. </br>
    En revanche, ce sera possible dans le cas d’une méthode statique.</br>
    <strong>Attention</strong> à ne pas confondre <u>propriétés statiques</u> et <u>constantes de classe</u>: une propriété statique <em>peut tout à fait changer de valeur</em> au cours du temps à la différence d’une constante dont la valeur est fixée. Simplement, <u>la valeur</u> d’une propriété statique sera partagée par tous les objets issus de la classe dans laquelle elle a été définie.</br>
    De manière générale, nous n’utiliserons quasiment jamais de méthode statique car il n’y aura que très rarement d’intérêt à en utiliser. En revanche, les propriétés statiques vont s’avérer utiles dans de nombreux cas.</p>
    <h4>Définir et accéder à des propriétés et à des méthodes statiques</h4>
    <p>On va pouvoir définir une propriété ou une méthode statique à l’aide du mot clef <em>static</em>.</br>
    Prenons immédiatement un premier exemple: pour cela, retournons dans notre classe étendue <em>Admin3</em>. Cette classe possède une propriété <em>$ban</em> qui contient la liste des utilisateurs bannis de l’objet courant ainsi qu’une méthode <em>getBan()</em> qui renvoie le contenu de <em>$ban</em>.</br>
    Imaginons maintenant que l’on souhaite stocker la liste complète des utilisateurs bannis <u>par tous les objets de Admin</u>. Nous devrons définir une propriété dont la valeur pourra être modifiée et qui sera partagée par tous les objets de notre classe (soit une propriété qui ne va pas appartenir à un objet de la classe en particulier mais à la classe en soi).</br>
    Pour faire cela, on commence par déclarer la propriété <em>$ban</em> comme <strong>statique</strong> et ensuite on modifie le code des méthodes <em>getBan()</em> et <em>setBan()</em>: en effet, on ne peut pas accéder à une propriété statique depuis un objet, et on ne va donc pas pouvoir utiliser l’opérateur objet <em>"->"</em> pour accéder à la propriété statique. Pour ce faire, nous allons utiliser l’opérateur de résolution de portée <em>"::"</em>.</p>
    <p> <em>protected static $ban = [];</em> </p>
    <p>La propriété <em>$ban</em> appartient dès lors à la classe et sa valeur sera diffusée vers tous les objets de la classe.</p>
    <p>Ensuite on modifie <em>setBan()</em> pour utiliser la propriété statique. Rappel de la syntaxe "..." devant la liste dzs arguments: elle permet à une fonction d'accepter un nombre indéfini d'arguments, ceci afin de bannir une ou plusieurs personnes d'une seul coup. </br>
    Ensuite, dans la méthode, on remplace <em>$this->ban</em> par <em>self::$ban</em> puisque la propriété <em>$ban</em> est désormais statique: il faut donc utiliser l'opérateur de portée pour y accéder.</p>
    <p>
        <em>
            <pre>    public function setBan(...$newBanned){
        foreach($newBanned as $banned ){
            self::$ban[].=$banned;
        }
    }       </pre>
        </em>
    </p>
    <p>De même, on modifie <em>getBan()</em> pour accéder à la propriété statique:</p>
    <p>
        <em>
            <pre>
    public function getBan(){
        echo 'Liste des bannis: ';
        foreach(self::$ban as $item){
            echo $item.', ';
        }
        echo '</br>';
    }</pre>
        </em>
    </p>
    <p>Enfin créons deux instances de <em>Admin3</em> pour faire des tests: on bannira plusieurs éléments avec le premier objet et on fera de même avec le second. Ensuite, on devrait obtenir la liste complète des bannis depuis n'importe lequel de ces deux objets.</p>
    <?php
        require('./classes/admin3.class.php');
        $adminJean = new Admin3("Jean", "mmmm", "Sud");
        $adminTom = new Admin3("Roger", "pwet", "Nord");
        $adminJean->setBan("banniparJean");
        $adminTom->getBan();
        $adminTom->setBan('banniparTom1', 'banniparTom2');
        $adminJean->getBan();
    ?>

    <h2>Méthodes et classes abstraites</h2>
    <h3>Les classes et méthodes abstraites : définition et intérêt</h3>
    <p>Une <u>classe abstraite</u> est une classe qui ne pourra pas être instanciée directement et donc qu'on ne pourra pas manipuler directement.</br>
    Une <u>méthode abstraite</u> est une méthode dont seule la signature (c’est-à-dire le nom et les paramètres) pourra être déclarée mais pour laquelle on ne pourra pas déclarer d’implémentation (c’est-à-dire le code dans la fonction ou ce que fait la fonction). En gros: une fonction qui ne fait rien entre les {}.</p>
    <p><u>Dès qu’une classe possède une méthode abstraite, il faudra la déclarer comme abstraite</u>.</p>
    <p>L’intérêt principal de définir une classe comme abstraite sera de fournir un cadre strict lorsque d'autres développeurs utiliseront notre code en les forçant à définir certaines méthodes par exemple.</br>
    En effet, une classe abstraite ne peut pas être instanciée directement et contient généralement des méthodes abstraites. <em>L’idée ici va donc être de définir des classes mères abstraites et de pousser les développeurs à étendre ces classes.</em></br>
    Lors de l’héritage d’une classe abstraite, les <u>méthodes déclarées comme abstraites</u> dans la classe parent <u>doivent obligatoirement être définies dans la classe enfant</u> avec des signatures (nom et paramètres) correspondantes. Cette façon de faire sera très utile pour fournir une ligne directrice dans le cas de développements futurs. En effet, en créant un plan « protégé » (puisqu’une classe abstraite ne peut pas être instanciée directement) on force les développeurs à étendre cette classe et on les force également à définir les méthodes abstraites. Cela nous permet de nous assurer que certains éléments figurent bien dans la classe étendue et permet d’éviter certains problèmes de compatibilité en nous assurant que les classes étendues possèdent une structure de base commune.</p>
    <h3>Définir des classes et des méthodes abstraites en pratique</h3>
    <p>Pour définir une classe ou une méthode comme abstraite, nous allons utiliser le mot clef <em>abstract</em>.
    Une classe abstraite n’est pas structurellement différente d’une classe classique (à la différence de la présence potentielle de méthodes abstraites) et qu’on va donc tout à fait pouvoir ajouter des constantes, des propriétés et des méthodes classiques dans une classe abstraite.</br>
    Les seules différences sont qu’une classe abstraite <em>peut</em> contenir des méthodes abstraites et <strong>doit</strong> obligatoirement être étendue pour utiliser ses fonctionnalités.</br>
    Pour illustrer de manière pratique l’intérêt des classes et méthodes abstraites, créons les classes <em>Utilisateur4</em> et <em>Admin4</em>.</br>
    Précédemment, nous avions créé une méthode <em>setPrixAbo()</em> qui calculait le prix de l’abonnement pour un utilisateur classique dans notre classe Utilisateur et on avait surchargé le code de cette fonction dans Admin pour calculer un prix d’abonnement différent pour les admin.</br>
    Ici, cela rend notre code conceptuellement étrange car cela signifie que <em>Utilisateur4</em> définit des choses pour un type d’utilisateur qui sont les utilisateurs « de base » tandis que <em>Admin4</em> les définit pour un autre type d’utilisateur qui sont les « admin ».</br>
    Le souci que j’ai avec ce code est que chacune de nos deux classes s’adresse à un type différent d’utilisateur mais que nos deux classes ne sont pas au même niveau puisque Admin est un enfant de Utilisateur: normalement, si notre code est bien construit, on devrait voir une hiérarchie claire entre ce que représentent nos classes mères et nos classes enfants. Dans le cas présent, j’aimerais que ma classe mère définisse des choses pour TOUS les types d’utilisateurs et que les classes étendues s’occupent chacune de définir des spécificités pour UN type d’utilisateur en particulier.</br>
    Encore une fois, ici, on touche à des notions qui sont plus "de design" de conception que des notions de code en soi mais lorsqu’on code, la façon dont on crée et organise le code est au moins aussi importante que le code en soi. Il faut donc toujours essayer d’avoir la structure globale la plus claire et la plus pertinente possible.</br>
    Ici, nous allons donc partir du principe que nous avons deux grands types d’utilisateurs: les utilisateurs classiques et les administrateurs. On va donc transformer notre classe <em>Utilisateur4</em> afin qu’elle ne définisse que les choses communes à tous les utilisateurs et allons définir les spécificités de chaque type utilisateur dans des classes étendues <em>Admin4</em> et <em>Abonne4</em>.</p>
    <p>On commence par modifier la classe parent <em>Utilisateur4</em> en la définissant comme "abstract".</p>
    <p><em>abstract class Utilisateur4 { ... </em></p>
    <p>On supprime le constructeur qui sera, lui, défini dans les classes étendues et on déclare également la méthode setPrixAbo() comme abstraite.</p>
    <p><em>abstract public function setPrixAbo();</em></p>
    <p>En définissant <em>setPrixAbo()</em> comme abstraite, on force ainsi les classes étendues à l’implémenter.</p>
    <h3>Étendre des classes abstraites et implémenter des méthodes abstraites</h3>
    <p>Maintenant qu’on a défini notre classe <em>Utilisateur4</em> comme abstraite, il va falloir l’étendre et également implémenter les méthodes abstraites.</br>
    On va commencer par aller dans notre classe étendue <em>Admin4</em> et supprimer la constante <em>ABONNEMENT</em> puisque nous allons désormais utiliser celle de la classe abstraite. On va donc également modifier le code de notre méthode <em>setPrixAbo()</em>.</p>
    <?php
        require('./classes/abonne4.class.php');
        require('./classes/admin4.class.php');
        $abonneRoger = new Abonne4('Roger', 'oooo', 'Sud');
        $adminTom = new Admin4('Tom', 'ppp', 'Nord');
        $adminTom->getNom();
        $adminTom->setNom('Lucky');
        $adminTom->getNom();
        $adminTom->setPasse('papou');
        var_dump($adminTom);
        $adminTom->setPrixAbo();
        var_dump($adminTom);
        $adminTom->setBan('Lulu');
        $adminTom->getBan();
        var_dump($abonneRoger);
        $nom = $abonneRoger->getNom();
        print_r($nom);
        $abonneRoger->setPrixAbo();
        var_dump($abonneRoger);
        echo $abonneRoger->getPrixAbo();

    ?>
</body>
</html>