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
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/stylee.css">
</head>

<body>
  <?php include 'utils/navbar.php' ?>
  <div class="wrapper">
    <div class="box-login">
      <div class="h-center">
        <h3>Cadastre-se</h3>
        <form method="POST" class="h-center">
          <input type="cpf" name="cpf" id="cpf" placeholder="CPF" />
          <input type="text" name="nome" id="nome" placeholder="Nome" />
          <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" />
          <input type="password" name="senha" id="senha" placeholder="Senha" />
          <input type="password" name="confirmaSenha" id="confirmaSenha" placeholder="Confirme sua senha" />
          <br>
          <div class="h-center">
            <button type="submit">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  // verificar se clicou no botão
  if (isset($_POST['nome'])) {
    $cpf = addslashes($_POST['cpf']);
    $nome = addslashes($_POST['nome']);
    $sobrenome = addslashes($_POST['sobrenome']);
    $senha = addslashes($_POST['senha']);
    $confirmaSenha = addslashes($_POST['confirmaSenha']);
    // verifica se esta preenchido
    if (!empty($nome) && !empty($sobrenome) && !empty($senha) && !empty($confirmaSenha)) {
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
      echo "<div class='msgErro'>Preencha todos os campos!</div>";
    }
  }
  ?>

</body>

</html>