<?php
class Utilisateur13{
    use Inventaire13;

    protected $user_name;
    protected $user_region;
    protected $prix_abo;
    protected $user_pass;

    public const ABONNEMENT = 15;

    public function __construct($name, $region, $passe, $stock)
    {
        $this->user_name = $name;
        $this->user_region = $region;
        $this->user_pass = $passe;
        $this->stock = $stock;
    }

    function setPrixAbo(){
        if($this->user_region!=='Sud'){
            $this->prix_abo = self::ABONNEMENT/2;
        } else {
            $this->prix_abo = self::ABONNEMENT;
        }
    }

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
}
?>