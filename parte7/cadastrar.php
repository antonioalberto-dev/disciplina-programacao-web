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
  <title>Cadastro</title>
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
    <div class="">
      <div class="centralizar">
        <h1>Cadastre-se</h1>
        <form method="POST" class="h-center">
          <input type="cpf" name="cpf" id="cpf" placeholder="CPF" />
          <input type="text" name="nome" id="nome" placeholder="Nome" />
          <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" />
          <input type="password" name="senha" id="senha" placeholder="Senha" />
          <input type="password" name="confirmaSenha" id="confirmaSenha" placeholder="Confirme sua senha" />
          <br>
          <div class="centralizar">
            <input type="submit" value="Salvar">
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  include 'validation/validacaoCPF.php';
  // verificar se clicou no botão
  if (isset($_POST['nome'])) {
    $cpf = addslashes($_POST['cpf']);
    $nome = addslashes($_POST['nome']);
    $sobrenome = addslashes($_POST['sobrenome']);
    $senha = addslashes($_POST['senha']);
    $confirmaSenha = addslashes($_POST['confirmaSenha']);
    // verifica se esta preenchido
    if (!empty($nome) && !empty($sobrenome) && !empty($senha) && !empty($confirmaSenha)) {
      if (validaCPF($cpf)) {
        if (strlen($senha) >= 6) {
          $u->conectar("projeto_login", "localhost", "root", "");
          if ($u->msgErro == '') {
            if ($senha == $confirmaSenha) {
              if ($u->cadastrar($cpf, $nome, $sobrenome, $senha)) {
                echo "<div class='msgSuccess'>Cadastrado com sucesso! Acesse para entrar!</div>";
              } else {
                echo "<div class='msgErro'>Usuário já cadastrado!</div>";
              }
            } else {
              echo "<div class='msgErro'>Senhas não conrrespondem!</div>";
            }
          } else {
            echo "<div class='msgErro'>Error: " . $u->msgErro . "</div>";
          }
        } else {
          echo "<div class='msgErro'>Senha deve conter pelo menos 6 caracteres!</div>";
        }
      } else {
        echo "<div class='msgErro'>CPF inválido!</div>";
      }
    } else {
      echo "<div class='msgErro'>Preencha todos os campos!</div>";
    }
  }
  ?>

</body>

</html>