<?php 

class UserDAO{
    private $dbConexao;

    public function __construct(){
        $this->dbConexao = new Conexaobd('localhost', 'system', 'root', '023922');
    }

    public function autenticar($email, $senha){ 
        $conn = $this->dbConexao->conectBD();
        $query = "SELECT email, senha FROM user WHERE email = :email AND senha = :senha";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        $result = $stmt->fetchAll();

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
        try{
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();
        }catch(PDOException $e) {
            echo "Erro ao inserir registro ". $e->getMessage();
        };
    }

}