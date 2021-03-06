<?php
require_once ('../../_app/Config.inc.php');
$Read = new Read;
?>

<!-- INICIO - Form Clientes -->
<form name="Residentes" class="j_FormCadastro" action="" method="POST">
    <div class="alert-box"></div>
    <input class="noclear" type="hidden" name="action" value="create" />

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Quais os dados primários do Residente?</h4>


    <div class="form-group col-md-3">
        <label>CPF:</label>
        <input type="text" name="resi_cpf" class="form-control mask_cpf" />
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-md-6">
        <label>Nome:</label>
        <input type="text" name="resi_nome" class="form-control" placeholder="Digite o nome completo" />
    </div>

    <div class="form-group col-md-3">
        <label>Sexo:</label>
        <select name="resi_sexo" class="form-control">
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
        </select>
    </div>

    <div class="form-group col-md-3">
        <label>Nascimento:</label>
        <input type="date" name="resi_nasc" class="form-control" />
    </div>

    <div class="form-group col-md-3">
        <label>RG:</label>
        <input type="text" name="resi_rg" class="form-control" />
    </div>

    <div class="form-group col-md-3">
        <label>RG Emissor:</label>
        <input type="text" name="resi_emissor" class="form-control" />
    </div>

    <div class="form-group col-md-3">
        <label>RG Expedição:</label>
        <input type="date" name="resi_expedicao" class="form-control" />
    </div>

    <div class="form-group col-md-3">
        <label>Estado Civil:</label>
        <select name="resi_est_civil" class="form-control">
            <option value="Solteiro">Solteiro</option>
            <option value="Casado">Casado</option>
            <option value="Morando junto">Morando junto</option>
        </select>
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Qual é o Endereço?</h4>

    <div class="form-group col-md-4">
        <label>CEP:</label>
        <input type="text" name="resi_cep" class="form-control j_cep mask_cep" />
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-md-6">
        <label>Endereço:</label>
        <input type="text" name="resi_endereco" class="form-control" readonly />
    </div>

    <div class="form-group col-md-2">
        <label>Numero:</label>
        <input type="text" name="resi_num" class="form-control" />
    </div>

    <div class="form-group col-md-4">
        <label>Complemento:</label>
        <input type="text" name="resi_comp" class="form-control" />
    </div>

    <div class="form-group col-md-5">
        <label>Bairro:</label>
        <input type="text" name="resi_bairro" class="form-control" readonly />
    </div>

    <div class="form-group col-md-5">
        <label>Cidade:</label>
        <input type="text" name="resi_cidade" class="form-control" readonly />
    </div>

    <div class="form-group col-md-2">
        <label>UF:</label>
        <input type="text" name="resi_uf" class="form-control" readonly />
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Quais são os dados de Contato</h4>

    <div class="form-group col-md-4">
        <label>Celular:</label>
        <input type="text" name="resi_celular" class="form-control mask_telefone" />
    </div>

    <div class="form-group col-md-4">
        <label>Telefone:</label>
        <input type="text" name="resi_telefone" class="form-control mask_telefone" />
    </div>

    <div class="form-group col-md-4">
        <label>E-mail:</label>
        <input type="email" name="resi_email" class="form-control" placeholder="Digite um E-mail válido" />
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Pagamento</h4>

    <div class="form-group col-md-4">
        <label>Forma de pagamento:</label>
        <select name="resi_forma_pagto" class="form-control">
            <option value="Dinheiro">Dinheiro</option>
            <option value="Boleto">Boleto</option>
            <option value="Cheque">Cheque</option>
        </select>
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Empresa</h4>

    <div class="form-group col-md-6">
        <label>Nome da empresa:</label>
        <input type="text" name="resi_emp_nome" class="form-control" placeholder="Digite o nome da empresa do residente" />
    </div> 

    <div class="clearfix"></div>

    <div class="form-group col-md-4">
        <label>Profissão:</label>
        <input type="text" name="resi_emp_profissao" class="form-control" placeholder="Profissão do residente" />
    </div>

    <div class="form-group col-md-4">
        <label>Cargo:</label>
        <input type="text" name="resi_emp_cargo" class="form-control" placeholder="Cargo do residente" />
    </div>

    <div class="form-group col-md-4">
        <label>Renda:</label>
        <input type="text" name="resi_emp_renda" class="form-control" placeholder="Valor da renda do residente" />
    </div>

    <div class="form-group col-md-4">
        <label>CEP:</label>
        <input type="text" name="resi_emp_cep" class="form-control j_cep2 mask_cep">
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-md-6">
        <label>Endereço:</label>
        <input type="text" name="resi_emp_endereco" class="form-control" readonly />
    </div>

    <div class="form-group col-md-2">
        <label>Numero:</label>
        <input type="text" name="resi_emp_num" class="form-control" />
    </div>

    <div class="form-group col-md-4">
        <label>Complemento:</label>
        <input type="text" name="resi_emp_comp" class="form-control" />
    </div>

    <div class="form-group col-md-5">
        <label>Bairro:</label>
        <input type="text" name="resi_emp_bairro" class="form-control" readonly />
    </div>

    <div class="form-group col-md-5">
        <label>Cidade:</label>
        <input type="text" name="resi_emp_cidade" class="form-control" readonly />
    </div>

    <div class="form-group col-md-2">
        <label>UF:</label>
        <input type="text" name="resi_emp_uf" class="form-control" readonly />
    </div>

    <div class="form-group col-md-4">
        <label>Comercial:</label>
        <input type="text" name="resi_emp_comercial" class="form-control mask_telefone" />
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Observações</h4>

    <div class="form-group col-md-12">
        <textarea name="resi_obs" class="form-control" placeholder="Insira suas observações" rows="7"></textarea>
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
                $('input[name="resi_endereco"]').val(dadosRetorno.logradouro);
                $('input[name="resi_bairro"]').val(dadosRetorno.bairro);
                $('input[name="resi_cidade"]').val(dadosRetorno.localidade);
                $('input[name="resi_uf"]').val(dadosRetorno.uf);
                $('input[name="resi_num"]').focus();
            } catch (ex) {
            }
        });

        $('.content').on('blur', 'input[name="resi_comp"]', function () {
            $('input[name="resi_celular"]').focus();
        });
    });

    //  BUSCA CEP
    $('.content').on('blur', '.j_cep2', function () {

        var cep = this.value.replace(/[^0-9]/, "");

        if (cep.length !== 8) {
            alert("CEP Preenchido incorretamente");
            return false;
        }

        var url = "http://viacep.com.br/ws/" + cep + "/json/";
        $.getJSON(url, function (dadosRetorno) {
            try {
                $('input[name="resi_emp_endereco"]').val(dadosRetorno.logradouro);
                $('input[name="resi_emp_bairro"]').val(dadosRetorno.bairro);
                $('input[name="resi_emp_cidade"]').val(dadosRetorno.localidade);
                $('input[name="resi_emp_uf"]').val(dadosRetorno.uf);
                $('input[name="resi_emp_num"]').focus();
            } catch (ex) {
            }
        });

        $('.content').on('blur', 'input[name="resi_emp_comp"]', function () {
            $('input[name="resi_emp_comercial"]').focus();
        });
    });
</script>
<!-- FIM - FormClientes -->