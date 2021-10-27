<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="css/form-style.css">
  <link rel="stylesheet" href="css/navbar.css">
</head>

<body>
  <?php include 'utils/navbar.php' ?>
  <div class="wrapper">
    <div class="box-login">
      <div class="h-center">
        <h3>Cadastre-se</h3>
        <form method="POST" name='login' class="h-center" action="validation/form_validation.php">
          <input type="cpf" name="cpf" id="cpf" placeholder="CPF" />
          <input type="text" name="firstname" id="firstname" placeholder="Nome" />
          <input type="text" name="surname" id="surname" placeholder="Sobrenome" />
          <input type="password" name="password" id="password" placeholder="Senha" />
          <input type="password" name="password2" id="password2" placeholder="Confirme sua senha" />
          <br>
          <div class="h-center">
            <button type="submit">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>