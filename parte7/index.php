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

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/navbar.css">
</head>

<body>
  <nav id="menu-h">
    <ul>
      <li><a href="cadastrar.php">Cadastre-se</a></li>
      <li><a href="usuarios.php">Usuários</a></li>
      <li><a href="index.php">Entrar</a></li>
    </ul>
  </nav>

  <div class="container">
    <div class="content">
      <div id="login">
        <h1>Login</h1>
        <form name='login' method="POST">
          <p>
            <input id="nome_login" type="text" name="cpf" id="cpf" placeholder="CPF" />
          </p>
          <p>
            <input type="password" name="senha" id="senha" placeholder="Senha" />
          </p>
          <p class="centralizar"><input type="submit" value="Logar"></p>
        </form>

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

      </div>
    </div>
  </div>
</body>

</html>