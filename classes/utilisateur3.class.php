<?php

class Utilisateur3 {
    protected $user_name;
    protected $user_pass;
    protected $prix_abo;
    protected $user_region;

    public const ABONNEMENT = 15;

    public function __construct(string $name, $pass, $region){
        $this->user_name = $name;
        $this->user_pass = $pass;
        $this->user_region = $region;
    }

    public function getNom(){
        return $this->user_name;
    }

    public function setNom($name){
        $this->user_name = $name;
    }

    public function setPasse($pass){
        $this->user_pass = $pass;
    }

    public function __destruct(){
        // du code ici
    }

    public function setPrixAbo(){
        if($this->user_region==='sud'){
            return $this->prix_abo = self::ABONNEMENT/2;
        } else {
            return $this->prix_abo = self::ABONNEMENT;
        }
    }

    public function getPrixAbo(){
        return $this->setPrixAbo();
    }
}