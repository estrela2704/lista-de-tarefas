<?php

class Erro{
    private $mensagem;

    public function setMensagem(string $mensagem){
        $this->mensagem = $mensagem;
    }

    public function getMensagem(){
        return $this->mensagem;
    }
}