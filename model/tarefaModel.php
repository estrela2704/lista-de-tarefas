<?php
require_once('db.php');

class Tarefa{

  private $titulo;
  private $desc;
  private $id;

  public function __construct($titulo, $desc, $id){
      $this->titulo = $titulo;
      $this->desc = $desc;
      $this->id = $id;
  }


}

