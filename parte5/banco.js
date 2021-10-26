window.addEventListener('load', carregado);

var db = openDatabase("myDB", "1.0", "TiPS Database Example", 2 * 1024 * 1024);

function carregado() {

    document.getElementById('btn-salvar').addEventListener('click', salvar);
    document.getElementById('btn-deletar').addEventListener('click', deletar);
    document.getElementById('btn-cons').addEventListener('click', consultaIndividual);

    db.transaction(function (tx) {
        tx.executeSql("CREATE TABLE IF NOT EXISTS myTable ( id INTEGER PRIMARY KEY, nome TEXT, idade TEXT, endereco TEXT)");
    });

    mostrar();

}

// Módulo de cadastro
function salvar() {
    var id = document.getElementById('field-id').value;
    var nome = document.getElementById('field-nome').value;
    var idade = document.getElementById('field-idade').value;
    var endereco = document.getElementById('field-endereco').value;

    db.transaction(function (tx) {
        if (id) {
            tx.executeSql('UPDATE myTable SET nome=?, idade=?, endereco=? WHERE id=?', [nome, idade, endereco, id], null);
        } else {
            tx.executeSql('INSERT INTO myTable ( nome,idade,endereco) VALUES (?, ?, ?)', [nome, idade, endereco]);
        }
    });

    mostrar();
    limpaCampo();
    inputSHOW(false);
}

// módulo de atualizar
function atualizar(_id) {

    var id = document.getElementById('field-id');
    var nome = document.getElementById('field-nome');
    var idade = document.getElementById('field-idade');
    var endereco = document.getElementById('field-endereco');

    id.value = _id;

    db.transaction(function (tx) {
        tx.executeSql('SELECT * FROM myTable WHERE id=?', [_id], function (tx, resultado) {
            var rows = resultado.rows[0];

            nome.value = rows.nome;
            idade.value = rows.idade;
            endereco.value = rows.endereco;
        });
    });
    inputSHOW(true);
}

// módulo de exclusão atráves de um campo
function deletar() {

    var id = document.getElementById('field-id').value;

    db.transaction(function (tx) {
        tx.executeSql("DELETE FROM myTable WHERE id=?", [id]);
    });

    mostrar();
    limpaCampo();
    inputSHOW(false);
}

// módulo de consulta para todos os registros
function mostrar() {
    var table = document.getElementById('tbody-register');

    db.transaction(function (tx) {
        tx.executeSql('SELECT * FROM myTable', [], function (tx, resultado) {
            var rows = resultado.rows;
            var tr = '';
            for (var i = 0; i < rows.length; i++) {
                tr += '<tr>';
                tr += '<td>' + rows[i].nome + '</td>';
                tr += '<td>' + rows[i].idade + ' anos </td>';
                tr += '<td>' + rows[i].endereco + '</td>';
                tr += '<td onClick="atualizar(' + rows[i].id + ')">' + "<img src='https://img.icons8.com/external-becris-lineal-becris/30/FFFFFF/external-edit-mintab-for-ios-becris-lineal-becris.png'/>" + '</td>';
                tr += '</tr>';
            }
            table.innerHTML = tr;

        }, null);
    });
}

// módulo de consulta individual
function consultaIndividual() {
    idade = document.getElementById('id-consulta').value;
    console.log(idade);
    var element = document.getElementById('cons-div');

    db.transaction(function (tx) {
        tx.executeSql('SELECT * FROM myTable where idade = ?', [idade], function (tx, resultado) {
            var rows = resultado.rows;
            var tr = '';
            for (var i = 0; i < rows.length; i++) {
                tr += '<ul>';
                tr += '<li>' + rows[i].nome + ' | ' + rows[i].idade + ' anos | ' + rows[i].endereco + '</li>';
                tr += '</ul>';
            }
            element.innerHTML = tr;

        }, null);
    });
}

