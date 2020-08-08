<?php
namespace Exemple{
    include 'sousexemple.namespace.php';
    class Utilisateur{/* code de la classe */};
    const VILLE = 'Toulon';
    function bonjour(){echo 'Bonjour</br>';}
    sous\Salut();
    function pwet(){echo 'pweeeet</br>';}
    $cp = 8300;
    pwet();

    // on appelle le fonction bpnsoir() depuis cet espace de noms
    bonsoir();
    // PHP la cherche dans cet espace, si elle ne la trouve pas, elle cherche ensuite dans l'espace global
}
namespace{
    function bonsoir(){
        echo 'Bonsoir</br>';
    }
}
?>