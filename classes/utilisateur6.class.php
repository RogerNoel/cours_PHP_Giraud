<?php

abstract class Utilisateur6 {
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

    // méthodes magiques __call() et __callStatic()
    public function __call($methode, $args)
    {
        echo 'Méthode ' . $methode . ' inaccessible depuis un contexte objet.</br>Arguments passés: ' . implode(', ', $args) . '</br>';
    }

    public function __callStatic($methode, $args)
    {
        echo 'Méthode ' . $methode . ' inaccessible depuis un contexte statique.</br>Arguments passés: ' . implode(', ', $args) . '</br>';
    }
}