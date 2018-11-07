<?php
require_once('../../_app/Config.inc.php');
require '../../_app/Enuns/TipoImovel.php';
require '../../_app/Enuns/Banco.php';

$Read = new Read;
?>

<!-- INICIO - Form Cobrança -->
<form name="Captadores" class="j_FormCadastro" action="" method="POST">
    <div class="alert-box"></div>
    <input class="noclear" type="hidden" name="action" value="create"/>

    <div id="qual_imov" class="form-group col-md-8">
        <label>Selecione um Imóvel:</label>
        <select name="qual_imov" class="form-control autocomplete">
            <option value="">Selecione...</option>
            <?php
            $Read->FullRead("SELECT * FROM imoveis WHERE imov_tipo <> 'Adm. Condomínio' AND imov_tipo <> 'Adm. Condom';");
            if ($Read->getResult()):
                foreach ($Read->getResult() as $Dados):
                    extract($Dados);
                    echo "<option value='{$imov_id}/I'>{$imov_endereco}, {$imov_num}, {$imov_comp},<br> {$imov_bairro}, {$imov_cidade} - {$imov_uf} - {$imov_cep}</option>";
                endforeach;
            endif;

            $Read->FullRead("SELECT * FROM imoveis INNER JOIN condominios ON imoveis.imov_id_cond = condominios.cond_id");
            foreach ($Read->getResult() as $Dados):
                extract($Dados);
                echo "<option value='{$imov_id}/C'>{$imov_bloco} - {$imov_apto} ({$cond_nome})</option>";
            endforeach;

            ?>
        </select>
    </div>

    <div class="clearfix"></div>

    <div id="lanc_list" class="form-group col-md-12">

    </div>

</form>


    <div id="boleto">

    </div>

<script>

    $(".autocomplete").select2({});
    $('#lanc_list').hide();

    $('#qual_imov').change(function () {

        $('#lanc_list').hide();
        var params = $('select[name="qual_imov"]').val();

        console.log(params);

        if (params !== "") {
            $('#lanc_list').show();

            $.post("ajax/boletoCobrancaAjax.php", {params: params},
                    function (data) {
                        $('#lanc_list').html(data);
             }, "html");

            $.post("ajax/gerarBoletoAjax.php", {params: params},
                    function (data) {
                        $('#boleto').html(data);
             }, "html");

            /*.ajax({
                url: 'ajax/gerarBoletoAjax.php',
                data: {params: params, lanc_id: 10, conta_id: 6},
                type: 'POST',
                dataType: 'html',
                success: function (resposta) {
                    console.log(resposta)
                    $(resposta).replaceAll('#boleto');
                }
            });*/
        }
    });

</script>



