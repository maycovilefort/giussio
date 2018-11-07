<?php
require_once('../../_app/Config.inc.php');
$Read = new Read;
?>

<!-- INICIO - Form Clientes -->
<form name="Captadores" class="j_FormCadastro" action="" method="POST">
    <div class="alert-box"></div>
    <input class="noclear" type="hidden" name="action" value="create" />

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Quais os dados primários do Proprietário ou Residente?</h4>

    <div class="form-group col-md-3">
        <label>CPF:</label>
        <input type="text" name="capt_cpf" class="form-control mask_cpf" />
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-md-6">
        <label>Nome:</label>
        <input type="text" name="capt_nome" class="form-control" placeholder="Digite o nome completo..." />
    </div>

    <div class="form-group col-md-3">
        <label>Sexo:</label>
        <select name="capt_sexo" class="form-control">
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
        </select>
    </div>

    <div class="form-group col-md-3">
        <label>Nascimento:</label>
        <input type="date" name="capt_nasc" class="form-control" />
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Qual é o Endereço?</h4>

    <div class="form-group col-md-4">
        <label>CEP:</label>
        <input type="text" name="capt_cep" class="form-control j_cep mask_cep" />
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-md-6">
        <label>Endereço:</label>
        <input type="text" name="capt_endereco" class="form-control" readonly />
    </div>

    <div class="form-group col-md-2">
        <label>Numero:</label>
        <input type="text" name="capt_num" class="form-control" />
    </div>

    <div class="form-group col-md-4">
        <label>Complemento:</label>
        <input type="text" name="capt_comp" class="form-control" />
    </div>

    <div class="form-group col-md-5">
        <label>Bairro:</label>
        <input type="text" name="capt_bairro" class="form-control" readonly />
    </div>

    <div class="form-group col-md-5">
        <label>Cidade:</label>
        <input type="text" name="capt_cidade" class="form-control" readonly />
    </div>

    <div class="form-group col-md-2">
        <label>UF:</label>
        <input type="text" name="capt_uf" class="form-control" readonly />
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Quais são os dados de Contato</h4>

    <div class="form-group col-md-3">
        <label>Celular:</label>
        <input type="text" name="capt_celular" class="form-control mask_telefone" />
    </div>

    <div class="form-group col-md-3">
        <label>Telefone:</label>
        <input type="text" name="capt_telefone" class="form-control mask_telefone" />
    </div>

    <div class="form-group col-md-3">
        <label>E-mail:</label>
        <input type="text" name="capt_email" class="form-control" placeholder="Digite um E-mail válido" />
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Observações</h4>

    <div class="form-group col-md-12">
        <textarea name="capt_obs" class="form-control" placeholder="Suas observações aqui..." rows="7"></textarea>
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
                $('input[name="capt_endereco"]').val(dadosRetorno.logradouro);
                $('input[name="capt_bairro"]').val(dadosRetorno.bairro);
                $('input[name="capt_cidade"]').val(dadosRetorno.localidade);
                $('input[name="capt_uf"]').val(dadosRetorno.uf);
                $('input[name="capt_num"]').focus();
            } catch (ex) {
            }
        });

        $('.content').on('blur', 'input[name="capt_comp"]', function () {
            $('input[name="capt_celular"]').focus();
        });
    });
</script>
<!-- FIM - FormClientes -->