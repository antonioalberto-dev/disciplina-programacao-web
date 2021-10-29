<?php
include "../utils/connection.php";

$cpf = $_POST["cpf"];
$password = sha1($_POST["password"]);
$sql = "SELECT * FROM user_login WHERE cpf='" . $cpf . "' and user_password='" . $password . "'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<script> 
      alert('Login efetuado com sucesso!');
      window.location='../users.php';
    </script>";
  }
} else
  echo "<script> 
    alert('Falha ao efetuar login!'); 
    window.location='../index.php';
  </script>";
