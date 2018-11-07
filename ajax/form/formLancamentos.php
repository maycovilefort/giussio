<?php
require_once('../../_app/Config.inc.php');
$Read = new Read;
?>

<!-- INICIO - Form Lancamentos -->
<form name="Lancamentos" class="j_FormCadastro" action="" method="POST">
    <div class="alert-box"></div>
    <input class="noclear" type="hidden" name="action" value="create"/>

    <div id="qual_imov" class="form-group col-md-3">
        <label>Qual tipo de Imóvel?</label>
        <select name="qual_imov" class="form-control">
            <option value="">Selecionar...</option>
            <option value="Condominio">Condomínio</option>
            <option value="Imovel">Imóvel</option>
        </select>
    </div>

    <div id="lanc_id_imov" class="form-group col-md-6">
        <label>Imóvel</label>
        <select name="lanc_id_imov" class="form-control autocomplete">
            <option value="">Selecione...</option>
            <?php
            $Read->ExeRead('imoveis');

            foreach ($Read->getResult() as $dados):
                extract($dados);
                ?>
                <option value="<?= $imov_id; ?>"><?= "{$imov_endereco}, {$imov_num}, {$imov_comp},<br> {$imov_bairro}, {$imov_cidade} - {$imov_uf} - {$imov_cep}"; ?></option>>
                <?php
            endforeach;
            ?>
        </select>
    </div>

    <div id="lanc_id_cond" class="form-group col-md-6">
        <label>Condomínios</label>
        <select name="lanc_id_cond" class="form-control autocomplete">
            <option value="">Selecione...</option>
            <?php
            $Read->FullRead("SELECT * FROM imoveis INNER JOIN condominios ON imoveis.imov_id_cond = condominios.cond_id");  

            foreach ($Read->getResult() as $dados):
                extract($dados);
                ?>
                <option value="<?= $imov_id; ?>"><?= "{$imov_bloco} - {$imov_apto} ({$cond_nome})" ?></option>>
                <?php
            endforeach;
            ?>
        </select>
    </div>

    <input type="hidden" name="lanc_tipo"  value="Despesa"/>

    <div class="clearfix"></div>

    <div class="form-group col-md-3">
        <label>Data de Lançamento:</label>
        <input type="date" name="lanc_data_lanc" class="form-control" readonly/>
    </div>

    <div class="form-group col-md-9">
        <label>Descrição:</label>
        <input type="text" name="lanc_desc" class="form-control"/>
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-md-3">
        <label>Data de vencimento:</label>
        <input type="date" name="lanc_data_venc" class="form-control"/>
    </div>

    <div class="form-group col-md-3">
        <label>Valor:</label>
        <input type="text" name="lanc_valor" class="form-control"/>
    </div>

    <div class="clearfix"></div>

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
    </div
</form>
<!-- FIM - Form Lancamentos -->

<script src="js/functions.js"></script>

<script>

    $('input[name="lanc_data_lanc"]').val(getDataAtual());
    $('input[name="lanc_data_venc"]').val(getDataAtual(5));

    $(".autocomplete").select2({});
    $(".mask_telefone").inputmask("(99)9999-99999");
    $(".mask_celular").inputmask("(99)99999-99999");
    $(".mask_cpf").inputmask("999.999.999-99");
    $(".mask_cnpj").inputmask("999.999.999/0001-99");
    $(".mask_cep").inputmask("99999-999");

    $('#lanc_id_imov').hide();
    $('#lanc_id_cond').hide();

//  HIDDEN - TIPO DE LANÇAMENTO
    $('#qual_imov').change(function () {

        $('#lanc_id_imov').hide();
        $('#lanc_id_cond').hide();
        var qual_imov = $('select[name="qual_imov"]').val();
        console.log(qual_imov);

        if (qual_imov === "Condominio") {
            $("#lanc_id_cond").show();
        } else if (qual_imov === "Imovel") {
            $('#lanc_id_imov').show();
        } else {
            $('#lanc_id_imov').hide();
            $('#lanc_id_cond').hide();
        }
    });
</script>