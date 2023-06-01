<?php 
  require_once('../controller/userController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <?php if(isset($_SESSION['erro'])) : ?>     
          <div class="container-message"><?php echo $_SESSION['erro']?></div>
          <?php unset($_SESSION['erro']); ?>
        <?php endif;?>
        <h2>Login</h2>
        <form action="../controller/userController.php" method="post">
          <input type="text" name="email" placeholder="E-mail" required>
          <input type="password" name="senha" placeholder="Senha" required>
          <input type="hidden" name="tipo" value="login">
          <input type="submit" value="Entrar">
        </form>
        <div class="register">
          <p>Não tem uma conta? <a href="register.php">Registre-se</a></p>
        </div>
      </div>
</body>
</html>
