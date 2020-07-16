<?php

abstract class Utilisateur4 {
    protected $user_name;
    protected $user_pass;
    protected $prix_abo;
    protected $user_region;

    public const ABONNEMENT = 15;

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

    abstract public function setPrixAbo();

    public function getPrixAbo(){
        return $this->setPrixAbo();
    }
}