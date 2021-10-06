function validateForm() {
  var user = document.forms['login']['user'].value;
  var password = document.forms['login']['password'].value;

  console.log(user);
  console.log(password);

  if (validateUser(user) && validatePassword(password)) {
    alert('Login realizado com sucesso!');
  }
}

function verificaCPF(strCPF) {
  var Soma;
  var Resto;
  Soma = 0;
  if (strCPF == "00000000000") return false;

  for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;

  if ((Resto == 10) || (Resto == 11)) Resto = 0;
  if (Resto != parseInt(strCPF.substring(9, 10))) return false;

  Soma = 0;
  for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
  Resto = (Soma * 10) % 11;

  if ((Resto == 10) || (Resto == 11)) Resto = 0;
  if (Resto != parseInt(strCPF.substring(10, 11))) return false;
  return true;
}

function validateUser(x) {
  if (x === '') {
    alert('Dados de usuário incorretos! Você deve fornecer 11 digitos que correspondem ao seu CPF.');
    return false;
  } else if (x.length !== 11) {
    alert('Dados de usuário incorretos! Você deve fornecer 11 digitos que correspondem ao seu CPF. Você digitou somente ' + x.length + ' digitos.');
    return false;
  }
  return true;
}

function validatePassword(x) {
  if (x === '') {
    alert('Dados de senha incorretos! Você deve fornecer no minimo 6 digitos para sua senha. Você forneceu somente ' + x.length + ' digitos.');
    return false;
  } else if (x.length < 6) {
    alert('Dados de senha incorretos! Você deve fornecer pelos menos 6 digitos para sua senha.');
    return false;
  }
  return true;
}