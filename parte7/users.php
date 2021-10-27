<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/users-style.css">
  <link rel="stylesheet" href="css/navbar.css">
  <title>Usuários</title>
</head>

<body>

  <?php include 'utils/navbar.php' ?>

  <div class="wrapper">
    <div class="box-login">
      <div class="h-center">
        <?php
        include 'utils/connection.php';

        $sql = "SELECT * FROM user_login";
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
      <td>" . $row["firstname"] . "</td>
      <td>" . $row["surname"] . "</td>
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