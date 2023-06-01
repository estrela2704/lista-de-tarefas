<?php 
session_start();
require_once('../model/db.php');
require_once('../model/error.php');
require_once('../DAO/UserDAO.php');

$user = new UserDAO;
$erro = new Erro;

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];
    //print_r($_POST);
    if(isset($email) && isset($senha)){
        if($tipo == 'login'){
            if($user->autenticar($email, $senha) >= 1){
                $id = $user->getId($email, $senha);
                $_SESSION['id'] = $id['id'];
                $dados = $user->dadosUser($id['id']);
                $_SESSION['nome'] = $dados['nome'];
                $_SESSION['auth'] = true;
                header("Location: ../view/home.php");
                exit();
                
            } else {
                $erro->setMensagem('email ou senha incorretos!');
                $_SESSION['erro'] = $erro->getMensagem();
                header("Location: ../view/login.php");
                exit();
            }
        } else if($tipo == 'register'){
            $nome = $_POST['nome'];
            if(!$user->verificaRegistro($email)){
                try{
                    $id = $user->registrar($nome, $email, $senha);
                    $dados = $user->dadosUser($id);
                    $user->buildUser($dados);
                    echo "Registrado!";
                    $_SESSION['id'] = $id;
                    $_SESSION['nome'] = $dados['nome'];
                    $_SESSION['auth'] = true;
                    header("Location: ../view/home.php");
                    exit();
                }catch (PDOException $e) {
                    echo "Erro ao inserir registro ". $e->getMessage();
                };
            } else{
                $erro->setMensagem('email já cadastrado');
                $_SESSION['erro'] = $erro->getMensagem();
                header("Location: ../view/register.php");
                exit();
            }  
        }
    }
}

