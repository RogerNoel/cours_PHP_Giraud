<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO 2</title>
</head>
<body>
    <h1>La POO en PHP - Partie 2</h1>
    <h2>Classes étendues et héritage</h2>

    <h3>Étendre une classe : principe et utilité</h3>

    <p>Un des grands intérêts de la POO est qu’on va pouvoir rendre notre code très modulable, ce qui va être très utile pour gérer un gros projet ou si on souhaite le distribuer à d’autres développeurs.</br>
    Cette modularité est possible de par le principe de séparation des classes, de par la réutilisation de certaines classes et de par l’implémentation de nouvelles classes en plus de classes de base déjà existantes.</br>
    Sur ce dernier point, justement, il sera possible -plutôt que de créer des classes complètement nouvelles- d’étendre (les possibilités) de classes existantes, c’est-à-dire de créer de nouvelles classes qui vont <strong>hériter</strong> des méthodes et propriétés de la classe qu’elles étendent (<em>sous réserve d’y avoir accès!</em>) tout en définissant de nouvelles propriétés et méthodes qui leur sont propres.</br>
    Certains développeurs vont pourront ainsi proposer de nouvelles fonctionnalités sans casser la structure originale de notre code et de nos scripts. C’est d’ailleurs tout le principe de la solution e-commerce PrestaShop (nous reparlerons de cela en fin de chapitre).</p>
    <p>Nous allons pouvoir étendre une classe grâce au mot clef <strong><em>extends</em></strong>. En utilisant ce mot clef, on créera une classe « fille » qui héritera de toutes les propriétés et méthodes de son parent par défaut et qui pourra les manipuler de la même façon (à condition de pouvoir y accéder).</br>
    Illustrons immédiatement cela en créant une nouvelle classe Admin  qui va étendre notre classe Utilisateur2 dans le dossier <em>classes</em>.</p>
    <p> <em>class Admin extends Utilisateur2{}</em> </p>

    <h3>Les classes étendues et la visibilité</h3>
    <p>Dans le cas présent, notre classe mère Utilisateur possède
        <ul>
            <li>deux propriétés avec un niveau de visibilité défini sur private</li>
            <li>et trois méthodes dont le niveau de visibilité est public.</li>
        </ul>
    On ne pourra pas accéder aux propriétés de la classe Utilisateur depuis la classe étendue Admin : comme ces propriétés sont définies comme privées, <em>elles n’existent que dans la classe Utilisateur</em>.</br>
    Mais les méthodes de la classe mère <em>Utilisateur2</em> sont définies comme publiques et la classe fille va en hériter DONC les objets créés à partir de la classe étendue <em>Admin</em> pourront utiliser ces méthodes pour manipuler les propriétés de la classe mère. Notez par ailleurs que si une classe fille ne définit pas de constructeur ni de destructeur, ce sont les constructeur et destructeur du parent qui seront utilisés.</p>
    <p><em>$boss = new Admin('Hugo', 'mama');</em></p>
    <?php
        require('./classes/admin.class.php');
        $boss = new Admin('Hugo', 'mama');
        var_dump($boss);
        echo 'Le nom du boss est: ' . $boss->getNom() . '.</br>';
    ?>

    <h3>Définition de nouvelles propriétés et méthodes dans une classe étendue et surcharge</h3>
    <p>L’intérêt principal d’étendre des classes plutôt que d’en définir de nouvelles se trouve dans la notion d’héritage des propriétés et des méthodes : chaque classe étendue va hériter des propriétés et des méthodes <strong>(non privées)</strong> de la classe mère. Cela permet donc une meilleure maintenance du code (puisqu’en cas de changement il suffit de modifier le code de la classe mère) et fait gagner beaucoup de temps dans l’écriture du code.</br>
    Nous allons également pouvoir définir de nouvelles propriétés et méthodes dans les classes filles et ainsi pouvoir « étendre » les possibilités de notre classe de départ.</br>
    On pourrait par exemple permettre aux objets de la classe Admin de bannir un utilisateur ou d’obtenir la liste des utilisateurs bannis. Pour cela, on peut rajouter une propriété <em>$ban</em> qui contiendra la liste des utilisateurs bannis ainsi que deux méthodes <em>setBan()</em> et <em>getBan()</em>.</p>
    <p><em>
        <pre>
        protected $ban = [];

    public function getBan(){
        echo 'Liste des bannis: ';
        foreach($this->ban as $item){
            echo $item.', ';
        }
    }

    public function setBan($item){
        $this->ban[] .= $item;
    }
        </pre>
    </em></p>

    <?php
        $boss->setBan('Tom');
        echo $boss->getBan();
        $boss->setBan('Tintin');
        echo $boss->getBan();
    ?>
    <p>En plus de définir de nouvelles propriétés et méthodes dans nos classes étendues, nous pouvons également <em>surcharger</em>, c’est-à-dire <strong>redéfinir</strong>  dans nos classes filles certaines propriétés ou méthodes de la classe mère. Pour ce faire, il suffira de déclarer à nouveau la propriété ou la méthode en question en utilisant le même nom et en lui attribuant une valeur ou un code différent.</br>
    Dans ce cas-là, il faudra respecter quelques règles notamment au niveau de la définition de la visibilité <em>qui ne devra jamais être plus réduite dans la définition surchargée par rapport à la définition de base</em>. Nous reparlerons de la surcharge plus tard dans le cours nous allons laisser ce sujet de côté pour le moment.</br>
    Finalement, notez que rien ne nous empêche d’étendre à nouveau une classe étendue: on pourrait tout à fait étendre notre classe <em>Admin</em> avec une autre classe </em>SuperAdmin</em>. L’héritage va alors traverser les générations : les classes filles de <em>Admin</em> hériteront des méthodes et propriétés <u>non privées</u> de <em>Admin</em> mais également de celles de leur grand parent <em>Utilisateur2</em>.</p>

    <h3>Comprendre la puissance et les risques liés aux classes étendues à travers l’exemple de la solution e-commerce PrestaShop</h3>
    <p>L’architecture du célèbre logiciel e-commerce PrestaShop a été créée en PHP orienté objet.</br>
    Cela rend PrestaShop modulable à l’infini et permet à des développeurs externes de développer de nouvelles fonctionnalités pour la solution. En effet, le logiciel PrestaShop de base contient déjà de nombreuses classes et certaines pourront être étendues par des développeurs externes tandis que d’autres, plus sensibles ou essentielles au fonctionnement de la solution (ce qu’on appelle des classes « coeurs ») ne vont offrir qu’un accès limité.</br>
    Le fait d’avoir créé PrestaShop de cette manière est une formidable idée puisque ça permet aux développeurs de développer de nouveaux modules qui vont s’intégrer parfaitement à la solution en prenant appui sur des classes déjà existantes dans PrestaShop.</br>
    Cependant, c’est également le point principal de risque et l’ambiguïté majeure par rapport à la qualité de cette solution pour deux raisons: le premier problème qui peut survenir est que certains développeurs peuvent par mégarde ou tout simplement par manque d’application surcharger certaines méthodes ou propriétés de classes lorsqu’ils créent leurs modules et le faire d’une façon qui va amener des bugs et des problèmes de sécurité sur les boutiques en cas d’installation du module en question. A priori, l’équipe de validation des modules de PrestaShop est là pour éviter que ce genre de modules passent et se retrouvent sur la place de marché officielle.</br>
    Le deuxième problème est beaucoup plus insidieux et malheureusement quasiment impossible à éviter: imaginons que vous installiez plusieurs modules de développeurs différents sur votre solution de PrestaShop de base. Si vous êtes malchanceux, il est possible que certains d’entre eux tentent d’étendre une même classe et donc de surcharger les mêmes méthodes ou propriétés, ou encore utilisent un même nom en créant une nouvelle classe ou en étendant une classe existante. Dans ce cas-là, il y aura bien entendu un conflit dans le code et, selon la gravité de celui-ci, cela peut faire totalement planter votre boutique; le problème étant ici que vous n’avez aucun moyen d’anticiper cela à priori lorsque vous êtes simple marchand et non un développeur aguerri.</br>
    Finalement, notez que si vous créez une architecture en POO PHP et que vous laissez la possibilité à des développeurs externes de modifier ou d’étendre cette architecture, vous devrez toujours faire bien attention à <em>proposer une rétrocompatibilité de votre code à chaque mise à jour importante</em>. En effet, imaginons que vous modifiiez une classe de votre architecture : vous devrez toujours faire en sorte que les codes d’autres développeurs utilisant cette classe avant la mise à jour restent valides pour ne pas que tout leur code plante lorsqu’ils vont eux-mêmes mettre la solution à jour (ou tout au moins les prévenir avant de mettre la mise à jour en production pour qu’ils puissent adapter leur code).</p>

    <h2>Surcharge et opérateur de résolution de portée</h2>
    <p>Nous allons voir précisément ce qu’est la surcharge d’éléments dans le cadre du PHP orienté objet ainsi que les règles liées à la surcharge.</br>
    Nous allons également en profiter pour introduire l’opérateur de résolution de portée, un opérateur qu’il convient de connaitre car il va nous servir à accéder à divers éléments dans les classes et notamment aux éléments surchargés, aux constantes et aux éléments statiques qu’on étudiera dans les prochains cours.</p>
    <h3>La surcharge de propriétés et de méthodes en PHP orienté objet</h3>
    <p><strong>En PHP, on dit qu’on « surcharge » une propriété ou une méthode d’une classe mère lorsqu’on la redéfinit dans une classe fille.</strong></br>
    Pour surcharger une propriété ou une méthode, il faut
        <ul>
            <li>la redéclarer en utilisant le <u>même nom</u>,</li>
            <li>que la nouvelle définition possède le <u>même nombre de paramètres</u>.</li>
        </ul>
    <strong>NOTE 1:</strong> seules les méthodes et propriétés définies en public ou protected pourront être surchargées: il sera impossible de surcharger des éléments définis comme private puisque ces éléments n’existent / ne sont accessibles que depuis la classe qui les déclare.</br>
    <strong>NOTE 2:</strong> lorsqu’on surcharge une propriété/méthode, la nouvelle définition <u>doit obligatoirement posséder un niveau de restriction de visibilité <strong>plus faible ou égal</strong></u>, mais ne doit en aucun cas avoir une visibilité plus restreinte que la définition de base.</br>
    Par exemple, si on surcharge une propriété définie comme protected, la nouvelle définition de la propriété ne pourra être définie qu’avec public ou protected mais pas avec private qui correspond à un niveau de visibilité plus restreint.</br>
    <u>Remarque:</u> il sera relativement rare d’avoir à surcharger des propriétés. Généralement, nous surchargerons plutôt les méthodes d’une classe mère depuis une classe fille. Prenons immédiatement un exemple concret en surchargeant la méthode <em>getNom()</em> de la classe parent <em>Utilisateur2</em> dans la classe étendue <em>Admin</em>.</p>
    <p>Voici d'abord le cas où on surcharge la méthode <em>getNom()</em> dans la classe étendue <em>Admin</em>:</p>
    <p><em><pre>    public function getNom(){
        return strtoupper($this->user_name);
    }</pre></em></p>
    <p>La propriété <em>$user_name</em> étant définie en <em>protected</em>, cette méthode surchargée fonctionne bien.</p>
    <?php
        echo $boss->getNom();
    ?>
    <p>Voici ensuite le cas où on surcharge la fonction <em>__construct()</em> dans la classe étendue <em>Admin.</em>"</p>
    <p><em><pre>    public function __construct($name, $passe){
        $this->user_pass = $passe;
        $this->user_name = strtoupper($name);
    }</pre></em></p>
    <p><strong>Note:</strong> PHP a une définition particulière de "<em>surcharge</em>" par rapport à de nombreux autres langages où « surcharger » une méthode signifie écrire différentes versions d’une même méthode avec un nombre différents de paramètres.</p>
    <h3>Accéder à une méthode ou une propriété surchargée grâce à l’opérateur de résolution de portée</h3>
    <p>Parfois, il sera intéressant d’accéder à la définition de base d’une propriété/méthode qui a été surchargée. Pour ce faire, on utilisera <strong>l’opérateur de résolution de portée</strong> qui est symbolisé par le signe :: (double deux points).</br>
    Nous devrons également utiliser cet opérateur pour accéder aux constantes, méthodes et propriétés définies comme statiques dans une classe (nous étudierons tous ces concepts dans les prochains chapitres).</br>
    Pour le moment, concentrons-nous sur l’opérateur de résolution de portée et illustrons son fonctionnement dans le cas d’une méthode ou d’une propriété surchargée.</br>
    Nous pourrons utiliser trois mots clefs pour accéder à différents éléments d’une classe avec l’opérateur de résolution de portée: les mots clefs
        <ul>
            <li>parent,</li>
            <li>self,</li>
            <li>et static.</li>
        </ul>
    Dans le cas où on souhaite accéder à une propriété ou à une méthode surchargée, le seul mot clef qui nous intéressera est le mot clef <em>parent</em> qui nous servira à indiquer qu’on souhaite accéder à la définition de la propriété ou de la méthode faite dans la classe mère.</br>
    Pour illustrer cela, nous allons modifier la méthode <em>getNom()</em> de la classe parente <em>Utilisateur2</em> afin qu’elle echo le <em>$user_name</em> de l’objet l’appelant plutôt qu’utiliser une instruction return (qui empêcherait l’exécution de tout code après l’instruction).</p>
    <p>De fait, l'instruction <em>return</em> de la méthode de la classe parente empêche de rajouter du code dans la méthode et nous voulons justement rajouter du code: dans le cadre de l'exemple, on veut rajouter un <em>echo</em> qui utilisera le <em>$user_name</em>.</br>
    On va donc dans un premier temps faire appel à la méthode parente pour récupérer le <em>$user_name</em>: </p>
    <p><em>$monNom = parent::getNom();</em></p>
    <p>Ayant ainsi récupéré le <em>$user_name</em>, on peut rajouter du code pour en faire ce qu'on désire:</p>
    <p>
        <em>
            <pre>    public function getNom(){
        $monNom = parent::getNom();
        echo 'Ceci pour surcharger la méthode <em>getNom()</em>, voici le $user_name de l\'objet: ' . $monNom;
    }</pre>
        </em>
    </p>
    <?php
        echo "</br>Résultat = ";
        echo $boss->getNom();
    ?>
    <p>Lorsqu’un objet de <em>Admin</em> (dans notre cas l'objet <em>$boss</em>) appelle <em>getNom()</em>, la méthode getNom() de Admin sera utilisée. Cette méthode appelle elle-même la méthode de la classe parent <em>Utilisateur2</em> qu’elle surcharge et ajoute un texte au résultat de la méthode surchargée.</br>
    Le mot clef parent (dans Admin) fait référence à la classe parent (Utilisateur2) de la classe dans laquelle la méthode appelante est définie.</p>

    <h2>Les constantes définies dans une classe</h2>
    <h3>Rappel sur les constantes et définition de constantes dans une classe</h3>
    <p>Une constante est un conteneur qui ne pourra stocker qu’<u>une seule et unique valeur durant la durée de l’exécution</u> d’un script.</br>
    Pour définir une constante de classe, on va utiliser le mot clef <em>const</em> suivi du nom de la constante <u>en majuscules</u>. </br>
    <strong>On ne va pas utiliser ici de signe $ comme avec les variables.</strong></br>
    Depuis la version 7.1 de PHP, on peut définir une visibilité pour nos constantes (public, protected ou private). Par ailleurs, notez également que les constantes sont allouées une fois par classe, et non pour chaque instance de classe. Cela signifie qu’une constante appartient intrinsèquement à la classe et non pas à un objet en particulier et que tous les objets instanciés d’une classe vont donc partager cette même constante de classe.</p>
    <p>Nous allons créer une classe <em>Admin2</em>, extension de <em>Utilisateur3</em>, à laquelle nous ajoutons immédiatement une constante:</p>
    <p><em>public const ABONNEMENT = 15;</em></p>
    <p>Maintenant nous créons un objet <em>$Administrateur2</em>, instance de cette nouvelle classe <em>Admin2</em>.</p>
    <?php
        require('./classes/admin2.class.php');
        $Administrateur2 = new Admin2('BossAdmin2', '2222', 'sud');
        var_dump($Administrateur2);
    ?>
    <h3>Accéder à une constante avec l’opérateur de résolution de portée</h3>
    <p>Pour accéder à une constante, nous devrons utiliser l’opérateur de résolution de portée. <em>La façon d’accéder à une constante va légèrement varier selon qu’on essaie d’y accéder depuis l’intérieur de la classe qui la définit (ou d’une classe étendue) ou depuis l’extérieur de la classe</em>.</br>
    Dans le cas où on tente d’accéder à la valeur d’une constante <u>depuis l’intérieur</u> d’une classe, il faudra utiliser l’un des deux mots clefs <em>self</em> ou <em>parent</em> qui vont permettre d’indiquer 
        <ul>
            <li>qu’on souhaite accéder à une constante définie dans la classe à partir de laquelle on souhaite y accéder (self),</li>
            <li>qu’on souhaite accéder à une constante définie dans une classe mère (parent).</li>
        </ul>
    </p>
    <p>Pour illustrer le premier cas, dans la classe <em>Admin2</em>, on créé une fonction qui doit effectuer un calcul dont une des opérandes est la constante <em>ABONNEMENT</em>:</p>
    <p>
        <em>
            <pre>    public function setPrixAbo(){
        if($this->user_region==='sud'){
            return $this->prix_abo = self::ABONNEMENT/2;
        } else {
            return $this->prix_abo = self::ABONNEMENT;
        }
    }

    public function getPrixAbo(){
        return $this->setPrixAbo();
    }</pre>
        </em>
    </p>
    <?php
        echo 'Le prix de l\'abonnement est de ' . $Administrateur2->getPrixAbo() . ' euros.</br>';
        echo 'Le prix de l\'abonnement pour la classe <em>Admin2</em> est ' .  Admin2::ABONNEMENT . ' euros.</br>';
        echo 'Le prix de l\'abonnement pour la classe <em>Utilisateur3</em> est ' .  Utilisateur3::ABONNEMENT . ' euros.</br>';
    ?>
</body>
</html>