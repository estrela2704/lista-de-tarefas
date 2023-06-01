<?php
require_once('../DAO/tarefaDAO.php');
require_once('../model/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['nomeTarefa'];
  $desc = $_POST['descricaoTarefa'];
  $tipo = $_POST['tipo'];
  $crud = new TarefaDAO;
  if ($tipo == 'incluir') {
    $idUsuario = $_POST['idUser'];
    $idtarefas = $crud->novaTarefa($titulo, $desc, $idUsuario);
    $dados = $crud->dadosTarefa($idtarefas);
    $crud->buildTarefa($dados);
    //print_r($dados);
    header("Location:../view/home.php");
    exit();
  } else if($tipo == 'editar') {
    $id = $_POST['id'];
    $crud->editar($titulo, $desc, $id);
    header("Location:../view/home.php");
    exit();
  } else {
    $id = $_POST['id'];
    $crud->delete($id);
    header("Location:../view/home.php");
    exit();
  }
}

