<?php
# Substitua abaixo os dados, de acordo com o banco criado
$user = "root";
$password = "";
$database = "login_prog_web";
$host = "localhost";

// realiza a conexão com o servidor banco de dados
$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) :
  die("Falha na conexão! " . mysqli_connect_error());
endif;
