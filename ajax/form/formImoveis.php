<?php
require_once('../../_app/Config.inc.php');
$Read = new Read;
?>

<!-- INICIO - Form Clientes -->
<form name="Imoveis" class="j_FormCadastro" action="" method="POST">
    <div class="alert-box"></div>
    <input class="noclear" type="hidden" name="action" value="create" />

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Dados do Imóvel</h4>

    <div id="imov_tipo" class="form-group col-md-3">
        <label>Tipo:</label>
        <select name="imov_tipo" class="form-control j_imov_tipo">
            <option value="">Selecione...</option>
            <option value="Adm. Condomínio">Adm. Condomínio</option>
            <option value="Aluguel">Aluguel</option>
            <option value="Aluguel/Venda">Aluguel/Venda</option>
            <option value="Venda">Venda</option>
        </select>
    </div>

    <div class="clearfix"></div>

    <div id="imov_id_cond" class="form-group col-md-3">
        <label>Condomínio:</label>
        <select name="imov_id_cond" class="form-control autocomplete">
            <option value="">Selecione...</option>
            <?php
            $Read->ExeRead('condominios');

            foreach ($Read->getResult() as $dados):
                extract($dados);
                ?>
                <option value="<?= $cond_id; ?>"><?= $cond_nome; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </div>

    <div class="clearfix"></div>

    <div id="imov_val_aluguel" class="form-group col-md-3">
        <label>Valor Aluguel R$:</label>
        <input type="text" name="imov_val_aluguel" class="form-control" />
    </div>

    <div id="imov_val_taxa" class="form-group col-md-3">
        <label id="label_taxa">Taxa de Adm:</label>
        <input type="text" name="imov_val_taxa" class="form-control" />
    </div>

    <div id="checkbox" class="form-group col-md-3">
        <div class="checkbox form-group">
            <label>
                <input type="checkbox"> Não usar percentual.
            </label>
        </div>
    </div>

    <div id="imov_val_venda" class="form-group col-md-3">
        <label>Valor Venda R$:</label>
        <input type="text" name="imov_val_venda" class="form-control" />
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Endereço</h4>

    <div id="imov_cep" class="form-group col-md-3">
        <label>CEP:</label>
        <input type="text" name="imov_cep" class="form-control j_cep mask_cep" />
    </div>

    <div class="clearfix"></div>

    <div id="imov_endereco" class="form-group col-md-6">
        <label>Endereço:</label>
        <input type="text" name="imov_endereco" class="form-control" readonly />
    </div>

    <div  id="imov_num" class="form-group col-md-2">
        <label>Numero:</label>
        <input type="text" name="imov_num" class="form-control" />
    </div>

    <div id="imov_comp" class="form-group col-md-4">
        <label>Complemento:</label>
        <input type="text" name="imov_comp" class="form-control" />
    </div>

    <div id="imov_bairro" class="form-group col-md-5">
        <label>Bairro:</label>
        <input type="text" name="imov_bairro" class="form-control" readonly />
    </div>

    <div id="imov_cidade" class="form-group col-md-5">
        <label>Cidade:</label>
        <input type="text" name="imov_cidade" class="form-control" readonly />
    </div>

    <div id="imov_uf" class="form-group col-md-2">
        <label>UF:</label>
        <input type="text" name="imov_uf" class="form-control" readonly />
    </div>

    <div class="clearfix"></div>

    <div id="imov_bloco" class="form-group col-md-4">
        <label>Bloco:</label>
        <input type="text" name="imov_bloco" class="form-control"  />
    </div>

    <div id="imov_apto" class="form-group col-md-4">
        <label>Apartamento:</label>
        <input type="text" name="imov_apto" class="form-control"  />
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Proprietário e Beneficiário</h4>

    <div id="imov_id_prop" class="form-group col-md-6">
        <label>Proprietário:</label>
        <select name="imov_id_prop" class="form-control autocomplete">
            <option value="">Selecione...</option>
            <?php
            $Read->ExeRead('proprietarios');

            foreach ($Read->getResult() as $dados):
                extract($dados);
                ?>
                <option value="<?= $prop_id; ?>"><?= $prop_nome; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </div>

    <div id="imov_id_bene" class="form-group col-md-6">
        <label>Beneficiário:</label>
        <select name="imov_id_bene" class="form-control autocomplete">
            <option value="">Selecione...</option>
            <?php
            $Read->ExeRead('proprietarios');

            foreach ($Read->getResult() as $dados):
                extract($dados);
                ?>
                <option value="<?= $prop_id; ?>"><?= $prop_nome; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Repasse</h4>

    <div id="imov_id_cont" class="form-group col-md-6">
        <label>Conta Bancária:</label>
        <?php $Read->FullRead("SELECT * FROM contas") ?>
        <select name="imov_id_cont" class="form-control autocomplete">
            <option value="">Selecione...</option>
            <?php
            foreach ($Read->getResult() as $dados):
                extract($dados);
                ?>
                <option value="<?= $cont_id; ?>">
                    <?=
                    "{$cont_banco} | "
                    . "<b>Ag:</b> {$cont_agencia} - <b>Conta:</b> {$cont_conta} | "
                    . "<b>Titular:</b> {$cont_titular} - <b>CPF:</b> {$cont_cpf}";
                    ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Documentos do Imóvel</h4>

    <div id="imov_cartorio" class="form-group col-md-6">
        <label>Cartório:</label>
        <input type="text" name="imov_cartorio" class="form-control"  />
    </div>

    <div id="imov_matricula" class="form-group col-md-6">
        <label>Matricula:</label>
        <input type="text" name="imov_matricula" class="form-control"  />
    </div>

    <div id="imov_obs" class="form-group col-md-12">
        <textarea name="imov_obs" class="form-control" placeholder="Insira suas observações" rows="7"></textarea>
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

//  Busca CEP
    $('.content').on('blur', '.j_cep', function () {

        var cep = this.value.replace(/[^0-9]/, "");
        if (cep.length !== 8) {
            alert("CEP Preenchido incorretamente");
            return false;
        }

        var url = "http://viacep.com.br/ws/" + cep + "/json/";
        $.getJSON(url, function (dadosRetorno) {
            try {
                $('input[name="imov_endereco"]').val(dadosRetorno.logradouro);
                $('input[name="imov_bairro"]').val(dadosRetorno.bairro);
                $('input[name="imov_cidade"]').val(dadosRetorno.localidade);
                $('input[name="imov_uf"]').val(dadosRetorno.uf);
                $('input[name="imov_num"]').focus();
            } catch (ex) {
            }
        });
    });

//  Filtra os Campos pelo tipo de Contrato -> $('select[name="imov_tipo"]')
    $('#imov_id_cond').hide();
    $('#imov_val_aluguel').hide();
    $('#imov_val_taxa').hide();
    $('#checkbox').hide();
    $('#imov_val_venda').hide();
    $('#imov_cep').hide();
    $('#imov_endereco').hide();
    $('#imov_num').hide();
    $('#imov_comp').hide();
    $('#imov_bairro').hide();
    $('#imov_cidade').hide();
    $('#imov_uf').hide();
    $('#imov_bloco').hide();
    $('#imov_apto').hide();
    $('#imov_id_prop').hide();
    $('#imov_id_bene').hide();
    $('#imov_id_cont').hide();
    $('#imov_cartorio').hide();
    $('#imov_matricula').hide();
    $('#imov_obs').hide();

    $('select[name="imov_tipo"]').change(function () {
        var Tipo = $('select[name="imov_tipo"]').val();

        $('#imov_id_cond').hide();
        $('#imov_val_aluguel').hide();
        $('#imov_val_taxa').hide();
        $('#checkbox').hide();
        $('#imov_val_venda').hide();
        $('#imov_cep').hide();
        $('#imov_endereco').hide();
        $('#imov_num').hide();
        $('#imov_comp').hide();
        $('#imov_bairro').hide();
        $('#imov_cidade').hide();
        $('#imov_uf').hide();
        $('#imov_bloco').hide();
        $('#imov_apto').hide();
        $('#imov_id_prop').hide();
        $('#imov_id_bene').hide();
        $('#imov_id_cont').hide();
        $('#imov_cartorio').hide();
        $('#imov_matricula').hide();
        $('#imov_obs').hide();

        if (Tipo === "Adm. Condom" || Tipo === "Adm. Condomínio") {
            $('#imov_id_cond').show();
            $('#imov_bloco').show();
            $('#imov_apto').show();
        } else if (Tipo === "Aluguel") {
            $('#imov_val_aluguel').show();
            $('#imov_val_taxa').show();
            $('#checkbox').show();
            $('#imov_cep').show();
            $('#imov_endereco').show();
            $('#imov_num').show();
            $('#imov_comp').show();
            $('#imov_bairro').show();
            $('#imov_cidade').show();
            $('#imov_uf').show();
            $('#imov_id_prop').show();
            $('#imov_id_bene').show();
            $('#imov_id_cont').show();
            $('#imov_cartorio').show();
            $('#imov_matricula').show();
            $('#imov_obs').show();
        } else if (Tipo === "Aluguel/Venda") {
            $('#imov_val_aluguel').show();
            $('#imov_val_taxa').show();
            $('#checkbox').show();
            $('#imov_val_venda').show();
            $('#imov_cep').show();
            $('#imov_endereco').show();
            $('#imov_num').show();
            $('#imov_comp').show();
            $('#imov_bairro').show();
            $('#imov_cidade').show();
            $('#imov_uf').show();
            $('#imov_id_prop').show();
            $('#imov_id_bene').show();
            $('#imov_id_cont').show();
            $('#imov_cartorio').show();
            $('#imov_matricula').show();
            $('#imov_obs').show();
        } else if (Tipo === "Venda") {
            $('#imov_val_taxa').show();
            $('#checkbox').show();
            $('#imov_val_venda').show();
            $('#imov_cep').show();
            $('#imov_endereco').show();
            $('#imov_num').show();
            $('#imov_comp').show();
            $('#imov_bairro').show();
            $('#imov_cidade').show();
            $('#imov_uf').show();
            $('#imov_id_prop').show();
            $('#imov_id_bene').show();
            $('#imov_id_cont').show();
            $('#imov_cartorio').show();
            $('#imov_matricula').show();
            $('#imov_obs').show();
        } else {
            console.log("Deu Ruim!");
        }
    });
</script>
<!-- FIM - FormClientes -->