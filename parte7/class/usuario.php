<?php

class Usuario
{

  private $pdo;
  public $msgErro = '';

  public function conectar($nome, $host, $usuario, $senha)
  {
    global $pdo;
    global $msgErro;
    try {
      $pdo = new PDO("mysql:dbname=" . $nome . ";host=" . $host, $usuario, $senha);
    } catch (PDOException $e) {
      $msgErro = $e->getMessage();
    }
  }

  public function cadastrar($cpf, $nome, $sobrenome, $senha)
  {
    global $pdo;
    // verificar se já existe cpf cadastrado
    $sql = $pdo->prepare("SELECT cpf FROM usuarios WHERE cpf = :c");
    $sql->bindValue(":c", $cpf);
    $sql->execute();
    if ($sql->rowCount() > 0) :
      // caso tenha o cpf cadastrado
      return false;
    else :
      // caso não, cadastrar
      $sql = $pdo->prepare("INSERT INTO usuarios (cpf, nome, sobrenome, senha) 
        VALUES (:c, :n, :s, :p)");
      $sql->bindValue(":c", $cpf);
      $sql->bindValue(":n", $nome);
      $sql->bindValue(":s", $sobrenome);
      $sql->bindValue(":p", md5($senha));
      $sql->execute();
      return true;
    endif;
  }

  public function logar($cpf, $senha)
  {
    global $pdo;
    // verificar se o email e senha estao cadastrados, se sim
    $sql = $pdo->prepare("SELECT cpf FROM usuarios WHERE cpf = :c AND senha = :s");
    $sql->bindValue(":c", $cpf);
    $sql->bindValue(":s", md5($senha));
    $sql->execute();
    if ($sql->rowCount() > 0) :
      // entrar no sistema (sessao)
      echo "<div class='msgSuccess'>Logado com sucesso</div>";
      return true; // logado com sucesso
    else :
      return false; //não foi possivel logar
    endif;
  }
}
