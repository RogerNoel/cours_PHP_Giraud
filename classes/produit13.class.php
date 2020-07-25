<?php
    class Produit13{
        // use pour les traits
        use Inventaire13;
        // propriétés
        protected $nom;
        // constructeur
        public function __construct($nom, $stock)
        {
            $this->nom = $nom;
            $this->stock = $stock;
        }
        // méthodes
        public function getNom(){
            echo $this->nom;
        }
    }
?>