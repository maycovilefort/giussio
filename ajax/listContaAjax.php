<?php
require_once ('../_app/Config.inc.php');
$Read = new Read;
?>

<div id="conta" class="form-group col-md-6">
        <label>Conta Bancaria:</label>
        <select name="cont_id" class="form-control autocomplete">
            <option value="">Selecione...</option>
            <?php
            $Read->FullRead("SELECT * FROM contas");

            if ($Read->getResult()):
                foreach ($Read->getResult() as $Dados):
                    extract($Dados);
                    ?>
                    <option value="<?= $cont_id; ?>">
                        <?=
                        "{$cont_banco} | "
                        . "<b>Ag:</b> {$cont_agencia} - <b>Conta:</b> {$cont_conta} | "
                        . "<b>Titular:</b> {$cont_titular} - <b>CPF:</b> {$cont_cpf}";
                        ?></option>
                    <?php
                endforeach;
            endif;
            ?>
    </select>
</div>
