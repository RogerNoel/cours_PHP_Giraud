<?php

abstract class Utilisateur9 {
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

    // méthodes magiques __invoke()
    public function __invoke($arg)
    {
        echo 'Un objet a été utilisé comme une fonction avec comme argument passé: ' . $arg . '</br>';
    }
}