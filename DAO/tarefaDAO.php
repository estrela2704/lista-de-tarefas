<?php
require_once("../model/tarefaModel.php");

class TarefaDAO{
    private $conexao;

    public function __construct(){
        $this->conexao = new ConexaoBD('localhost', 'system', 'root', '');
      }

    public function buildTarefa(array $arr){
        $id = $arr[0]['idtarefas'];
        $titulo = $arr[0]['titulo'];
        $desc = $arr[0]['descricao'];

        $tarefa = new Tarefa($titulo, $desc, $id);
        return $tarefa;
    }

    public function dadosTarefa($id){
        $conn = $this->conexao->conectBD();
        $query = "SELECT idtarefas, titulo, descricao FROM tarefas WHERE idtarefas = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $dadosTarefa = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $dadosTarefa;
    }

    public function novaTarefa(string $titulo, string $descricao, $iduser){
        $conn = $this->conexao->conectBD();
        $query = "INSERT INTO tarefas(titulo, descricao, id_user) VALUES (:titulo, :descricao, :iduser)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':iduser', $iduser);
        try{
          $stmt->execute();
          $idTarefa = $conn->lastInsertId();
        } catch(PDOException $e){
          echo "Erro ao criar nova tarefa" . $e->getMessage();
        }
        return $idTarefa;
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

      public function listbyId($id){
        $conn = $this->conexao->conectBD();
        $query = 'SELECT * FROM tarefas WHERE id_user = :id';
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
