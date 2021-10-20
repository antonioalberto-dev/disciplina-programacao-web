
// Erro genérico de callback para transações de banco de dados
var errCallback = function () {
  alert("Há um erro de banco de dados!");
}

// Abrir / inicializar o banco de dados - isso vai falhar em navegadores como firefox e IE
var db = openDatabase("petshop", "1.0", "Pet Shop", 32678);

// Criar a tabela de animal se necessário
db.transaction(function (transaction) {
  transaction.executeSql("CREATE TABLE IF NOT EXISTS animal (" +
    "id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT," +
    "nome TEXT NOT NULL, sexo TEXT NOT NULL, raca TEXT NOT NULL, tipo TEXT NOT NULL, idade INT NOT NULL);");
});

// Essa é a função salvar
var insertCorredor = function (nome, telefone, endereço, numero_uniforme, successCallback) {
  db.transaction(function (transaction) {
    transaction.executeSql(("INSERT INTO animal (nome, sexo, raca, tipo, idade) VALUES (?, ?, ?, ?, ?);"),
      [nome, sexo, raca, tipo, idade], function (transaction, results) { successCallback(results); }, errCallback);
  });
};

// Esta é uma função de carga, que carrega todos os animal para um determinado local
var consultaCorredor = function (nome, successCallback) {
  db.transaction(function (transaction) {
    transaction.executeSql(("SELECT * FROM animal WHERE tipo=?"), [nome],
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
        list.append("<li>" + linha.nome + ", " + linha.tipo + + ", " + linha.raca + "</li>");
      });
    }
  };

  // Substituir o formulário padrão apresentar em favor do nosso código
  form.submit(function (event) {
    event.preventDefault();
    insertCorredor($('#nome').val(), $('#sexo').val(), $('#raca').val(), $('#tipo').val(), $('#idade').val(), function () {
      alert("Dados do animal " + $('#nome').val() + " salvos!");
    })
  });

  // Lista de animal vinculados a um botão na página
  $('#mostre-me').click(function () { consultaCorredor($('#onde').val(), atualizapagina); });
});

function recuperar() {
  db.transaction(function (tx) {
    tx.executeSql(
      'SELECT * FROM animal',
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

function verficabrowser() {
  if (window.openDatabase) {
    alert("Este browser suporta Web SQL Databases");
  }
  else {
    alert("Este browser suporta NÃO Web SQL Databases");
  }
}

function criarbanco() {
  var db = openDatabase(
    'meuBanco',
    '1.0',
    'My database',
    2 * 1024 * 1024
  );

  db.transaction(function (tx) {
    tx.executeSql(
      'CREATE TABLE IF NOT EXISTS contacts (id, name)',
      [],
      function () {
        tx.executeSql(
          'INSERT INTO contacts (id, name) VALUES (1, "Elemar")');
        tx.executeSql(
          'INSERT INTO contacts (id, name) VALUES (2, "Bill Gates")');
      }
    );
  });
  alert("banco criado e populado");
}

function recuperar() {

  var db = openDatabase(
    'meuBanco',
    '1.0',
    'My database',
    2 * 1024 * 1024
  );

  db.transaction(function (tx) {
    tx.executeSql(
      'SELECT * FROM contacts',
      [],
      function (tx, results) {
        var len = results.rows.length;
        alert('Existem ' + len + ' registros!');
        for (var i = 0; i < len; i++) {
          var row = results.rows.item(i);
          alert(row.id + ': ' + row.name);
        }
      },
      function (tx, error) {
        alert('ooops ' + error.message);
      }
    );
  });
}

function excluirtabela() {
  var db = openDatabase(
    'meuBanco',
    '1.0',
    'My database',
    2 * 1024 * 1024
  );

  db.transaction(function (tx) {
    tx.executeSql(
      'DROP TABLE contacts',
      [],
      function (tx, results) {
        alert('Tabela excluída');
      },
      function (tx, error) {
        alert('ooops ' + error.message);
      }
    );
  });
}