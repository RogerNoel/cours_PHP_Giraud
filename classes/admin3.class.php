<?php

require('utilisateur3.class.php');

class Admin3 extends Utilisateur3{
    protected static $ban = [];
    public const ABONNEMENT = 6;

    public function __construct($nom, $passe, $region){
        $this->user_name = strtoupper($nom);
        $this->user_pass = $passe;
        $this->user_region = $region;
    }

    public function getBan(){
        echo 'Liste des bannis: ';
        foreach(self::$ban as $item){
            echo $item.', ';
        }
        echo '</br>';
    }

    public function setBan(...$newBanned){
        foreach($newBanned as $banned ){
            self::$ban[].=$banned;
        }
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