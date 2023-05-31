<?php 
  require_once('../controller/userController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>


    <div class="container">
        <?php if(isset($_SESSION['erro'])) : ?>     
          <div class="container-message"><?php echo $_SESSION['erro']?></div>
          <?php unset($_SESSION['erro']); ?>
        <?php endif;?>
        <h2>Registro</h2>
        <form action="../controller/userController.php" method="post">
          <input type="text" name="nome" placeholder="Usuário" required>
          <input type="text" name="email" placeholder="E-mail" required>
          <input type="password" name="senha" placeholder="Senha" required>
          <input type="hidden" name="tipo" value="register">
          <input type="submit" value="Registrar">
        </form>
        <div class="register">
          <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
        </div>
      </div>
</body>
</html>

