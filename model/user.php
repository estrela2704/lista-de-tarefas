<?php

class User{
    private $nome;
    private $email;
    private $senha;

    public function __construct($nome, $email, $senha){
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }


}