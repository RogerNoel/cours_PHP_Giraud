<?php
    require './classes/utilisateur12.class.php';
    class Admin12 extends Utilisateur12{
        protected static $ban;

        public function __construct($n, $r, $p)
        {
            $this->user_name = strtoupper($n);
            $this->user_region = $r;
            $this->user_pass = $p;
        }

        public static function statut()
        {
            echo 'Admin';
        }

        public function getNom()
        {
            echo $this->user_name . ' Admin.</br>';
        }

        public function setPrixAbo()
        {
            if($this->user_region !== 'Sud'){
                $this->prix_abo = parent::ABONNEMENT/2;
            } else {
                $this->prix_abo = parent::ABONNEMENT;
            }
        }
        public function setBan(...$banned)
        {
            foreach($banned as $item){
                self::$ban[] .= $item;
            }
            return $this;   // pour permettre le chaînage
        }
        public function getBan()
        {
            echo 'Liste des bannis: ';
            foreach(self::$ban as $item){
                echo $item . ', ';
            }
            return $this;   // pour permettre le chaînage
        }
    }
?>