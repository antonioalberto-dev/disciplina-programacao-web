<?php
require_once 'class/usuario.php';
$u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- <link rel="stylesheet" href="css/navbar.css"> -->
  <link rel="stylesheet" href="css/style.css">
  <script src="https://kit.fontawesome.com/8e9483b7bc.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php include 'utils/navbar.php' ?>
  <div class="box centralizar">
    <h2>Login</h2>
    <form name='login' method="POST">
      <label>
        <p><i class="fas fa-user-astronaut"></i>CPF</p>
        <input type="text" name="cpf" id="cpf" />
      </label>
      <label>
        <p><i class="fa fa-unlock-alt"></i>Senha</p>
        <input type="password" name="senha" id="senha" />
      </label>
      <br>
      <div class="centralizar">
        <button class='horizontal-middle' type="submit">Entrar</button>
        <p><a href="cadastrar.php">Cadastre-se</a></p>
      </div>
    </form>
  </div>

  <?php
  if (isset($_POST['cpf'])) {
    $cpf = addslashes($_POST['cpf']);
    $senha = addslashes($_POST['senha']);
    // verifica se esta preenchido
    if (!empty($cpf) && !empty($senha)) {
      $u->conectar("projeto_login", "localhost", "root", "");
      if ($u->msgErro == '') {
        if ($u->logar($cpf, $senha)) {
          // echo "<div class='msgSucess'>Entrei!</div>";
          header("location: usuarios.php");
        } else {
          echo "<div class='msgErro'>CPF e/ou senha incorretos!</div>";
        }
      } else {
        echo "<div class='msgErro'>Erro: " . $u->msgErro . "</div>";
      }
    } else {
      echo "<div class='msgErro'>Preencha todos os campos!</div>";
    }
  }
  ?>

</body>

</html>