<?php 
session_start();
require_once('../model/db.php');
require_once('../model/error.php');
require_once('../model/UserDAO.php');

$user = new UserDAO;
$erro = new Erro;

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];
    print_r($_POST);
    if(isset($email) && isset($senha)){
        if($tipo == 'login'){
            if($user->autenticar($email, $senha)){
                header("Location: ../view/home.php");
                exit();
            } else {
                $erro->setMensagem('email ou senha incorretos!');
                $_SESSION['erro'] = $erro->getMensagem();
                header("Location: ../view/login.php");
                exit();
            }
        } else if($tipo == 'register'){
            if(!$user->verificaRegistro($email)){
                try{
                    $user->registrar($nome, $email, $senha);
                    echo "Registrado!";
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

