<?php
trait Inventaire13{
    protected $stock;

    public function plusUn(){
        $this->stock++;
        echo 'Stock vaut ' . $this->stock . '</br>';
        return $this;
    }
}
?>