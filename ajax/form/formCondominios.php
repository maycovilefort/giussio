<?php
require_once ('../../_app/Config.inc.php');
$Read = new Read;
?>

<!-- INICIO - Form Clientes -->
<form name="Condominios" class="j_FormCadastro" action="" method="POST">
    <div class="alert-box"></div>
    <input class="noclear" type="hidden" name="action" value="create" />

    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Quais os dados primários do Condôminio?</h4>

    <div class="form-group col-md-3">
        <label>CNPJ:</label>
        <input type="text" name="cond_cnpj" class="form-control mask_cnpj" placeholder="Somente números" />
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-md-9">
        <label>Nome:</label>
        <input type="text" name="cond_nome" class="form-control" placeholder="Digite o nome completo..." />
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Qual é o Endereço?</h4>

    <div class="form-group col-md-4">
        <label>CEP:</label>
        <input type="text" name="cond_cep" class="form-control j_cep mask_cep" />
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-md-6">
        <label>Endereço:</label>
        <input type="text" name="cond_endereco" class="form-control" readonly />
    </div>

    <div class="form-group col-md-2">
        <label>Numero:</label>
        <input type="text" name="cond_num" class="form-control" />
    </div>

    <div class="form-group col-md-4">
        <label>Complemento:</label>
        <input type="text" name="cond_comp" class="form-control" />
    </div>

    <div class="form-group col-md-5">
        <label>Bairro:</label>
        <input type="text" name="cond_bairro" class="form-control" readonly />
    </div>

    <div class="form-group col-md-5">
        <label>Cidade:</label>
        <input type="text" name="cond_cidade" class="form-control" readonly  />
    </div>

    <div class="form-group col-md-2">
        <label>UF:</label>
        <input type="text" name="cond_uf" class="form-control" readonly />
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Quais são os dados de Contato</h4>

    <div class="form-group col-md-3">
        <label>Telefone:</label>
        <input type="text" name="cond_telefone" class="form-control mask_telefone" />
    </div>

    <div class="form-group col-md-3">
        <label>E-mail:</label>
        <input type="email" name="cond_email" class="form-control" placeholder="Digite um E-mail válido" />
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Quais são os dados de Contato do Responsável (Síndico)</h4>

    <div class="form-group col-md-3">
        <label>Nome do Responsável:</label>
        <input type="text" name="cond_resp_nome" class="form-control" placeholder="Digite o nome completo..." />
    </div>

    <div class="form-group col-md-3">
        <label>Celular:</label>
        <input type="text" name="cond_resp_celular" class="form-control mask_telefone" />
    </div>

    <div class="form-group col-md-3">
        <label>Telefone:</label>
        <input type="text" name="cond_resp_telefone" class="form-control mask_telefone" />
    </div>

    <div class="form-group col-md-3">
        <label>E-mail:</label>
        <input type="email" name="cond_resp_email" class="form-control" placeholder="Digite um E-mail válido" />
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Possiu conta?</h4>

    <div class="form-group col-md-3" id="cont_sim_nao">
        <label>Não</label>
        <input type="radio" name="possui_conta" value="nao" checked>
        <label>Sim</label>
        <input type="radio" name="possui_conta" value="sim">
    </div>

    <div class="clearfix"></div>

    <div id="list_conta">

    </div>

    <div class="clearfix"></div>

    <label>Obs:</label>
    <div class="form-group col-md-12">
        <textarea name="cond_obs" class="form-control" placeholder="Suas observações aqui..." rows="7"></textarea>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <br>
            <br>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
        <div class="form-group col-md-6 text-right">
            <br>
            <br>
            <button type="submit" class="btn btn-info">Cadastrar</button>
        </div>
    </div>
</form>
<script>
    $(".autocomplete").select2({});
    $(".mask_telefone").inputmask("(99)9999-99999");
    $(".mask_celular").inputmask("(99)99999-99999");
    $(".mask_cpf").inputmask("999.999.999-99");
    $(".mask_cnpj").inputmask("999.999.999/0001-99");
    $(".mask_cep").inputmask("99999-999");

    $('.content').on('blur', '.j_cep', function () {

        var cep = this.value.replace(/[^0-9]/, "");

        if (cep.length !== 8) {
            alert("CEP Preenchido incorretamente");
            return false;
        }

        var url = "http://viacep.com.br/ws/" + cep + "/json/";
        $.getJSON(url, function (dadosRetorno) {
            try {
                $('input[name="cond_endereco"]').val(dadosRetorno.logradouro);
                $('input[name="cond_bairro"]').val(dadosRetorno.bairro);
                $('input[name="cond_cidade"]').val(dadosRetorno.localidade);
                $('input[name="cond_uf"]').val(dadosRetorno.uf);
                $('input[name="cond_num"]').focus();
            } catch (ex) {
            }
        });
    });

    $('.content').on('blur', 'input[name="cond_comp"]', function () {
        $('input[name="cond_telefone"]').focus();
    });

    $('#cont_sim_nao input').on('change', function() {
        var simNao = $('input[name=possui_conta]:checked', '#cont_sim_nao').val();

        if(simNao == "sim"){
            $.post("ajax/listContaAjax.php",
                function (data) {
                    $('#list_conta').html(data);
                }, "html");
        }else{
            $('#list_conta').html("");
        }

    });



</script>
<!-- FIM - FormClientes -->