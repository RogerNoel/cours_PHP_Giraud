<?php
abstract class Utilisateur12{
    protected $user_name;
    protected $user_region;
    protected $prix_abo;
    protected $user_pass;
    protected $x = 0;

    public const ABONNEMENT = 15;

    abstract function setPrixAbo();

    public function __destruct()
    {
        // code ici
    }
    public static function statut()
    {
        echo 'Utilisateur';
    }
    public static function getStatut()
    {
        self::Statut();
    }
    public function getNom()
    {
        echo $this->user_name;
    }
    public function getPrixAbo()
    {
        $this->setPrixAbo();
        return $this->prix_abo;
    }
    public function plusUn(){
        $this->x++;
        echo 'X vaut ' . $this->x . '</br>';
        return $this;
    }
    public function moinsUn(){
        $this->x--;
        echo 'X vaut ' . $this->x . '</br>';
        return $this;
    }
}
?>