<?php
require('utilisateur2.class.php');
class Admin extends Utilisateur2 {

    // le code suivant renverrait une erreur car la propriété $user_name de la classe Utilisateur2 est en private et non en protected.
    // public function getName(){
    //     return $this->user_name;
    // }

    protected $ban = [];

    public function getBan(){
        echo 'Liste des bannis: ';
        foreach($this->ban as $item){
            echo $item.', ';
        }
        echo '</br>';
    }

    public function setBan($item){
        $this->ban[] .= $item;
    }

    public function getNom(){
        $monNom = parent::getNom();
        echo 'Ceci pour surcharger la méthode <em>getNom()</em>, voici le $user_name de l\'objet: ' . $monNom;
    }
}