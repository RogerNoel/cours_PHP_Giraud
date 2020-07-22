<?php

abstract class Utilisateur7 {
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

    // méthodes magiques __set() et __get()
    public function __get($propriete)
    {
        echo 'Propriété ' . $propriete . ' inaccessible.</br>';
    }

    public function __set($propriete, $valeur)
    {
        echo 'Impossible de mettre à jour la propriété ' . $propriete . ' avec la valeur ' . $valeur . ' (propriété inaccessible).</br>';
    }
}