<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface</title>
</head>
<body>
    <h1>Notion d'interface</h1>
    <p>Elles servent à contrôler le code dans le sens où nous ne voulons pas que les codeurs qui vont travailler sur notre code changent tout et n'importe quoi.</p>
    <p>Imaginons une fonction:</p>
    <p><em>function faireTravailler(<span style="color: green; font-weight: bold;">$objet</span>){</br>
    <span style="margin-left: 15px;">var_dump("Travail en cours: {<span style="color: green; font-weight: bold;">$objet->travailler()</span>}");</span></br>
    }</em></p>
    <p>3 points importants: 
        <ol>
            <li>l'objet passé en paramètre DOIT posséder une méthode <em>travailler()</em>,</li>
            <li>je veux être sûr à 100% que l'objet possède cette méthode,</li>
            <li>si on passe en argument un objet qui ne possède pas cette méthode, ça va planter.</li>
        </ol>
    </p>
    <p>Je veux absolument que les prochains développeurs qui vont créer des objets et qui vont appeler cette méthode faireTravailler() l'appellent avec un objet qui possède la méthode travailler().</p>
    <h3>Interfaces</h3>
    <p>Une interface définit des méthodes qu'on veut rendre obligatoires à tous les objets qui se réclament de cette interface.</br>
    On peut par exemple créer une interface nommée "Travailleur" (exactement comme une classe) dans laquelle on définira une méthode <em>travailler().</em></p>
    <p><em><span style="font-weight: bold; color: red;">interface</span> Travailleur {</br>
        <span style="margin-left: 15px;">public function travailler();</span></br>
    }</em></p>
    <p>Il n'est pas nécessaire de préciser ce que fait cette méthode, il suffit simplement qu'elle soit mentionnée. On peut créer autant de méthodes qu'on veut.</p>
    <p>Revenons à nos classes <em>Employe</em> et <em>Contremaitre</em>.</br>
    Nous voulons que la classe <em>Employe</em> se réclame de l'interface <em>Travailleur</em> et "signe un contrat": ce "contrat" consiste à implémenter dans la classe <em>Employe</em> toutes les méthodes définies dans l'interface, à savoir dans notre cas la méthode <em>travailler()</em>. </p>
    <p>Le "contrat" se signe ainsi : <em>class Employe <strong>implements</strong> Travailleur</em>{}</p>
    <h4>On commence par créer l'interface</h4>
    <p>Exactement de la même manière qu'on créé une classe et on y code les méthodes qui seront obligatoires, et on peut les coder vides (seulement avec un nom: elles ne font rien).</p>
    <?php
        interface Travailleur {
            public function travailler();
        }
    ?>
    <h4>On créé la classe <em>Employe</em> qui implémente l'interface <em>Travailleur</em>.</h4>
    <p>On n'oublie pas d'y insérer une méthode <em>travailler()</em> comme "stipulé dans le contrat": cette méthode "fait" une action, dans notre cas un simple <em>echo</em>.</p>
    <?php
        class Employe implements Travailleur {
            public $nom;
            public $prenom;
            protected $age;
            
            public function getAge(){
                return $this->age;
            }
            public function setAge($age){
                if(is_int($age) && $age>18 && $age<65){
                    $this->age = $age;
                } else {
                    throw new Exception("L'âge doit être un entier compris entre 18 et 65.</br>");
                }
            }
            public function __construct($nom, $prenom, $age){
                $this->nom = $nom;
                $this->prenom = $prenom;
                $this->setAge($age);
            }
            public function presentation(){
                echo "Je m'appelle $this->prenom $this->nom et j'ai $this->age ans.</br>";
            }
            public function travailler(){
                return "L'employé $this->nom travaille.</br>";
            }
        }
    ?>
    <h4>On créé un objet, instance de la classe <em>Employe</em>.</h4>
    <p>Exactement comme on instancie n'importe quelle classe avec <em>new</em>.</p>
    <?php
        $employeMarcel = new Employe("Duran", "Marcel", 30);
        var_dump($employeMarcel);
        $employeMarcel->presentation();
        $employeMarcel->travailler();
        $employeMarcel->setAge(25);
        $employeMarcel->presentation();
        var_dump($employeMarcel);
    ?>
    <p>Du coup, on pourrait maintenant passer l'objet <em>$employeMarcel</em> dans une méthode <em>faireTravailler()</em> puisque notre objet possède la méthode <em>travailler()</em>.</p>
    <h4>Créons maintenant une classe <em>Contremaitre</em> qui <u>étend</u> la classe <em>Employe.</em></h4>
    <p>On utilise le mot-clé <em>extends</em> et on ajoute à la classe les variables/méthodes spécifiques au contremaître et bien sûr aussi une méthode <em>travailler()</em> obligatoire puisque la classe de base implémente l'interface <em>Travailleur</em>.</br>
    <strong>ATTENTION:</strong> la fonction <em>travailler()</em> doit <u>RETURN</u> une valeur.</p>
    <p>Enfin, nous pourrons créer la fonction <em>faireTravailler($unobjet)</em> de deux manières, soit
        <ul>
            <li>en tant que fonction autonome qu'on appelle via son nom dans le code,</li>
            <li>soit en tant que méthode dans un objet, cas dans lequel on appellera la méthode via la syntaxe <em>$objet->faireTravailler($autreobjet)</em>.</li>
        </ul>
    </p>
    <?php
        class Contremaitre extends Employe {
            public $voiture;

            public function __construct($nom, $prenom, $age, $voiture) {
                parent::__construct($nom, $prenom, $age);
                $this->voiture = $voiture;
            }

            public function presentation(){
                echo "Bonjour, je suis le contremaître $this->prenom $this->nom, j'ai $this->age ans et j'ai un fouet pour taper les employés.</br>";
            }
            public function conduire(){
                echo "Je conduis ma voiture de fonction, une $this->voiture.</br>";
            }
            public function travailler(){
                return "$this->prenom $this->nom, le contremaître, tape les employés.</br>";
            }
        // -----> CAS 1 : faireTravailler() est une méthode intégrée à un objet
        // et on l'appelle plus bas via son objet
            public function faireTravailler(Travailleur $objet){
            echo "Travail en cours: {$objet->travailler()}.";
        }

        }

        $contremaitreBrutus = new Contremaitre("Legland", "Brutus", 50, "Peugeot");

        // -----> CAS 2 : faireTravailler() est une fonction autonome

        // function faireTravailler(Travailleur $objet){
        //     echo "Travail en cours: {$objet->travailler()}.";
        // }

        // faireTravailler($contremaitreBrutus);
        // <-----

        // -----> ici on appelle la méthode faireTravailler() par son objet
        $contremaitreBrutus->faireTravailler($employeMarcel);

        var_dump($contremaitreBrutus);
        $contremaitreBrutus->travailler();
        $contremaitreBrutus->presentation();
        $contremaitreBrutus->setAge(48);
        $contremaitreBrutus->presentation();
        // faireTravailler($employeMarcel);
        $contremaitreBrutus->conduire();
    ?>
    <p style="font-size: 1.2em;">NE PAS OUBLIER de changer le mot-cle <em>private</em> en <em>protected</em> quand on redéfinit une méthode qui utilise une variable privée.</p>
</body>
</html>