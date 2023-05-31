<?php
require_once('db.php');

class Tarefa{
  private $conexao;
  
  public function __construct(){
    $this->conexao = new ConexaoBD('localhost', 'felipe_pdo', 'root', '023922');
  }

  public function novaTarefa(string $titulo, string $descricao){
    $conn = $this->conexao->conectBD();
    $query = "INSERT INTO tarefas(titulo, descricao) VALUES (:titulo, :descricao)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':descricao', $descricao);
    try{
      $stmt->execute();
    } catch(PDOException $e){
      echo "Erro ao criar nova tarefa" . $e->getMessage();
    }
  }

  public function editar(string $titulo, string $descricao, string $idtarefa){
    $conn = $this->conexao->conectBD();
    $query = 'UPDATE tarefas SET titulo = :titulo, descricao = :descricao WHERE idtarefas = :id ';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':id', $idtarefa);
    try{
      $stmt->execute();
    } catch(PDOException $e){
      echo "Erro ao editar tarefa " . $e->getMessage() ."<br>";
    }
  
  }

  public function delete($idtarefa){
    $conn = $this->conexao->conectBD();
    $query = 'DELETE FROM tarefas WHERE idtarefas = :id ';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $idtarefa);
    try{
      $stmt->execute();
    } catch(PDOException $e){
      echo "Erro ao deletar tarefa" . $e->getMessage();
    }
  }

  public function listarTodas(){
    $conn = $this->conexao->conectBD();
    $query = 'SELECT * FROM tarefas';
    $stmt = $conn->prepare($query);
    try{
      $stmt->execute();
      $result = $stmt->fetchAll();
      //print_r($result);
      return $result;
    } catch(PDOException $e){
      echo "Erro ao listar tarefas" . $e->getMessage();
    }
  }

  public function listarEsp($id){
    $conn = $this->conexao->conectBD();
    $query = 'SELECT * FROM tarefas WHERE idtarefas = :id';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    try{
      $stmt->execute();
      $result = $stmt->fetchAll();
      //print_r($result);
      return $result;
    } catch(PDOException $e){
      echo "Erro ao listar tarefas" . $e->getMessage();
    }
  }

}

