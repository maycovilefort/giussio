<?php
require_once('../../_app/Config.inc.php');
$Read = new Read;
?>

<!-- INICIO - Form Clientes -->
<form name="Proprietarios" class="j_FormCadastro" action="" method="POST">
    <div class="alert-box"></div>
    <input class="noclear" type="hidden" name="action" value="create" />

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Quais os dados primários do Proprietário ou Residente?</h4>

    <div class="form-group col-md-3">
        <label>CPF:</label>
        <input type="text" name="prop_cpf" class="form-control mask_cpf" />
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-md-6">
        <label>Nome:</label>
        <input type="text" name="prop_nome" class="form-control" placeholder="Digite o nome completo" />
    </div>

    <div class="form-group col-md-3">
        <label>Sexo:</label>
        <select name="prop_sexo" class="form-control">
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
        </select>
    </div>

    <div class="form-group col-md-3">
        <label>Nascimento:</label>
        <input type="date" name="prop_nasc" class="form-control" />
    </div>

    <div class="form-group col-md-3">
        <label>RG:</label>
        <input type="text" name="prop_rg" class="form-control mask_rg" >
    </div>

    <div class="form-group col-md-3">
        <label>RG Emissor:</label>
        <input type="text" name="prop_emissor" class="form-control" />
    </div>

    <div class="form-group col-md-3">
        <label>RG Expedição:</label>
        <input type="date" name="prop_expedicao" class="form-control mask_data" />
    </div>

    <div class="form-group col-md-3">
        <label>Estado Civil:</label>
        <select name="prop_est_civil" class="form-control">
            <option value="Solteiro">Solteiro</option>
            <option value="Casado">Casado</option>
            <option value="Morando junto">Morando junto</option>
        </select>
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Qual é o Endereço?</h4>

    <div class="form-group col-md-4">
        <label>CEP:</label>
        <input type="text" name="prop_cep" class="form-control j_cep mask_cep" placeholder="Somente números">
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-md-6">
        <label>Endereço:</label>
        <input type="text" name="prop_endereco" class="form-control" readonly />
    </div>

    <div class="form-group col-md-2">
        <label>Numero:</label>
        <input type="text" name="prop_num" class="form-control" />
    </div>

    <div class="form-group col-md-4">
        <label>Complemento:</label>
        <input type="text" name="prop_comp" class="form-control" />
    </div>

    <div class="form-group col-md-5">
        <label>Bairro:</label>
        <input type="text" name="prop_bairro" class="form-control" readonly />
    </div>

    <div class="form-group col-md-5">
        <label>Cidade:</label>
        <input type="text" name="prop_cidade" class="form-control" readonly />
    </div>

    <div class="form-group col-md-2">
        <label>UF:</label>
        <input type="text" name="prop_uf" class="form-control" readonly />
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Quais são os dados de Contato</h4>

    <div class="form-group col-md-3">
        <label>Celular:</label>
        <input type="text" name="prop_celular" class="form-control mask_telefone" />
    </div>

    <div class="form-group col-md-3">
        <label>Telefone:</label>
        <input type="text" name="prop_telefone" class="form-control mask_telefone" />
    </div>

    <div class="form-group col-md-3">
        <label>Comercial:</label>
        <input type="text" name="prop_comercial" class="form-control mask_telefone" />
    </div>

    <div class="form-group col-md-3">
        <label>E-mail:</label>
        <input type="email" name="prop_email" class="form-control" placeholder="Digite um E-mail válido" />
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Pagamento</h4>

    <div class="form-group col-md-4">
        <label>Forma de pagamento:</label>
        <select name="prop_forma_pagto" class="form-control">
            <option value="Dinheiro">Dinheiro</option>
            <option value="Boleto">Boleto</option>
            <option value="Cheque">Cheque</option>
        </select>
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Observações</h4>

    <div class="form-group col-md-12">
        <textarea name="prop_obs" class="form-control" placeholder="Insira suas observações" rows="7"></textarea>
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

//  BUSCA CEP
    $('.content').on('blur', '.j_cep', function () {

        var cep = this.value.replace(/[^0-9]/, "");

        if (cep.length !== 8) {
            alert("CEP Preenchido incorretamente");
            return false;
        }

        var url = "http://viacep.com.br/ws/" + cep + "/json/";
        $.getJSON(url, function (dadosRetorno) {
            try {
                $('input[name="prop_endereco"]').val(dadosRetorno.logradouro);
                $('input[name="prop_bairro"]').val(dadosRetorno.bairro);
                $('input[name="prop_cidade"]').val(dadosRetorno.localidade);
                $('input[name="prop_uf"]').val(dadosRetorno.uf);
                $('input[name="prop_num"]').focus();
            } catch (ex) {
            }
        });

        $('.content').on('blur', 'input[name="prop_comp"]', function () {
            $('input[name="prop_celular"]').focus();
        });
    });
</script>
<!-- FIM - FormClientes -->