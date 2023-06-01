<?php

class User{
    private $nome;
    private $email;
    private $senha;
    private $id;

    public function __construct($nome, $email, $senha, $id){
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

}