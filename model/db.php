<?php 

class ConexaoBD {
  private $host;
  private $usuario;
  private $senha;
  private $bd;

  public function __construct(string $host, string $bd, string $usuario, string $senha){
      $this->host = $host;
      $this->bd = $bd;
      $this->usuario = $usuario;
      $this->senha = $senha;
  }

  public function conectBD(){
    
    try{
      $con = new PDO("mysql:host={$this->host};dbname={$this->bd}", $this->usuario, $this->senha);
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $con;
    }catch(PDOException $e){
      echo "Erro ao acessar o banco " . $e->getMessage();
    }

  }

}