<?php
abstract class Utilisateur12{
    protected $stock = 0;
    protected $user_name;
    protected $user_region;
    protected $prix_abo;
    protected $user_pass;

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
    public function moinsUn(){
        $this->stock--;
        echo 'Stock vaut ' . $this->x . '</br>';
        return $this;
    }
    public function plusUn(){
        $this->stock++;
        echo 'Stock vaut ' . $this->x . '</br>';
        return $this;
    }
}
?>