<!DOCTYPE html>
<html lang="pt_BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parte 6</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="navbar">
    <ul>
      <li class="item-disabled">Programação WEB</li>
      <li class="item-right"><a href="https://ecampus.ufam.edu.br/ecampus/home/login" target="_blank">e-campus</a></li>
      <li class="item-right"><a href="https://ufam.edu.br" target="_blank">UFAM</a></li>
    </ul>
  </div>
  <div class="container box">
    <h1>Parte 6</h1>
    <div class="box-int">
      <?php
      $palavra = "Internet";
      echo "<h3>A palavra é: $palavra</h3>";
      echo '<p> A palavra contém ' . strlen($palavra) . ' caracteres </p>';
      ?>
    </div>
    <div class="box-int">
      <?php
      $frase = "Procure o que te faz feliz";
      echo "<h3>A frase é: $frase</h3>";
      echo "<p>Número de palavras: " . str_word_count($frase) . "</p>";
      echo "<p>Inverter uma string dada: " . strrev($frase) . "</p>";
      echo "<p>Pesquisa um texto especifico na String: " . strstr($frase, "feliz") . "</p>";
      echo "<p>Substitui texto dentro de uma sequência de caracteres: " . str_replace("feliz", "bem", $frase) . "</p>";
      ?>
    </div>
    <div class="box-int">
      <?php
      date_default_timezone_set('America/Sao_Paulo');
      //utilizei o horário de São Paulo porque o horário de Manaus estava dando problema de 1 hora a menos
      $horario = date("H:i");
      echo "<p> Horário atual: $horario</p>";
      $horario = strtotime($horario);
      if ($horario < strtotime("10:00")) {
        echo "<p> Tenha uma boa manha!</p>";
      } else if ($horario < strtotime("20:00")) {
        echo "<p> Tenha um bom dia!</p>";
      } else {
        echo "<p> Tenha uma boa noite!</p>";
      }
      ?>
    </div>

    <div class="box-int">
      <?php
      $x = 15;
      echo "<p> Execuções intermediárias: </p>";
      while ($x <= 150) {
        if ($x != 150) echo "<p>$x</p>";
        $x = $x + 15;
      }
      ?>
    </div>
  </div>
</body>

</html>