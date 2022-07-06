<?php

class Assinatura{
    public $nome;
    public $url;
    
    function __construct($nome,$url){
        $this->nome = $nome;
        $this->url = $url;
    }
    
    function Download(){
        file_put_contents("../assets/assinaturas/$this->nome.png", file_get_contents($this->url));
    }

}




?>