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
</body>
</html>