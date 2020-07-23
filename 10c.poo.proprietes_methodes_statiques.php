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
    <strong>Attention</strong> à ne pas confondre <u>propriétés statiques</u> et <u>constantes de classe</u>: une propriété statique <em>peut tout à fait changer de valeur</em> au cours du temps à la différence d’une constante dont la valeur est fixée. Simplement, <strong><u>la valeur</u> d’une propriété statique sera partagée par tous les objets issus de la classe dans laquelle elle a été définie.</strong></br>
    De manière générale, nous n’utiliserons quasiment jamais de méthode statique car il n’y aura que très rarement d’intérêt à en utiliser. En revanche, les propriétés statiques vont s’avérer utiles dans de nombreux cas.</p>
    <h4>Définir et accéder à des propriétés et à des méthodes statiques</h4>
    <p>On va pouvoir définir une propriété ou une méthode statique à l’aide du mot clef <em>static</em>.</br>
    Prenons immédiatement un premier exemple: pour cela, retournons dans notre classe étendue <em>Admin3</em>. Cette classe possède une propriété <em>$ban</em> qui contient la liste des utilisateurs bannis de l’objet courant ainsi qu’une méthode <em>getBan()</em> qui renvoie le contenu de <em>$ban</em>.</br>
    Imaginons maintenant que l’on souhaite stocker la liste complète des utilisateurs bannis <u>par tous les objets de Admin</u>. Nous devrons définir une propriété dont la valeur pourra être modifiée et qui sera partagée par tous les objets de notre classe (soit une propriété qui ne va pas appartenir à un objet de la classe en particulier mais à la classe en soi).</br>
    Pour faire cela, on commence par déclarer la propriété <em>$ban</em> comme <strong>statique</strong> et ensuite on modifie le code des méthodes <em>getBan()</em> et <em>setBan()</em>: en effet, on ne peut pas accéder à une propriété statique depuis un objet, et on ne va donc pas pouvoir utiliser l’opérateur objet <em>"->"</em> pour accéder à la propriété statique. Pour ce faire, nous allons utiliser l’opérateur de résolution de portée <em>"::"</em>.</p>
    <p> <em>protected static $ban = [];</em> </p>
    <p>La propriété <em>$ban</em> appartient dès lors à la classe et sa valeur sera diffusée vers tous les objets de la classe.</p>
    <p>Ensuite on modifie <em>setBan()</em> pour utiliser la propriété statique. Rappel de la syntaxe "..." devant la liste des arguments: elle permet à une fonction d'accepter un nombre indéfini d'arguments, ceci afin de bannir une ou plusieurs personnes d'une seul coup. </br>
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

    <h2>Les interfaces</h2>
    <p>Les interfaces ont un but similaire aux classes abstraites: fournir un plan général pour les développeurs qui vont les implémenter et les forcer à suivre le plan donné par ces interfaces.</br>
    De la même manière que pour les classes abstraites, on ne peut instancier une interface, il faut l’implémenter, c’est-à-dire créer des classes dérivées de cette interface pour pouvoir utiliser ses éléments.</br>
    Les deux différences majeures entre les interfaces et les classes abstraites sont les suivantes:
        <ol>
            <li>Une interface ne peut contenir que les <u>signatures</u> des méthodes ainsi qu’éventuellement des constantes mais <u>pas de propriétés</u>. Cela est dû au fait qu’aucune implémentation n’est faite dans une interface : une interface n’est véritablement qu’un plan.</li>
            <li>Une classe ne peut pas étendre plusieurs autres classes à cause des problèmes d’héritage. En revanche, <u>une classe peut tout à fait implémenter plusieurs interfaces</u>.</li>
        </ol>
    Je pense qu’il est ici intéressant de bien illustrer ces deux points et notamment d’expliquer pourquoi une classe n’a pas l’autorisation d’étendre plusieurs autres classes. Pour cela, imaginons qu’on ait une première classe A qui définit la signature d’une méthode diamond() sans l’implémenter. Nous créons ensuite deux classes B et C qui étendent la classe A et qui implémentent chacune d’une manière différente la méthode diamond(). Finalement, on crée une classe D qui étend les classes B et C et qui ne redéfinit pas la méthode diamond(). Dans ce cas-là, on est face au problème suivant : la classe D doit-elle utiliser l’implémentation de diamond() faite par la classe B ou celle faite par la classe C ? Ce problème est connu sous le nom du « problème du diamant » et est la raison principale pour laquelle la plupart des langages de programmation orientés objets (dont le PHP) ne permettent pas à une classe d’étendre deux autres classes.</br>
    En revanche, il ne va y avoir aucun problème par rapport à l’implémentation par une classe de plusieurs interfaces puisque les interfaces, par définition, ne peuvent que définir la signature d’une méthode et non pas son implémentation.</br>
    (???) Profitez-en ici pour noter que les méthodes déclarées dans une classe doivent obligatoirement être publiques (puisqu’elles devront être implémentées en dehors de l’interface) et que les constantes d’interface ne pourront pas être écrasées par une classe (ou par une autre interface) qui vont en hériter (???).</p>
    <h3>Définir et implémenter une interface en pratique</h3>
    <p>On définira une interface de la même manière qu’une classe mais en utilisant cette fois-ci le mot clef <em>interface</em> à la place de <em>class</em>. Nous nommerons généralement nos fichiers d’interface en utilisant <em>« interface »</em> à la place de <em>« classe »</em>. </br>
    Par exemple, si on crée une interface nommée Utilisateur, on enregistrera le fichier d’interface sous le nom utilisateur.interface.php par convention.</p>
    <p>
        <em>
            <pre>interface utilisateur {
                public const ABONNEMENT = 15;
                public function getNom();
                public function setPrixAbo();
                public function getPrixAbo();
}               </pre>
        </em>
    </p>
    <p>On pourra réutiliser les définitions de notre interface dans des classes.</br>
    Pour cela, on va implémenter notre interface avec le mot-clef <em>implements</em>:</p>
    <p><em>class Abonne implements Utilisateur { ...</em></p>
    <?php
        require('./classes/abonne5.class.php');
        require('./classes/admin5.class.php');
        $abonneLuc = new Abonne5('Defoy', 'pass123', 'Est');
        echo 'Nom de $abonneLuc = ' . $abonneLuc->getNom() . '</br>';
        echo 'Le prix de son abonnement est de ' . $abonneLuc->getPrixAbo() . ' euros.</br>';
        echo '</br> Création d\'un nouvel Admin5: </br>';
        $adminNath = new Admin5("Nath", "Sud", "4899");
        var_dump($adminNath);
        echo 'L\'admin s\'appelle ' . $adminNath->getNom() . '</br>';
        $adminNath->setNom('NathD');
        echo 'L\'admin s\'appelle ' . $adminNath->getNom() . '</br>';
        echo 'Le prix de l\'abonnement de ' . $adminNath->getNom() . ' se monte à ' . $adminNath->getPrixAbo() . ' euros.</br>';
        $adminNath->setBan('Tom', 'Tao');
        $adminNath->getBan();
        $adminFred = new Admin5('Fred', 'Nord', '5544');
        $adminFred->setBan('Marc');
        $adminFred->getBan();
    ?>
    <p><strong>Remarque:</strong> pour accéder à une constante d’interface, il faut préciser le nom de l’interface devant l’opérateur de résolution de portée:</p>
    <p><em>return $this->prix_abo = <strong>Utilisateur5::ABONNEMENT/6</strong>;</em></p>
    <p><strong>NOTE:</strong> on peut étendre une interface en utilisant le mot clef <em>extends</em>. Dans ce cas, on crééra des interfaces étendues qui devront être implémentées par des classes (<em>class ... implements ...</em>) de la même manière que les interfaces classiques.</p>
    <h3>Interface ou classe abstraite : comment choisir?</h3>
    <p>Les interfaces et les classes abstraites semblent <em>à priori</em> servir un objectif similaire qui est de créer des plans ou le design de futures classes.</p>
    <p>Les <u>interfaces</u> ne permettent aucune implémentation mais permettent simplement de définir des <u>signatures de méthodes et des constantes</u> tandis que, dans une classe abstraite, on pourra tout à fait définir et implémenter des méthodes.</p>
    <p>Ainsi, lorsque plusieurs classes possèdent des similarités, on crééra plutôt une classe mère abstraite dans laquelle on va pouvoir implémenter les méthodes communes puis d’étendre cette classe.</br>
    En revanche, si nous avons des classes qui possèderont les mêmes méthodes mais qui vont les implémenter de manière différente, alors il sera certainement plus adapté de créer une interface pour définir les signatures des méthodes communes et d’implémenter cette interface pour laisser le soin à chaque classe fille d’implémenter les méthodes comme elles le souhaitent.</p>
    <p>Dans notre cas, par exemple, nos types d’utilisateurs partagent de nombreuses choses. Il est donc ici plus intéressant de créer une classe abstraite plutôt qu’une interface.</p>

    <h2>Les interfaces prédéfinies</h2>
    <p>De la même manière qu’il existe des <em>classes</em> prédéfinies (des classes natives prêtes à l’emploi en PHP), nous pourrons utiliser des <em>interfaces prédéfinies</em>.</br>
    Parmi celles-ci, nous pouvons notamment noter :    
        <ul>
            <li>L’interface <u>Traversable</u> dont le but est d’être l’interface de base de toutes les classes permettant de parcourir des objets.</li>
            <li>L’interface <u>Iterator</u> qui définit des signatures de méthodes pour les itérateurs.</li>
            <li>L’interface <u>IteratorAggregate</u> qui est une interface qu’on va pouvoir utiliser pour créer un itérateur externe.</li>
            <li>L’interface <u>Throwable</u> qui est l’interface de base pour la gestion des erreurs et des exceptions.</li>
            <li>L’interface <u>ArrayAccess</u> qui permet d’accéder aux objets de la même façon que pour les tableaux.</li>
            <li>L’interface <u>Serializable</u> qui permet de personnaliser la linéarisation d’objets.</li>
        </ul>
    Nous n’allons pas étudier ces interfaces en détail ici. Cependant, nous en utiliserons 
    certaines dans les parties à venir et notamment <em>Throwable</em> et des classes     dérivées prédéfinies <em>Error</em> et <em>Exception</em> dans la partie liée à la gestion des erreurs et des exceptions.
    </p>

    <h2>Les méthodes <em>magiques</em></h2>
    <p>Ce sont des méthodes qui seront appelées automatiquement suite à un évènement déclencheur propre à chacune d’entre elles. Nous allons établir la liste complète de ces méthodes magiques en PHP7 et illustrer le rôle de chacune d’entre elles.</p>
    <p>
        <ul>
            <li>
                <h3>__construct() et __destruct()</h3>
                <p>Nous les connaissons, ce sont les  « constructeur » et « destructeur ».</br>
                La méthode <strong>__construct()</strong> <u>va être appelée dès qu’on va instancier</u> une classe possédant un constructeur. Cette méthode est très utile pour initialiser les valeurs dont un objet a besoin dès sa création et avant toute utilisation de celui-ci.</br>
                La méthode <strong>__destruct()</strong> va être appelée dès qu’il n’y a plus de référence sur un objet donné ou dès qu’un objet n’existe plus dans le contexte d’une certaine application. Bien évidemment, pour que le destructeur soit appelé, vous devrez le définir dans la définition de la classe tout comme on a l’habitude de le faire avec le constructeur.</br>
                Le destructeur servira à « nettoyer » le code en détruisant un objet une fois qu’on a fini de l’utiliser. Définir un destructeur va être particulièrement utile pour effectuer des opérations juste avant que l’objet soit détruit. En effet, en utilisant un destructeur nous avons la maitrise sur le moment exact où l’objet va être détruit. Ainsi, on va pouvoir exécuter au sein de notre destructeur différentes commandes comme sauvegarder des dernières valeurs de l’objet dans une base de données, fermer la connexion à une base de données, etc. juste avant que celui-ci soit détruit.
                </p>
            </li>
            <li>
                <h3>__call() et __callStatic()</h3>
                <p>La méthode <strong>__call()</strong> <u>sera appelée dès qu’on essaie d’utiliser une méthode qui n’existe pas</u> (ou qui est inaccessible) à partir d’un objet. On va passer deux arguments à cette méthode:
                    <ul>
                        <li>le nom de la méthode qu’on essaie d’exécuter,</li>
                        <li>ainsi que les arguments relatifs à celle-ci (si elle en a).</li>
                    </ul>   
                Ces arguments vont être convertis en un tableau.</br>
                La méthode <strong>__callStatic()</strong> s’exécute dès qu’on essaie d’utiliser une méthode qui n’existe pas (ou qui est inaccessible) <u>dans un contexte statique cette fois-ci</u>. Cette méthode accepte les mêmes arguments que __call().</br>
                <em> Ces deux méthodes vont donc s’avérer très utiles pour contrôler un script et pour éviter des erreurs fatales qui l’empêcheraient de s’exécuter convenablement ou même pour prévenir des failles de sécurité</em>.
                </p>
                <p>Créons une classe abstraite <em>Utilisateur6</em></p>
                <p>
                    <em>
                        <pre>
abstract class Utilisateur6 {
    protected $user_name;
    protected $user_region;
    protected $prix_abo;
    protected $user_pass;
    
    public const ABONNEMENT = 15;

    public function __destruct(){
        // du code ici
    }

    abstract public function setPrixAbo();

    public function getNom(){
        return $this->user_name;
    }

    public function getPrixAbo(){
        return $this->setPrixAbo();
    }

    // méthodes magiques __call() et __callStatic()
    public function __call($methode, $args)
    {
        echo 'Méthode ' . $methode . ' inaccessible depuis un contexte objet.</br>Arguments passés: ' . implode(', ', $args) . '</br>';
    }

    public function __callStatic($methode, $args)
    {
        echo 'Méthode ' . $methode . ' inaccessible depuis un contexte statique.</br>Arguments passés: ' . implode(', ', $args) . '</br>';
    }
                        </pre>
                    </em>
                </p>
                <p>Si une méthode appelée depuis un contexte objet est inaccessible, <em>__call()</em> va être appelée automatiquement.</br>
                Si une méthode appelée depuis un contexte statique est inaccessible, <em>__callStatic()</em> va être appelée automatiquement.</br>
                Nos méthodes vont ici simplement renvoyer un texte avec le nom de la méthode inaccessible et les arguments passés. <u>Encore une fois, il faut bien comprendre que ce qui définit une méthode magique est simplement le fait que ces méthodes vont être appelées automatiquement dans un certain contexte</u>. Cependant, les méthodes magiques ne sont pas des méthodes prédéfinies et il va donc déjà falloir les définir quelque part pour qu’elles soient appelées et également leur fournir un code à exécuter.</br>
                Pour tester le fonctionnement de ces deux méthodes, il suffit d’essayer d’exécuter des méthodes qui n’existent pas dans notre script principal:
                </p>
                <p>
                    <em>
                        <pre>
require './classes/admin6.class.php';
$newAdmin = new Admin6('Marcel', 'Sud', '2222');
var_dump($newAdmin);
echo $newAdmin->getPrixAbo() . '</br>';
$newAdmin->test1('argument1');
echo '</br>';
Admin6::test2('arg1', 'arg2'); 
                        </pre>
                    </em>
                </p>
                <?php
                require './classes/admin6.class.php';
                    $newAdmin = new Admin6('Marcel', 'Sud', '2222');
                    var_dump($newAdmin);
                    echo $newAdmin->getPrixAbo() . '</br>';
                    $newAdmin->test1('argument1');
                    echo '</br>';
                    Admin6::test2('arg1', 'arg2');
                ?>
            </li>
            <li>
                <h3>__get(), __set(), __isset() et __unset()</h3>
                <p>La méthode <em>__get()</em> <u>va s’exécuter si on tente d’accéder à une propriété inaccessible</u> (ou qui n’existe pas) dans une classe. Elle va prendre en argument le nom de la propriété à laquelle on souhaite accéder.</br>
                La méthode <em>__set()</em> <u>s’exécute dès qu’on tente de créer ou de mettre à jour une propriété inaccessible</u> (ou qui n’existe pas) dans une classe. Cette méthode va prendre comme arguments le nom et la valeur de la propriété qu’on tente de créer ou de mettre à jour.
                </p>
                <p>Nous avons créé une classe abstraite <em>Utilisateur7</em> avec les méthodes suivantes:</p>
                <p>
                    <em>
                        <pre>
                        public function __get($propriete)
    {
        echo 'Propriété ' . $propriete . ' inaccessible.</br>';
    }

    public function __set($propriete, $valeur)
    {
        echo 'Impossible de mettre à jour la propriété ' . $propriete . ' avec la valeur ' . $valeur . ' (propriété inaccessible).</br>';
    }
                        </pre>
                    </em>
                </p>
                <?php
                    require './classes/admin7.class.php';
                    $admin7 = new Admin7('Machin', 'Nord', 'pwet');
                    echo 'Prix abonnement: ' . $admin7->getPrixAbo().'</br>';
                    $admin7->prixAbo;
                    echo '</br>';
                    $admin7->prixAbo = 7;
                ?>
                <p>De manière similaire, la méthode <em>__isset()</em> <u>va s’exécuter lorsque les fonctions isset() ou empty() sont appelées sur des propriétés inaccessibles</u>.</br>
                La fonction isset() va servir à déterminer si une variable est définie et si elle est différente de NULL tandis que la fonction empty() permet de déterminer si une variable est vide.</br>
                Finalement, la méthode <em>__unset()</em> <u>va s’exécuter lorsque la fonction unset() est appelée sur des propriétés inaccessibles</u>. La fonction unset() sert à détruire une variable.</br>
                Notez par ailleurs que les 4 méthodes magiques __get(), __set(), __isset() et __empty() ne vont pas pouvoir fonctionner dans un contexte statique mais uniquement dans un contexte objet.
                </p>
            </li>
            <li>
                <h3>__toString()</h3>
                <p>La méthode <em>__toString()</em> <u>va être appelée dès que l’on va traiter un objet comme une chaine de caractères (par exemple lorsqu’on tente d’echo un objet)</u>. <strong>Attention</strong>, cette méthode doit obligatoirement retourner une chaine ou une erreur sera levée par le PHP.
                </p>
                <p>
                    <em>
                        <pre>
    public function __toString()
    {
        return 'Nom d\'utilisateur: ' . $this->user_name . '</br>
        Prix de l\'abonnement: ' . $this->prix_abo . '</br>';
    }
                        </pre>
                    </em>
                </p>
                <?php
                    require './classes/admin8.class.php';
                    $toto = new Admin8('Tata', 'Sud', '6666');
                    $toto->setPrixAbo();
                    echo $toto;
                ?>
            </li>
            <li>
                <h3>__invoke()</h3>
                <p>La méthode <em>__invoke()</em> <u>va être appelée dès qu’on tente d’appeler un objet comme une fonction</u>.</p>
                <p>
                    <em>
                        <pre>
    public function __invoke($arg)
    {
        echo 'Un objet a été utilisé comme une fonction avec comme argument passé: ' . $arg . '</br>';
    }
                        </pre>
                    </em>
                </p>
                <p><em><pre>
    $tintin = new Admin9('Tintin', 'Nord', 'milow');
    $tintin('pwet');
                </pre></em></p>
                <?php
                    require './classes/admin9.class.php';
                    $tintin = new Admin9('Tintin', 'Nord', 'milow');
                    $tintin('pwet');
                ?>
            </li>
            <li>
                <h3>__clone()</h3>
                <p>La méthode <em>__clone()</em> <u>s’exécute dès que l’on crée un clone d’un objet pour le nouvel objet créé</u>. Cette méthode permet notamment de modifier les propriétés qui doivent l’être après avoir créé un clone pour le clone en question.</br>
                Nous parlerons du clonage d’objet dans un chapitre ultérieur.
                </p>
            </li>
            <li>
                <h3>__sleep(), __wakeup(), __set_state() et debugInfo()</h3>
                <p>Nous n’étudierons pas ces méthodes simplement car elles répondent à des besoins très précis et n'auront d’intérêt que dans un contexte et dans un environnement spécifique.
                </p>
            </li>
        </ul>
    </p>

</body>
</html>