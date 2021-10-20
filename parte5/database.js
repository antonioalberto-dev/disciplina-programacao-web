// Erro genérico de callback para transações de banco de dados
var errCallback = function () {
  alert("Há um erro de banco de dados!");
}

// Abrir / inicializar o banco de dados - isso vai falhar em navegadores como firefox e IE
var db = openDatabase("petshop", "1.0", "Pet Shop", 32678);

// Criar a tabela de animais se necessário
db.transaction(function (transaction) {
  transaction.executeSql("CREATE TABLE IF NOT EXISTS animais (" +
    "id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT," +
    "nome TEXT NOT NULL, telefone INTEGER NOT NULL, endereço TEXT NOT NULL);");
});

// Essa é a função salvar
var salvarcontato = function (nome, telefone, endereço, successCallback) {
  db.transaction(function (transaction) {
    transaction.executeSql(("INSERT INTO animais (nome, telefone, endereço) VALUES (?, ?, ?);"),
      [nome, telefone, endereço], function (transaction, results) { successCallback(results); }, errCallback);
  });
};

// Esta é uma função de carga, que carrega todos os animais para um determinado local
var carregacontato = function (nome, successCallback) {
  db.transaction(function (transaction) {
    transaction.executeSql(("SELECT * FROM animais WHERE nome=?"), [nome],
      function (transaction, results) { successCallback(results); }, errCallback);
  });
};

// evento documento okay
$(function () {
  var form = $("form");

  // Callback ao carregar dados 
  var atualizapagina = function (results) {
    var list = $("#nome-lista");
    list.empty();
    console.dir(results);
    if (results.rows.length == 0) {
      alert("Não há nomes aqui.");
    } else {
      $.each(results.rows, function (rowIndex) {
        var linha = results.rows.item(rowIndex);
        list.append("<li>" + linha.nome + ", " + linha.telefone + ", " + linha.endereço + "</li>");
      });
    }
  };

  // Substituir o formulário padrão apresentar em favor do nosso código
  form.submit(function (event) {
    event.preventDefault();
    salvarcontato($('#nome').val(), $('#telefone').val(), $('#endereço').val(), function () {
      alert("dados do contato " + $('#nome').val() + " salvos!");
    })
  });

  // Lista de animais vinculados a um botão na página
  $('#mostre-me').click(function () { carregacontato($('#onde').val(), atualizapagina); });
});

function recuperar() {
  db.transaction(function (tx) {
    tx.executeSql(
      'SELECT * FROM animais',
      [],
      function (tx, results) {
        var len = results.rows.length;
        alert('Existem ' + len + ' registros!');
        for (var i = 0; i < len; i++) {
          var row = results.rows.item(i);
          alert(row.id + ': ' + row.nome);
        }
      },
      function (tx, error) {
        alert('ooops ' + error.message);
      }
    );
  });
}
