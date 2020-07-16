<?php
require_once('utilisateur4.class.php');

class Abonne4 extends Utilisateur4 {
    public function __construct($nom, $pass, $region){
        $this->user_name = $nom;
        $this->user_pass = $pass;
        $this->user_region = $region;
    }

    public function  setPrixAbo(){
        if($this->user_region==="Sud"){
            return $this->prix_abo = parent::ABONNEMENT/2;
        } else {
            return $this->prix_abo = parent::ABONNEMENT;
        }
    }
}