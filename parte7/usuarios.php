<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/table.css">
  <title>Usuários</title>
</head>

<body>

  <nav id="menu-h">
    <ul>
      <li><a href="cadastrar.php">Cadastre-se</a></li>
      <li><a href="usuarios.php">Usuários</a></li>
      <li><a href="index.php">Entrar</a></li>
    </ul>
  </nav>

  <div class="wrapper">
    <div class="box-login">
      <div class="h-center">
        <?php
        include 'utils/connection.php';

        $sql = "SELECT * FROM usuarios";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($result->num_rows > 0) {
          echo "<table>
    <thead>
    <tr>
    <th>CPF</th>
    <th>Nome</th>
    <th>Sobrenome</th>
    </tr>
    </thead>
    <tbody>";

          while ($row = $result->fetch_assoc()) :
            echo "<tr>
      <td>" . $row["cpf"] . "</td>
      <td>" . $row["nome"] . "</td>
      <td>" . $row["sobrenome"] . "</td>
      </tr>";
          endwhile;

          echo "</tbody></table>";
          $conn->close();
        } else echo "<h2>Nenhum registro encontrado</h2>";

        ?>
      </div>
    </div>
  </div>
</body>

</html>