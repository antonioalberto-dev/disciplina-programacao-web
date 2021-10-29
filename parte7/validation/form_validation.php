<?php
include '../utils/connection.php';
include 'validation.php';

$cpf = $_POST["cpf"];
$firstname = $_POST["firstname"];
$surname = $_POST["surname"];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];

// echo $firstname;
// echo $surname;
// echo $cpf;
// echo $password1;
// echo $password2;

if (
  valida_nome($firstname) && valida_nome($surname) && validaCPF($cpf) && validaSenhas($password1, $password2)
) :
  $sql = "INSERT INTO `user_login` (`cpf`, `firstname`, `surname`, `user_password`) 
            VALUES ('$cpf', '$firstname', '$surname', '" . sha1($password1) . "')";

  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if (!$result) :
    die('Erro: ' . mysqli_error($conn));
  else :
    echo "<script> 
      alert('Cadastro realizado com sucesso!');
    </script>";
    header("Location:../users.php");
  endif;
elseif (!valida_nome($firstname)) :
  echo "<script> 
    alert('Erro no campo nome!');
    window.location='../users.php';
  </script>";
elseif (!valida_nome($surname)) :
  echo "<script> 
    alert('Erro no campo sobrenome!');            
    window.location='../form-users.php';
  </script>";
// elseif (!validaCPF($cpf)) :
//   echo "<script> 
//     alert('Erro no campo CPF!');            
//     window.location='../form-users.php';
//   </script>";
elseif (!validaSenhas($password1, $password2)) :
  echo "<script> 
    alert('Senhas não conferem!');
    window.location='../form-users.php';
  </script>";
endif;

echo "<script> 
    window.location='../users.php';
  </script>";
