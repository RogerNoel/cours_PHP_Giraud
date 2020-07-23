<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO avancée</title>
</head>
<body>
    <h1>Programmation orientée objet - Notions avancées</h1>

    <h2>Chainage de méthodes: principe et intérêt</h2>
    <p>Chainer des méthodes permet d’exécuter plusieurs méthodes d’affilée de façon simple et rapide en les écrivant à la suite les unes des autres, « en chaine ».</br>
    En pratique, il suffira d’utiliser l’opérateur d’objet pour chainer différentes méthodes. On écrira quelque chose de la forme <strong><em>$objet->methode1()->methode2()</em></strong>.</br>
    Cependant, pour pouvoir utiliser le chainage de méthodes, il faudra que les méthodes chainées retournent l'objet afin de pouvoir exécuter la méthode suivante. Dans le cas contraire, une erreur sera renvoyée.</p>

    <h2>Chainage de méthodes en pratiques</h2>
    <p>Prenons immédiatement un exemple afin de bien comprendre comment fonctionne le chainage de méthodes. Pour cela, nous allons nous appuyer sur la classe Utilisateur10, qui aura deux nouvelles méthodes:</p>
    <p>
        <em>
            <pre>
    protected $x = 0;

    public function plusUn(){
        $this->x++;
        echo '$x vaut ' . $this->x;
        return $this;
    }

    public function moinsUn(){
        $this->x--;
        echo '$x vaut ' . $this->x;
        return $this;
    }
            </pre>
        </em>
    </p>
    <p><strong>Notez bien</strong> l’instruction <u>return $this</em></u> <em> à la fin du code de chacune de nos deux méthodes.</br>
    <strong>Cette instruction est obligatoire</strong>. En effet, comme précisé plus haut, vous devez <u>impérativement</u> retourner l’objet en soi pour pouvoir utiliser le chainage de méthodes. Si vous omettez le <em>return $this</em> vous allez avoir une erreur.</br>
    La grande limitation des méthodes chainées est donc qu’on doit retourner l’objet afin que la méthode suivante s’exécute. On ne peut donc pas utiliser nos méthodes pour retourner une quelconque autre valeur puisqu’on ne peut retourner qu’une chose en PHP.</p>
    <p>Test de: <em>$pierre->plusUn()->plusUn()->moinsUn()->plusUn();</em></p>
    <?php
        require './classes/admin10.class.php';

        $pierre = new Admin10('Pierre', 'Nord', '2525');
        $pierre->plusUn()->plusUn()->moinsUn()->plusUn();
    ?>
</body>
</html>