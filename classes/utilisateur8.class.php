<?php

abstract class Utilisateur8 {
    protected $user_name;
    protected $user_region;
    protected $prix_abo;
    protected $user_pass;
    
    public const ABONNEMENT = 15;

    public function __destruct(){
        // du code ici
    }

    abstract public function setPrixAbo();

    public function getNom(){
        return $this->user_name;
    }

    public function getPrixAbo(){
        return $this->setPrixAbo();
    }

    // méthodes magiques __toString()
    public function __toString()
    {
        return 'Nom d\'utilisateur: ' . $this->user_name . '</br>
        Prix de l\'abonnement: ' . $this->prix_abo . '</br>';
    }
}