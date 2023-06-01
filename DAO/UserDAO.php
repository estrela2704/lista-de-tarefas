<?php 
require_once("../model/userModel.php");
require_once("../model/db.php");


class UserDAO{
    private $dbConexao;

    public function __construct(){
        $this->dbConexao = new Conexaobd('localhost', 'system', 'root', '023922');
    }

    public function buildUser(array $arr){
        $id = $arr[0]['id'];
        $nome = $arr[0]['nome'];
        $email = $arr[0]['email'];
        $senha = $arr[0]['senha'];

        $user = new User($nome, $email, $senha, $id);
        return $user;
    }

    public function autenticar($email, $senha){ 
        $conn = $this->dbConexao->conectBD();
        $query = "SELECT id, email, senha FROM user WHERE email = :email AND senha = :senha";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        $result = $stmt->rowCount();

        return $result;

    }

    public function getId($email, $senha){
        $conn = $this->dbConexao->conectBD();
        $query = "SELECT id FROM user WHERE email = :email AND senha = :senha";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }


    public function verificaRegistro($email){
        $conn = $this->dbConexao->conectBD();
        $query = "SELECT count(email) FROM user WHERE email = :email";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if($result[0][0] == 1){
            return true;
        } else {
            return false;
        }

    }

    public function registrar($nome, $email, $senha){
        $conn = $this->dbConexao->conectBD();
        $query = "INSERT INTO user (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        try{
            $stmt->execute();
            $idDoUsuario = $conn->lastInsertId();
        }catch(PDOException $e) {
            echo "Erro ao inserir registro ". $e->getMessage();
        };

        return $idDoUsuario;
    }

    public function dadosUser($id){
        $conn = $this->dbConexao->conectBD();
        $query = "SELECT id, nome, email, senha FROM user WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $dadosUsuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        return $dadosUsuario;
    }
    

}
