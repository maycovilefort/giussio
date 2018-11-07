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

    <div class="form-group col-md-3">
        <label>Tipo:</label>
        <select name="imov_tipo" class="form-control j_imov_tipo">
            <option value="Aluguel">Aluguel</option>
            <option value="Aluguel/Venda">Aluguel/Venda</option>
            <option value="Adm. Condomínio">Adm. Condomínio</option>
            <option value="Venda">Venda</option>
        </select>
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-md-3">
        <label>Valor Aluguel R$:</label>
        <input type="text" name="imov_val_aluguel" class="form-control" />
    </div>

    <div class="form-group col-md-3">
        <label>Tipo taxa:</label>
        <select name="imov_tipo_taxa" class="form-control">
            <option value="Fixa">Fixa</option>
            <option value="Porcentagem">Porcentagem</option>
        </select>
    </div>

    <div class="form-group col-md-3">
        <label>Valor Taxa R$:</label>
        <input type="text" name="imov_val_taxa" class="form-control" />
    </div>

    <div class="form-group col-md-3">
        <label>Valor Venda R$:</label>
        <input type="text" name="imov_val_venda" class="form-control" />
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-md-3">
        <label>CEP:</label>
        <input type="text" name="imov_cep" class="form-control j_cep mask_cep" />
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-md-6">
        <label>Endereço:</label>
        <input type="text" name="imov_endereco" class="form-control" readonly />
    </div>

    <div class="form-group col-md-2">
        <label>Numero:</label>
        <input type="text" name="imov_num" class="form-control" />
    </div>

    <div class="form-group col-md-4">
        <label>Complemento:</label>
        <input type="text" name="imov_comp" class="form-control" />
    </div>

    <div class="form-group col-md-5">
        <label>Bairro:</label>
        <input type="text" name="imov_bairro" class="form-control" readonly />
    </div>

    <div class="form-group col-md-5">
        <label>Cidade:</label>
        <input type="text" name="imov_cidade" class="form-control" readonly />
    </div>

    <div class="form-group col-md-2">
        <label>UF:</label>
        <input type="text" name="imov_uf" class="form-control" readonly />
    </div>

    <div class="clearfix"></div>

    <div class="form-group col-md-4">
        <label>Bloco:</label>
        <input type="text" name="imov_bloco" class="form-control"  />
    </div>

    <div class="form-group col-md-4">
        <label>Apartamento:</label>
        <input type="text" name="imov_apto" class="form-control"  />
    </div>

    <div class="form-group col-md-4">
        <label>Status:</label>
        <select name="imov_status" class="form-control">
            <option value="Disponível">Disponível</option>
            <option value="Indisponivel">Indisponível</option>
        </select>
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Documentos do Imóvel</h4>

    <div class="form-group col-md-6">
        <label>Cartório:</label>
        <input type="text" name="imov_cartorio" class="form-control"  />
    </div>

    <div class="form-group col-md-6">
        <label>Matricula:</label>
        <input type="text" name="imov_matricula" class="form-control"  />
    </div>

    <div class="form-group col-md-12">
        <textarea name="imov_obs" class="form-control" placeholder="Insira suas observações" rows="7"></textarea>
    </div>

    <div class="clearfix"></div>
    <h4 class="form-control label-info text-uppercase" style="color: #fff;">Relacionamentos do Imóvel -- Selects para serem carregado do BD</h4>

    <div class="form-group col-md-3">
        <label>Captador:</label>
        <select name="imov_id_capt" class="form-control autocomplete">
            <option value="">Selecione...</option>
            <?php
            $Read->ExeRead('captadores');

            foreach ($Read->getResult() as $dados):
                extract($dados);
                ?>
                <option value="<?= $capt_id; ?>"><?= $capt_nome; ?></option>
                <?php
            endforeach;
            ?>
        </select>
    </div>

    <div class="form-group col-md-3">
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

    <div class="form-group col-md-3">
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

    <div class="form-group col-md-3">
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
                $('input[name="imov_endereco"]').val(dadosRetorno.logradouro);
                $('input[name="imov_bairro"]').val(dadosRetorno.bairro);
                $('input[name="imov_cidade"]').val(dadosRetorno.localidade);
                $('input[name="imov_uf"]').val(dadosRetorno.uf);
                $('input[name="imov_num"]').focus();
            } catch (ex) {
            }
        });
    });
</script>
<!-- FIM - FormClientes -->