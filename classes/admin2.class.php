<?php

require('utilisateur3.class.php');

class Admin2 extends Utilisateur3{
    protected $ban = [];
    public const ABONNEMENT = 6;

    public function __construct($nom, $passe, $region){
        $this->user_name = strtoupper($nom);
        $this->user_pass = $passe;
        $this->user_region = $region;
    }

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

    public function setPrixAbo(){
        if($this->user_region==='sud'){
            return $this->prix_abo = self::ABONNEMENT; // constante ABONNEMENT de cette classe
        } else {
            return $this->prix_abo = parent::ABONNEMENT; // constante ABONNEMENT de la classe parente
        }
    }
}