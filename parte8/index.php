<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parte 8</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="centralizar">
    <h1>Dados pessoais</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="container" enctype="multipart/form-data">
      <input type="text" name="nome" placeholder="Nome">
      <input type="number" name="idade" placeholder="Idade">
      <input type="text" name="endereco" placeholder="Endereco"><br>

      <input type="file" name="arquivo">
      <button type="submit" name="enviar-formulario">Salvar</button>
    </form>
  </div>
</body>

<?php
if (isset($_POST['enviar-formulario'])) :
  $formatosPermitidos = array("png", "jpeg", "jpg");
  $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);

  if (in_array($extensao, $formatosPermitidos)) :
    $pasta = "files/";
    $temp = $_FILES['arquivo']['tmp_name'];
    $novoNome = uniqid() . ".$extensao";

    if (move_uploaded_file($temp, $pasta . $novoNome)) :
      $mensagem = "Upload feito com sucesso!";

      $nome = $_POST['nome'];
      $idade = $_POST['idade'];
      $endereco = $_POST['endereco'];

      $arquivo = "file.txt";
      $conteudo = $nome . " | " . $idade . " | " . $endereco . "\r\n";

      $arquivoAberto = fopen("file.txt", "a");
      fwrite($arquivoAberto, $conteudo);
      fclose($arquivoAberto);

    else :
      $mensagem = "Erro, não foi possivel fazer upload...";
    endif;

  else :
    $mensagem = "Formato invalido";
  endif;

endif;

echo "<script>alert('$mensagem');</script>";
?>

</html>