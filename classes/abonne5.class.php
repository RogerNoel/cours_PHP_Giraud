<?php

require_once './classes/utilisateur5.interface.php';

class Abonne5 implements Utilisateur5 {
    protected $user_name;
    protected $user_region;
    protected $user_pass;
    protected $prix_abo;

    public function __construct($n, $p, $r){
        $this->user_name = $n;
        $this->user_pass = $p;
        $this->user_region = $r;
    }

    public function getNom(){
        return $this->user_name;
    }

    public function setPrixAbo(){
        if($this->user_region !== 'Sud'){
            return $this->prix_abo = Utilisateur5::ABONNEMENT;
        } else {
            return $this->prix_abo = Utilisateur5::ABONNEMENT/2;
        }
    }

    public function getPrixAbo(){
        $this->setPrixAbo();
        return $this->prix_abo;
    }

}