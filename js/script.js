$(function () {
//  SCRIPT GENERICO PARA GRAVAÇÃO DENTRO DO BANCO DE DADOS
    $('.content').on('submit', '.j_FormCadastro', function () {
        var table = $(this).attr('name');
        var data = $(this).serialize();
        var form = $(this);
        var Modal = $('#modal_1');
        $.ajax({
            url: 'ajax/add/add' + table + '.php',
            data: data,
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                form.find('.form_load').fadeIn();
                form.find('.alert-box').fadeOut();
            },
            success: function (resposta) {
                if (resposta.error) {
                    form.find('.alert-box').html('<div class="alert alert-danger">' + resposta.error + '</div>');
                    form.find('.alert-box').fadeIn();
                    Modal.animate({scrollTop: Modal.offset().top}, 1000);
                } else {
                    form.find('.alert-box').html('<div class="alert alert-success">' + resposta.success + '</div>');
                    form.find('.alert-box').fadeIn();
                    form.find('input[rel!="noclear"]').val('');
                    Modal.animate({scrollTop: Modal.offset().top}, 1000);
                    setTimeout(function () {
                        Modal.fadeOut();
                        setTimeout(function () {
                            Modal.modal('hide');
                        }, 500);
                    }, 1600);
                }
                form.find('.form_load').fadeOut();
            },
            error: function () {
                Modal.animate({scrollTop: Modal.offset().top}, 1000);
            }
        });
        return false;
    });
    //  Abre a MODAL_1 - Carrega a confirmação de EXCLUSÃO
    $('.content').on('click', '.j_del', function () {
        var table = $(this).attr('id');
        var id = $(this).attr('rel');
        var action = $(this).attr('action');
        var Modal = $('#modal_1');
        $.ajax({
            url: 'ajax/form/form' + action + '.php',
            data: {table: table, id: id, action: action},
            type: 'POST',
            beforeSend: function () {
                Modal.modal('show');
                Modal.find('.modal-title').html('<span>Tem certeza que deseja Excluir? <img class="loader" src="img/load.gif" /></span>');
            },
            success: function (resposta) {
                Modal.find('.modal-body').html(resposta);
                Modal.find('.loader').fadeOut(500);
            }
        });
        return false;
    });
//    SCRIPT GENERICO PARA EXCLUSÃO
    $('.content').on('submit', '.j_delete', function () {
        var table = $(this).attr('name');
        var data = $(this).serialize();
        var Modal = $('#modal_1');
        $.ajax({
            url: 'ajax/del/del' + table + '.php',
            data: data,
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                Modal.find('.form_load').fadeIn();
                Modal.find('.alert-box').fadeOut();
            },
            success: function (resposta) {
                if (resposta.error) {
                    Modal.find('.alert-box').html('<div class="alert alert-danger">' + resposta.error + '</div>');
                    Modal.find('.alert-box').fadeIn();
                    Modal.animate({scrollTop: Modal.offset().top}, 1000);
                } else {
                    Modal.find('.alert-box').html('<div class="alert alert-success">' + resposta.success + '</div>');
                    Modal.find('.alert-box').fadeIn();
                    Modal.animate({scrollTop: Modal.offset().top}, 1000);
                    setTimeout(function () {
                        Modal.fadeOut();
                        setTimeout(function () {
                            Modal.modal('hide');
                        }, 500);
                    }, 1600);
                }
                Modal.find('.form_load').fadeOut();
            }
        });
        return false;
    });
    //  Abre a MODAL_1 - Carrega o Formulários de CADASTRO
    $('.content').on('click', '.j_Add', function () {
        var loadForm = $(this).attr('id');
        var Modal = $('#modal_1');
        $.ajax({
            url: 'ajax/form/form' + loadForm + '.php',
            beforeSend: function () {
                Modal.modal('show');
                Modal.find('.modal-title').html('<span>Cadastro de ' + loadForm + ' <img class="loader" src="img/load.gif" /></span>');
            },
            success: function (resposta) {
                Modal.find('.modal-body').html(resposta);
                Modal.find('.loader').fadeOut(500);
            }
        });
        return false;
    });
    //  Abre a MODAL_2 - Carrega o Formulários de CADASTRO
    $('.content').on('click', '.j_Add2', function () {
        var loadForm = $(this).attr('id');
        var Modal = $('#modal_2');
        $.ajax({
            url: 'ajax/form/form' + loadForm + '.php',
            beforeSend: function () {
                Modal.modal('show');
                Modal.find('.modal-title').html('<span>Cadastro de ' + loadForm + ' <img class="loader" src="img/load.gif" /></span>');
            },
            success: function (resposta) {
                Modal.find('.modal-body').html(resposta);
                Modal.find('.loader').fadeOut(500);
            }
        });
        return false;
    });
//  Refresh da Pagina quando fecha Modal
    $('#modal_1').on('hidden.bs.modal', function () {
        location.reload();
    });
//    Filtragem de Lancamentos por Periodo
    $('.content').on('click', '.j_datapicker_lancamentos', function () {
        var Data = $('#datapicker_fluxo').val();
        $.ajax({
            url: 'ajax/lancamentosAjax.php',
            data: {Data: Data},
            type: 'GET',
            dataType: 'html',
            beforeSend: function () {
                $('.form_load').fadeIn();
            },
            success: function (resposta) {
                $(resposta).replaceAll('#fluxo_caixa');
                $('.form_load').fadeOut();
            }
        });
        return false;
    });
//    Filtragem de Fluxo de Caixa por Periodo
    $('.content').on('click', '.j_datapicker_fluxo', function () {
        var Data = $('#datapicker_fluxo').val();
        $.ajax({
            url: 'ajax/fluxoAjax.php',
            data: {Data: Data},
            type: 'GET',
            dataType: 'html',
            beforeSend: function () {
                $('.form_load').fadeIn();
            },
            success: function (resposta) {
                $(resposta).replaceAll('#fluxo_caixa');
                $('.form_load').fadeOut();
            }
        });
        return false;
    });

    //    Filtragem de Fluxo de Cobrança
    $('.content').on('click', '.j_datapicker_cobranca', function () {
        var Data = $('#datapicker_cobranca').val();
        console.log("on", Data);
        $.ajax({
            url: 'ajax/CobrancasAjax.php',
            data: {Data: Data},
            type: 'GET',
            dataType: 'html',
            beforeSend: function () {
                $('.form_load').fadeIn();
            },
            success: function (resposta) {
                console.log("on", resposta);
                $("#result_cobranca").html("");
                $(resposta).replaceAll('#result_cobranca');
                $('.form_load').fadeOut();
            }
        });
        return false;
    });
    //  SCRIPT LANÇAMENTOS
    //  Abre a MODAL_1 - Baixa ou Remov a Baixa de Lançamento
    $('.content').on('click', '.j_baixar', function () {
        var table = $(this).attr('id');
        var id = $(this).attr('rel');
        var action = $(this).attr('action');
        var currentTime = new Date();
        var month = currentTime.getMonth() + 1;
        var day = currentTime.getDate();
        var year = currentTime.getFullYear();
        var lanc_data_pagto = year + "-" + month + "-" + day;
        var Modal = $('#modal_1');
        $.ajax({
            url: 'ajax/upt/uptLancamentos.php',
            data: {table: table, id: id, action: action, lanc_data_pagto: lanc_data_pagto},
            type: 'POST',
            beforeSend: function () {
                Modal.modal('show');
                Modal.find('.modal-title').html('<span>Baixa de Lançamento <img class="loader" src="img/load.gif" /></span>');
            },
            success: function (resposta) {
                Modal.find('.modal-body').html('<div class="alert-box"></div>');
                Modal.find('.alert-box').html('<div class="alert alert-success">' + resposta + '</div>');
                Modal.find('.alert-box').fadeIn();
                Modal.animate({scrollTop: Modal.offset().top}, 1000);
                setTimeout(function () {
                    Modal.fadeOut();
                    setTimeout(function () {
                        Modal.modal('hide');
                    }, 500);
                }, 1600);
            }
        });
        return false;
    });
    //  Abre a MODAL_1 - Carrega a pesquisa do Imóvel que será 
    //  gerada a cobranca (MANUAL)
    $('.content').on('click', '.j_manual', function () {
        var table = $(this).attr('id');
        var id = $(this).attr('rel');
        var action = $(this).attr('action');
        var Modal = $('#modal_1');
        $.ajax({
            url: 'ajax/form/form' + table + '.php',
            data: {table: table, id: id, action: action},
            type: 'POST',
            beforeSend: function () {
                Modal.modal('show');
                Modal.find('.modal-title').html('<span>Para Qual Imóvel deseja gerar uma cobrança? <img class="loader" src="img/load.gif" /></span>');
            },
            success: function (resposta) {
                Modal.find('.modal-body').html(resposta);
                Modal.find('.loader').fadeOut(500);
            }
        });
        return false;
    });
    //  Abre a MODAL_1 - Carrega a pesquisa do Imóvel que será 
    //  gerada a cobranca (AUTOMÁTICA)
    $('.content').on('click', '.j_automatica', function () {
        var table = $(this).attr('id');
        var id = $(this).attr('rel');
        var action = $(this).attr('action');
        var Modal = $('#modal_1');
        $.ajax({
            url: 'ajax/form/form' + action + '.php',
            data: {table: table, id: id, action: action},
            type: 'POST',
            beforeSend: function () {
                Modal.modal('show');
                Modal.find('.modal-title').html('<span>Tem certeza que deseja Excluir? <img class="loader" src="img/load.gif" /></span>');
            },
            success: function (resposta) {
                Modal.find('.modal-body').html(resposta);
                Modal.find('.loader').fadeOut(500);
            }
        });
        return false;
    });
});