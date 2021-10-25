window.addEventListener('load', carrega);

function carrega() {
    document.getElementById('field-nome').addEventListener('blur', leave);
    document.getElementById('field-idade').addEventListener('blur', leave);
    document.getElementById('field-endereco').addEventListener('blur', leave);
}

function leave() {
    if (this.value != '') {
        this.offsetParent.className += " ativo";
    } else {
        this.offsetParent.className = 'box';
    }
}

function inputSHOW(_show) {
    if (_show) {
        document.getElementById('field-nome').offsetParent.className += " ativo";
        document.getElementById('field-idade').offsetParent.className += " ativo";
        document.getElementById('field-endereco').offsetParent.className += " ativo";
        document.getElementById('btn-deletar').style.display = 'block';
    } else {
        document.getElementById('field-nome').offsetParent.className = 'box';
        document.getElementById('field-idade').offsetParent.className = 'box';
        document.getElementById('field-endereco').offsetParent.className = 'box';
        //document.getElementById('btn-deletar').style.display = 'none';
    }
}

function limpaCampo() {

    document.getElementById('field-id').value = '';
    document.getElementById('field-nome').value = '';
    document.getElementById('field-idade').value = '';
    document.getElementById('field-endereco').value = '';
}