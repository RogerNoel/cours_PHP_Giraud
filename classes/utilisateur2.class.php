<?php
class Utilisateur2 {
    protected $user_name;
    private $user_pass;

    public function __construct(string $name, $pass){
        $this->user_name = $name;
        $this->user_pass = $pass;
    }

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