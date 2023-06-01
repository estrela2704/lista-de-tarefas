<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/bootstrap-5.0.2/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script>
    <?php if(!isset($_SESSION['auth']) || $_SESSION['auth'] == 0): ?>
      alert("Voce precisa estar logado!");
      window.location.href = "login.php";
    <?php endif; ?>
  </script>
  <title>Document</title>
</head>
<body>
  <div class="container">
    <h1 class="mt-4">Adicionar Nova Tarefa</h1>
    <hr>
    <form action="../controller/tarefaController.php" method="POST">
      <div class="form-group">
        <label class="titulo-t" for="nomeTarefa">Nome da Tarefa</label>
        <input type="text" class="form-control" name="nomeTarefa" id="nomeTarefa" placeholder="Digite o nome da tarefa" required>
        <input type="hidden" value="incluir" name="tipo">
        <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="idUser">
      </div>
      <div class="form-group">
        <label class="titulo-t" for="descricaoTarefa">Descrição da Tarefa</label>
        <textarea class="form-control" id="descricaoTarefa" name="descricaoTarefa" rows="3" placeholder="Digite a descrição da tarefa" required></textarea>
      </div>
      <button type="submit" class="botao btn btn-primary">Adicionar</button>
    </form>
  </div>
</body>
</html>