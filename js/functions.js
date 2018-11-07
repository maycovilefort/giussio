function getDataAtual(d) {

    if(d === undefined){
        d = 0;
    }

    var data = new Date();
    var mes = data.getMonth() + 1;
    var dia = data.getDate()+d;

    var dataRetorno = data.getFullYear() + '-' +
        (('' + mes).length < 2 ? '0' : '') + mes + '-' +
        (('' + dia).length < 2 ? '0' : '') + dia;

    return dataRetorno;
}

function apenasNumeros(e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
}