<?php

require_once './classes/utilisateur5.interface.php';

class Admin5 implements Utilisateur5 {
    protected $user_name;
    protected $prix_abo;
    protected $user_region;
    private $user_pass;
    protected static $ban;

    public function __construct($nom, $region, $pass){
        $this->user_name = $nom;
        $this->user_region = $region;
        $this->user_pass = $pass;
    }

    public function getNom(){
        return $this->user_name;
    }

    public function setNom($nom){
        $this->user_name = $nom;
    }

    public function setPrixAbo(){
        if($this->user_region==="Sud"){
            return $this->prix_abo = Utilisateur5::ABONNEMENT/6;
        } else {
            return $this->prix_abo = Utilisateur5::ABONNEMENT/3;
        }
    }

    public function getPrixAbo()
    {
        $this->setPrixAbo();
        return $this->prix_abo;
    }

    public function setBan(... $banned)
    {
        foreach($banned as $item){
            self::$ban[] .= $item;
        }
    }

    public function getBan()
    {
        echo 'La liste de tous les bannis est : ';
        foreach(self::$ban as $item){
            echo $item . ' - ';
        }
        echo '</br>';
    }
}