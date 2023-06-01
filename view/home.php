<?php 
session_start();
$id = $_SESSION['id'];
$nome = $_SESSION['nome'];
require_once('../DAO/tarefaDAO.php');
$tarefa = new TarefaDAO;
$listar = $tarefa->listbyId($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD</title>
  <script>
    <?php if($_SESSION['auth'] != 1): ?>
      alert("Voce precisa estar logado!");
      window.location.href = "login.php";
    <?php endif; ?>
  </script>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/bootstrap-5.0.2/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
  <div class="container">
  <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1>Lisa de tarefas <?php echo $_SESSION['nome'] ?></h1>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
    <hr>
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