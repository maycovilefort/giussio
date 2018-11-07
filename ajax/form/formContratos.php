<?php
require_once ('../../_app/Config.inc.php');
$Read = new Read;
?>

<form name="Contratos" class="j_FormCadastro" action="" method="POST">
    <div class="alert-box"></div>
    <input class="noclear" type="hidden" name="action" value="create" />

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Qual Tipo de Contrato e Imóvel?</h4>

    <div class="form-group col-md-6">
        <label>Tipo:</label>
        <select name="contratos_tipo" class="form-control">
            <option value="">Selecione...</option>
            <option value="Contrato de Aluguel">Contrato de Aluguel</option>
            <option value="Contrato de Venda">Contrato de Venda</option>
            <option value="Contrato de Adm. Condomínio">Contrato de Adm. Condomínio</option>
        </select>
    </div>

    <div class="form-group col-md-6">
        <label>Imóvel</label>
        <select name="contratos_id_imov" class="form-control autocomplete">
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

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Qual Residente?</h4>

    <div class="form-group col-md-6">
        <label>Residente</label>
        <select name="contratos_id_resi" class="form-control autocomplete">
            <option value="">Selecione...</option>
            <?php
            $Read->ExeRead('residentes');

            foreach ($Read->getResult() as $dados):
                extract($dados);
                ?>
                <option value="<?= $resi_id; ?>"><?= $resi_nome; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </div>

    <div class="form-group col-md-6">
        <label>Endereço de Cobrança:</label>
        <select id="enn_cob2" class="form-control">
            <option value="">Selecione...</option>
            <option value="Usar endereço do imóvel">Usar endereço do imóvel</option>
            <option value="Usar endereço do Residente">Usar endereço do Residente</option>
            <option value="Usar outro endereço">Usar outro endereço</option>
        </select>
    </div>

    <div id="end_cob" hidden>
        <div class="form-group col-md-4">
            <label>CEP:</label>
            <input type="text" name="contratos_cep" class="form-control j_cep mask_cep" />
        </div>

        <div class="clearfix"></div>

        <div class="form-group col-md-6">
            <label>Endereço:</label>
            <input type="text" name="contratos_endereco" class="form-control" readonly />
        </div>

        <div class="form-group col-md-2">
            <label>Numero:</label>
            <input type="text" name="contratos_num" class="form-control" />
        </div>

        <div class="form-group col-md-4">
            <label>Complemento:</label>
            <input type="text" name="contratos_comp" class="form-control" />
        </div>

        <div class="form-group col-md-5">
            <label>Bairro:</label>
            <input type="text" name="contratos_bairro" class="form-control" readonly />
        </div>

        <div class="form-group col-md-5">
            <label>Cidade:</label>
            <input type="text" name="contratos_cidade" class="form-control" readonly />
        </div>

        <div class="form-group col-md-2">
            <label>UF:</label>
            <input type="text" name="contratos_uf" class="form-control" readonly />
        </div>
    </div>

    <!-- INICIO - TIPO DE GARANTIA -->
    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Qual a Garatia Utilizada?</h4>

    <div class="form-group col-md-4">
        <label>Garantia:</label>
        <select name="contratos_garantia" class="form-control">
            <option value="">Selecione...</option>
            <option value="Fiador">Fiador</option>
            <option value="Caução">Caução</option>
            <option value="Seguro-Fiança">Seguro-Fiança</option>
            <option value="Título de Capitalização">Titulo de Capitalização</option>
            <option value="Não Possui Garantia">Não Possui Garantia</option>
        </select>
    </div>

    <div class="clearfix"></div>

    <div id="contratos_id_fiad" class="form-group col-md-4">
        <label>Fiador:</label>
        <select name="contratos_id_fiad" class="form-control autocomplete">
            <option value="">Selecione...</option>
            <?php
            $Read->ExeRead('fiadores');

            foreach ($Read->getResult() as $dados):
                extract($dados);
                ?>
                <option value="<?= $fiad_id; ?>"><?= $fiad_nome; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </div>

    <div id="contratos_caucao_tipo" class="form-group col-md-4">
        <label>Tipo:</label>
        <select name="contratos_caucao_tipo" class="form-control">
            <option value="">Selecione...</option>
            <option value="Valor">Valor</option>
            <option value="Veículo">Veículo</option>
            <option value="Carta-Fiança">Carta-Fiança</option>
            <option value="Outros">Outros</option>
        </select>
    </div>

    <div class="clearfix"></div>

    <div id="contratos_seg_data_inicial" class="form-group col-md-4">
        <label>Data Inicial:</label>
        <input type="date" name="contratos_seg_data_inicial" class="form-control" />
    </div>

    <div id="contratos_seg_data_final" class="form-group col-md-4">
        <label>Data Final:</label>;
        <input type="date" name="contratos_seg_data_final" class="form-control" />
    </div>

    <div id="contratos_seg_valor" class="form-group col-md-4">
        <label>Valor:</label>
        <input type="text" name="contratos_seg_valor" class="form-control mask_real" />
    </div>

    <div class="clearfix"></div>

    <div id="contratos_seg_banco" class="form-group col-md-6">
        <label id="lb_seg_ban">Seguradora / Banco</label>
        <input type="text" name="contratos_seg_banco" class="form-control" />
    </div>

    <div id="contratos_apolice" class="form-group col-md-6">
        <label>Apolice:</label>
        <input type="text" name="contratos_apolice" class="form-control" />
    </div>

    <div class="clearfix"></div>

    <div id="contratos_seg_desc" class="form-group col-md-6">
        <label>Descrição:</label>
        <input type="text" name="contratos_seg_desc" class="form-control mask_real" />
    </div>

    <div id="contratos_seg_Identificador" class="form-group col-md-6">
        <label>Identificador:</label>
        <input type="text" name="contratos_seg_Identificador" class="form-control mask_real" />
    </div>

    <div id="contratos_seg_obs" class="form-group col-md-12">
        <label>Obs:</label>
        <textarea name="contratos_seg_obs" class="form-control" placeholder="Insira suas observações" rows="7"></textarea>
    </div>
    <!-- FIM - TIPO DE GARANTIA -->

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

    $('#contratos_id_fiad').hide();
    $('#contratos_caucao_tipo').hide();
    $('#contratos_seg_data_inicial').hide();
    $('#contratos_seg_data_final').hide();
    $('#contratos_seg_banco').hide();
    $('#contratos_apolice').hide();
    $('#contratos_seg_valor').hide();
    $('#contratos_seg_desc').hide();
    $('#contratos_seg_Identificador').hide();
    $('#contratos_seg_obs').hide();

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
                $('input[name="contratos_endereco"]').val(dadosRetorno.logradouro);
                $('input[name="contratos_bairro"]').val(dadosRetorno.bairro);
                $('input[name="contratos_cidade"]').val(dadosRetorno.localidade);
                $('input[name="contratos_uf"]').val(dadosRetorno.uf);
                $('input[name="contratos_num"]').focus();
            } catch (ex) {
            }
        });
    });

//  HIDDEN - TIPO DE CONTRATO
    $('select[name="contratos_tipo"]').change(function () {

        var contratos_tipo = $('select[name="contratos_tipo"]').val();

        if (contratos_tipo === "Contrato de Aluguel") {
            $("#col-cond").hide();
            $("#col-prop").hide();
        } else {
            $("#col-cond").show();
            $("#col-prop").show();
        }
    });

    //  HIDDEN - TIPO DE GARATIA
    $('select[name="contratos_garantia"]').change(function () {
        var contratos_garantia = $('select[name="contratos_garantia"]').val();

        $('#contratos_id_fiad').hide();
        $('#contratos_caucao_tipo').hide();
        $('#contratos_seg_data_inicial').hide();
        $('#contratos_seg_data_final').hide();
        $('#contratos_seg_banco').hide();
        $('#contratos_apolice').hide();
        $('#contratos_seg_valor').hide();
        $('#contratos_seg_desc').hide();
        $('#contratos_seg_Identificador').hide();
        $('#contratos_seg_obs').hide();

        if (contratos_garantia === "Fiador") {
            $('#contratos_id_fiad').show();
            $('#contratos_seg_obs').show();

        } else if (contratos_garantia === "Caução") {
            $('#contratos_caucao_tipo').show();

        } else if (contratos_garantia === "Seguro-Fiança" | contratos_garantia === "Título de Capitalização") {
            if (contratos_garantia === "Seguro-Fiança") {
                $('#lb_seg_ban').html('Seguradora');
            } else {
                $('#lb_seg_ban').html('Banco');
            }
            $('#contratos_seg_data_inicial').show();
            $('#contratos_seg_data_final').show();
            $('#contratos_seg_banco').show();
            $('#contratos_apolice').show();
            $('#contratos_seg_valor').show();
            $('#contratos_seg_obs').show();

        } else {
            $('#contratos_id_fiad').hide();
            $('#contratos_caucao_tipo').hide();
            $('#contratos_seg_data_inicial').hide();
            $('#contratos_seg_data_final').hide();
            $('#contratos_seg_banco').hide();
            $('#contratos_apolice').hide();
            $('#contratos_seg_valor').hide();
            $('#contratos_seg_desc').hide();
            $('#contratos_seg_Identificador').hide();
            $('#contratos_seg_obs').hide();
        }
    });

//  HIDDEN - TIPO DE CAUÇÃO
    $('select[name="contratos_caucao_tipo"]').change(function () {
        var contratos_caucao_tipo = $('select[name="contratos_caucao_tipo"]').val();

        $('#contratos_id_fiad').hide();
        $('#contratos_caucao_tipo').hide();
        $('#contratos_seg_data_inicial').hide();
        $('#contratos_seg_data_final').hide();
        $('#contratos_seg_banco').hide();
        $('#contratos_apolice').hide();
        $('#contratos_seg_valor').hide();
        $('#contratos_seg_desc').hide();
        $('#contratos_seg_Identificador').hide();
        $('#contratos_seg_obs').hide();

        if (contratos_caucao_tipo === "Valor" | contratos_caucao_tipo === "Veículo") {
            $('#contratos_caucao_tipo').show();
            $('#contratos_seg_data_inicial').show();
            $('#contratos_seg_data_final').show();
            $('#contratos_seg_valor').show();
            $('#contratos_seg_obs').show();

        } else {
            $('#contratos_caucao_tipo').show();
            $('#contratos_seg_data_inicial').show();
            $('#contratos_seg_data_final').show();
            $('#contratos_seg_valor').show();
            $('#contratos_seg_desc').show();
            $('#contratos_seg_Identificador').show();
            $('#contratos_seg_obs').show();
        }
    });
</script>