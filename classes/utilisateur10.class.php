<?php
abstract class Utilisateur10{
    protected $user_name;
    protected $user_region;
    protected $prix_abo;
    protected $user_pass;
    protected $x = 0; // nouveau

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

    public function plusUn(){
        $this->x++;
        echo '$x vaut ' . $this->x . '</br>';
        return $this;
    }

    public function moinsUn(){
        $this->x--;
        echo '$x vaut ' . $this->x . '</br>';
        return $this;
    }
}
?>