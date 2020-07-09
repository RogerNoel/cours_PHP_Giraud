<?php
class Utilisateur {
    public $user_name;
    public $user_pass;

    public function getNom(){
        return $this->user_name;
    }

    public function setNom($name){
        $this->user_name = $name;
    }

    public function setPasse($pass){
        $this->user_pass = $pass;
    }
}