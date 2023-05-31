<?php 
require_once('../model/tarefaModel.php');
$tarefa = new Tarefa;
$listar = $tarefa->listarTodas();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/bootstrap-5.0.2/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>TO-DO LIST FELIPE</h1>
        <hr>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-12">
        <a class="btn btn-primary" href="incluir.php">Adicionar nova tarefa</a>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-12">
        <div class="list-group task-list">
              <?php foreach($listar as $lista): ?>
                <div class="tarefa">
                  <div class="row">
                      <div class="col-10 list-group-item ">
                        <h4 h4 class="h4"><?php echo $lista['titulo']?></h4>
                        <p class="lead"><?php echo $lista['descricao']?></p>
                      </div>
                      <div class="col-2 opcoes">
                        <form action="alterar.php" method="POST">
                          <input type="hidden" name="id" value="<?php echo $lista['idtarefas'] ?>"></input>
                          <button class="btn" type="submit">Editar</button>
                        </form>
                        <form action="../controller/tarefaController.php" method="POST">
                          <input type="hidden" name="id" value="<?php echo $lista['idtarefas'] ?>"></input>
                          <input type="hidden" name="tipo" value="excluir"></input>
                          <button class="btn" type="submit">Excluir</button>
                        </form>
                      </div>
                  </div>     
                </div>
              <?php endforeach?>   
        </div>
      </div>
    </div>
  </div>
</body>
</html>