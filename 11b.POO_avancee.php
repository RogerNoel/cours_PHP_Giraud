<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO avancée 2</title>
</head>
<body>
    <h1>POO avancée partie 2</h1>

    <h2>Auto-chargement des classes</h2>
    <p><u>Rappel:</u> il est considéré comme une bonne pratique en PHP orienté objet de créer un fichier par classe. </br>
    L’un des inconvénients de cette façon de procéder, cependant, est qu’on va possiblement avoir à écrire de longues séries d’inclusion de classes (une inclusion par classe) dans nos scripts lorsque ceux-ci ont besoin de plusieurs classes.</br>
    Pour éviter de rallonger le code inutilement, nous avons un moyen de charger (inclure) automatiquement les classes d’un seul coup dans un fichier.</br>
    Pour cela, nous pouvons utiliser la fonction <em>spl_autoload_register()</em>.</br>
    Cette fonction permet d’enregistrer une (ou plusieurs) fonctions qui seront mises dans une file d’attente et que le PHP appelera automatiquement dès qu’on essayera d’instancier une classe.</br>
    L’idée est donc de passer une fonction qui permet de n’inclure que les classes dont on a besoin dans un script et de passer cette fonction à <em>spl_autoload_register()</em> afin qu’elle soit appelée dès que cela est nécessaire.</p>
    <p>On pourra soit utiliser une fonction nommée, soit idéalement créer une fonction anonyme:</p>
    <p>
        <em>
            <pre>
        spl_autoload_register(function($classe){
            require './classes/'.$classe.'.class.php';
        });

        $testAdmin3 = new Admin3('Nath', '3333', 'Sud');
        echo $testAdmin3->getPrixAbo();
        $testAbonne4 = new Abonne4('Papou', '999', 'Sud');
        echo $testAbonne4->getNom() . ' paie ' . $testAbonne4->getPrixAbo() . ' euros.';
            </pre>
        </em>
    </p>
    <?php
        spl_autoload_register(function($classe){
            require_once './classes/'.$classe.'.class.php';
        });

        $testAdmin3 = new Admin3('Nath', '3333', 'Sud');
        echo $testAdmin3->getPrixAbo().'</br>';
        $testAbonne4 = new Abonne4('Papou', '999', 'Sud');
        echo $testAbonne4->getNom() . ' paie ' . $testAbonne4->getPrixAbo() . ' euros.</br>';
    ?>
    <p>On utilise la fonction <em>spl_autoload_register()</em> en lui passant une <strong>fonction anonyme</strong> en argument <span style="font-size: 0.7em;">l'argument de cette fonction anonyme, soit <em>$classe</em>, permet de remplir un <em>require</em> pré-écrit</span> dont le rôle est d’inclure des fichiers de classe.</br>
    En résultat, la fonction <em>spl_autoload_register()</em> sera appelée dès qu’on instanciera une classe et elle tentera d’inclure la classe demandée en exécutant la fonction anonyme.</br>
    Notez que cette fonction tentera également de charger les éventuelles classes parents en commençant par les parents. Dans notre cas, la fonction <em>spl_autoload_register()</em> tentera d’inclure les fichiers <em>utilisateur.class.php, admin.class.php et abonne.class.php</em> situés dans le dossier <em>classes</em>.</br>
    On comprend tout l’intérêt de placer tous les fichiers de classes dans un même dossier et de respecter une norme d’écriture lorsqu’on nomme les fichiers de classe puisque cela nous permet de pouvoir écrire des instructions formatées comme le require de notre fonction <em>spl_autoload_register()</em>.</p>
    <p><strong>Remarque:</strong> si vous tentez d’inclure une classe qui est introuvable ou inaccessible, le PHP renverra une erreur fatale.</br>
    On prendra en charge les erreurs et les exceptions en particulier en utilisant la classe <em>Exception</em>, mais ceci est un sujet relativement complexe qui justifie une partie de cours en soi. Nous verrons comment cela fonctionne en détail dans la prochaine partie.</p>

    <h2>Le mot clef final en PHP objet</h2>
    <p>Depuis la version 5 de PHP, <u>on peut empêcher les classes filles de surcharger une méthode en précisant le mot clef <em>final</em></u> avant la définition de celle-ci.</br>
    Si la classe elle-même est définie avec le mot clef final alors celle-ci ne pourra tout simplement pas être étendue. Cela peut être utile si vous souhaitez empêcher explicitement certains développeurs de surcharger certaines méthodes ou d’étendre certaines classes dans le cas d’un projet Open Source par exemple.</p>
    <h3>Définir une méthode finale</h3>
    <p>Illustrons cela avec quelques exemples, en commençant avec la définition d’une méthode finale. Pour cela, on peut écrire les classes <em>Utilisateur11</em> et <em>Admin11</em> en surchargeant par exemple la méthode <em>getNom()</em> définie dans la classe parent <em>Utilisateur11</em> depuis notre classe étendue <em>Admin11</em>:</p>
    <p>La méthode <em>getNom()</em> de <em>Utilisateur11</em>:</p>
    <p>
        <em>
            <pre>
    public function getNom() { echo $this->user_name;}
            </pre>
        </em>
    </p>
    <p>La méthode surchargée <em>getNom()</em> de <em>Admin11</em>:</p>
    <p>
        <em>
            <pre>
    public function getNom(){ echo $this->user_name . ' Admin.'; }
            </pre>
        </em>
    </p>
    <p>Lorsqu’on tente d’appeler la méthode <em>getNom()</em> depuis un objet de la classe <em>Admin11</em>, la définition de la méthode mère se retrouve bien surchargée et c’est la définition de la classe fille qui est utilisée.</p>
    <p>Si on définit la méthode <em>getNom()</em> comme <em>finale</em> dans la classe <em>Utilisateur11</em>:</p>
    <p>
        <em>
            <pre>
    <u>final</u> public function getNom() { echo $this->user_name;}
            </pre>
        </em>
    </p>
    <p>... maintenant que la méthode est définie avec le mot clef <em>final</em>, on n’a plus le droit de la surcharger dans une classe étendue. <u>Si on tente de faire cela, une erreur fatale sera levée par le PHP.</u></p>
    <h3>Définir une <em><u>classe</u> finale</em></h3>
    <p>Si on définit une classe avec le mot clef <em>final</em>, on indique que <u>la classe ne peut pas être étendue</u>. Là encore, si on tente tout de même d’étendre la classe, le PHP renverra une erreur fatale.</p>
    <p><em><pre>final class Maclasse{ ... }</pre></em></p>
    <p>Par définition, une classe finale est une classe dont l’implémentation est complète puisqu’en la déclarant comme finale on indique qu’on ne souhaite pas qu’elle puisse être étendue. Ainsi, aucune méthode abstraite n’est autorisée dans une classe finale.</p>

    <h2>Résolution statique à la volée - late static bindings</h2>
    <p>La résolution statique à la volée permet de faire référence à la classe réellement appelée dans un contexte d’héritage statique. En effet, lorsqu’on utilise le <em>self::</em> pour faire référence à la classe courante dans un contexte statique, la classe utilisée sera toujours celle dans laquelle sont définies les méthodes utilisant <em>self::</em>. Cela peut parfois produire des comportements inattendus. Regardez plutôt l’exemple cidessous pour vous en convaincre.</p>
    <p>Voici deux nouvelles méthodes dans la classe <em>Utilisateur12</em>:</p>
    <p>
        <em>
            <pre>
    public static function statut()
    {
        echo 'Utilisateur';
    }
    public static function getStatut()
    {
        self::getStatut();
    }
            </pre>
        </em>
    </p>
    <p>La méthode <em>statut()</em> de la classe <em>Utilisateur12</em> renvoie le mot « Utilisateur ». La méthode <em>getStatut()</em> sert a exécuter la méthode <em>statut()</em> de la classe courante.</p>
    <p>On surcharge la méthode <em>statut()</em> dans la classe étendue <em>Admin12</em> pour qu'elle renvoie le texte « Admin »:</p>
    <p>
        <em>
            <pre>
public static function statut()
{
    echo 'Admin';
}
            </pre>
        </em>
    </p>
    <p>Finalement, dans notre script principal, on appelle la méthode <em>getStatut()</em> depuis la classe Admin: </p>
    <p>
        <em>
            <pre>Admin12::getStatut();</pre>
        </em>
    </p>
    <p>... et cela renvoie:</p>
    <?php
        Admin12::getStatut();
    ?>
    <p>On constate que le résultat renvoyé est « Utilisateur » et non pas « Admin » comme on aurait pu le penser. Cela est dû au fait que le code <em>self::</em> dans la méthode <eml>getStatut()</eml> va toujours faire référence à la classe dans laquelle la méthode a été définie, c’est-à-dire la classe <em>Utilisateur12</em>.</br>
    Ainsi, <em>self::statut()</em> sera toujours l’équivalent de <em>Utilisateur::statut()</em> et <u>renverra toujours la valeur de la méthode statut() définie dans la classe Utilisateur</u>.</br>
    <strong>La résolution statique à la volée a été introduite justement pour dépasser ce problème précis et pour pouvoir faire référence à la classe réellement utilisée.</strong></p>
    <h3>Utilisation de la résolution statique à la volée et de static::</h3>
    <p>La résolution statique à la volée <u>permet de faire référence à la classe réellement utilisée dans un contexte statique</u>.</br>
    Pour utiliser la résolution statique à la volée, il faut utiliser le mot clef <em><u>static</u></em> à la place de <em>self</em>. Ce mot clef permet de faire référence à la classe utilisée durant l’exécution de la méthode:</p>
    <p>
        <em>
            <pre>
    public static function getStatut()
    {
        <u>static</u>::getStatut();
    }
            </pre>
        </em>
    </p>

    <h2>Les traits</h2>
    <p>Fonctionnalité PHP qui permet de réutiliser du code dans des classes indépendantes.</br>
    Très simplement, les traits correspondent à un mécanisme nous permettant de réutiliser des méthodes dans des classes indépendantes, repoussant ainsi les limites de l’héritage traditionnel.</br>
    <em>En effet, rappelez-vous qu’en PHP une classe ne peut hériter que d’une seule classe mère</em>.</br>
    Or, imaginons que nous devions définir la même opération au sein de plusieurs classes indépendantes, c’est-à-dire des classes qui ne partagent pas de fonctionnalité commune et pour lesquelles il n’est donc pas pertinent de créer une classe mère et de les faire étendre cette classe.</br>
    <strong>Dans ce cas-là, nous allons être obligé de réécrire le code correspondant à la méthode que ces classes ont en commun dans chacune des classes à moins justement d’utiliser les traits qui permettent à plusieurs classes d’utiliser une même méthode</strong>.</br>
    Par exemple, on peut imaginer qu’un site marchand possède deux classes <em>Utilisateur13</em> et <em>Produit13</em> qui vont être indépendantes mais qui vont posséder certaines méthodes en commun comme une méthode de comptage <em>plusUn()</em> par exemple.</br>
    Comme ces classes sont indépendantes et qu’on ne veut donc pas les faire hériter d’une même classe mère, on va être obligé de réécrire le code de notre méthode dans les deux classes si on n’utilise pas les traits.</p>
    <p>Dans le cas présent, ce n’est pas trop grave mais imaginez maintenant que nous ayons des dizaines de classes utilisant certaines mêmes méthodes… Cela va faire beaucoup de code écrit pour rien et en cas de modification d’une méthode il faudra modifier chaque classe, ce qui est loin d’être optimal!</br>
    Pour optimiser le code, il sera intéressant d’utiliser les traits.</br>
    Un trait est semblable -dans l’idée- à une classe mère en ces sens
        <ul>
            <li>qu’il sert à grouper des fonctionnalités qui vont être partagées par plusieurs classes,</li>
            <li>mais, à la différence des classes, on ne va pas pouvoir instancier un trait.</li>
        </ul>
    De plus, vous devez bien comprendre que le mécanisme des traits est un ajout à l’héritage «traditionnel» en PHP et que les méthodes contenues dans les traits ne vont pas être «héritées» dans le même sens que ce qu’on a pu voir jusqu’à présent par les différentes classes.</p>
    <h3>Utiliser les traits en pratique</h3>
    <p>On définira un trait de façon similaire à une classe, à la différence que nous allons utiliser le mot clef <strong>trait</strong> suivi du nom de notre trait:</br>
    <em>trait Inventaire{ ... du code comme une classe ... }</em></br>
    <u>Une bonne pratique consiste à utiliser un nouveau fichier pour chaque nouveau trait</u> (on inclura ensuite les traits dans les classes qui en ont besoin).</br>
    Pour notre exemple, on peut déjà créer un trait qu’on va appeler <em>Inventaire13</em>:</p>
    <p>
        <em>
            <pre>
    trait Inventaire13{
        protected $stock;

        public function plusUn(){
            $this->stock++;
            echo 'Stock vaut ' . $this->x;
            return $this;
        }
    }
            </pre>
        </em>
    </p>
    Notez qu’on peut tout à fait inclure des propriétés dans nos traits. Il faut cependant faire bien attention à la visibilité de celles-ci et ne pas abuser de cela au risque d’avoir un code au final moins clair et plus faillible.</br>
    <u>Notez</u> également que si on définit une propriété dans un trait, alors on ne peut pas à nouveau définir une propriété de même nom dans une classe utilisant notre trait à moins que la propriété possède la même visibilité et la même valeur initiale.</p>
    <p>Une fois le trait défini, nous devons préciser une <strong>instruction <em>use</em></strong>. pour pouvoir l’utiliser dans les différentes classes qui vont en avoir besoin. Il faut également supprimer la propriété <em>$stock</em> et la méthode <em>plusUn()</em> de ces classes.</p>
    <p>
        <em>
            <pre>
        require './traits/inventaire13.trait.php';
        $monUtilisateur = new Utilisateur13('client', "nord", '222', 10);
        $monUtilisateur->plusUn();
        $monProduit = new Produit13('pécu', 5);
        $monProduit->plusUn();
            </pre>
        </em>
    </p>
    <?php
        require './traits/inventaire13.trait.php';
        $monUtilisateur = new Utilisateur13('client', "nord", '222', 10);
        $monUtilisateur->plusUn();
        $monProduit = new Produit13('pécu', 5);
        $monProduit->plusUn();
    ?>
    
</body>
</html>