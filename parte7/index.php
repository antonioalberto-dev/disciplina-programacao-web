<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/navbar.css">
  <script src="https://kit.fontawesome.com/8e9483b7bc.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php include 'utils/navbar.php' ?>
  <div class="grid">
    <div class="box-login horizontal-middle vertical-middle">
      <h2>Login</h2>
      <form name='login' action='validation/login_validation.php'>
        <label>
          <p><i class="fas fa-user-astronaut"></i>CPF</p>
          <input type="text" name="cpf" id="cpf" />
        </label>
        <label>
          <p><i class="fa fa-unlock-alt"></i>Senha</p>
          <input type="password" name="password" id="password" />
        </label>
        <br>
        <div class="horizontal-middle">
          <button class='horizontal-middle' type="submit">Entrar</button>
          <p><a href="#">Cadastre-se</a></p>
        </div>
      </form>
    </div>
  </div>
</body>

</html>