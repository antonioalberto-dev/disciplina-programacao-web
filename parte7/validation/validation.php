<?php

// FUNÇÕES PARA VALIDAÇÃO DA ENTRADA DE DADOS

function validaCPF($cpf)
{
  $cpf = preg_replace('/[^0-9]/is', '', $cpf);
  if (strlen($cpf) != 11) :
    return false;
  endif;
  if (preg_match('/(\d)\1{10}/', $cpf)) :
    return false;
  endif;
  for ($t = 9; $t < 11; $t++) :
    for ($d = 0, $c = 0; $c < $t; $c++) :
      $d += $cpf[$c] * (($t + 1) - $c);
    endfor;
    $d = ((10 * $d) % 11) % 10;
    if ($cpf[$c] != $d) :
      return false;
    endif;
  endfor;
  return true;
}

function valida_nome($str)
{
  $r = str_split($str);
  $valida = false;
  foreach ($r as $char) :
    if (($char >= 'A' && $char <= 'Z') || ($char >= 'a' && $char <= 'z') || $char == ' ') :
      $valida = true;
    else :
      $valida = false;
      break;
    endif;
  endforeach;
  return $valida;
}

function verificaValoresSenha($str)
{

  $r = str_split($str);

  $result = array_unique($r);
  if (strlen($str) == count($result)) :
    return true;
  endif;

  return false;
}


function validaSenhas($str1, $str2)
{
  if ($str1 === $str2)
    if (verificaValoresSenha($str1) && strlen(($str1) >= 6)) :
      return true;
    endif;

  return false;
}

function validaEmail($email)
{
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) :
    return true;
  else :
    return false;
  endif;
}
