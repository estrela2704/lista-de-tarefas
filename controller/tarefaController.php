<?php
require_once('../model/tarefaModel.php');
require_once('../model/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['nomeTarefa'];
  $desc = $_POST['descricaoTarefa'];
  $tipo = $_POST['tipo'];
  $id = $_POST['id'];
  $crud = new Tarefa;
  if ($tipo == 'incluir') {
    $crud->novaTarefa($titulo, $desc);
    header("Location:../view/index.php");
    exit();
  } else if($tipo == 'editar') {
    $crud->editar($titulo, $desc, $id);
    header("Location:../view/index.php");
    exit();
  } else {
    $crud->delete($id);
    header("Location:../view/index.php");
    exit();
  }
}

