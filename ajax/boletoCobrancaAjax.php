<?php
require '../_app/Config.inc.php';
require '../_app/Enuns/TipoLancamento.php';

$Read = new Read;
$params = explode("/", $_POST['params']);//TODO: trocar parametros
$imov_id = $params[0];
$IouC = $params[1];

if($IouC === "I"){
    $IouC = "lanc_id_imov";
}else {
    $IouC = "lanc_id_cond";
}


$saldoBoleto = 0;
?>

<div class="box-body table-responsive no-padding" id="list">

    <table class="table table-hover table-striped">
        <tbody>
        <tr>
            <th class="text-center hidden">ID</th>
            <th style="width: 28%">Descrição</th>
            <th class="text-center" style="width: 12%">Vencimento</th>
            <th class="text-center" style="width: 12%">Despesas</th>
            <th class="text-center" style="width: 12%">SubTotal</th>
        </tr>
        <?php

        //TODO: verificar com o Mayco quais dados apresentar na lista e argumentos AND lanc_data_pagto = '' AND lanc_boleto_num = ''
        $Read->FullRead("SELECT lanc_id, lanc_desc, DATE_FORMAT(lanc_data_venc,'%d/%m/%Y') as lanc_data_venc, lanc_valor, lanc_tipo, DATE_FORMAT(lanc_data_pagto,'%d/%m/%Y') as lanc_data_pagto FROM lancamentos WHERE {$IouC} = {$imov_id} AND lanc_tipo = 'Despesa' ORDER BY lanc_data_venc ASC");

        if ($Read->getResult()):
        foreach ($Read->getResult() as $Dados):
        extract($Dados);
        ?>
        <tr>
            <td rel="<?= $lanc_id; ?>" class="text-center hidden"><?= $lanc_id; ?></td>
            <td><?= $lanc_desc; ?></td>
            <td class="text-center"><?= $lanc_data_venc; ?></td>
            <td class="text-center text-danger text-bold">
                <?php
                if ($lanc_tipo === TipoLancamento::DESPESA) {
                    echo '- R$ ' . number_format($lanc_valor, 2, ',', '.');
                    $saldoBoleto += $lanc_valor;
                } else {
                    echo '-';
                }
                ?>
            </td>
            <td class="text-center text-blue text-bold"> <?= 'R$ ' . number_format($saldoBoleto, 2, ',', '.'); ?>  </td>
            <?php
            endforeach;

            else:
                echo "<td>Nenhum lançamento para este imóvel...</td>";
            endif;
            ?>
        </tr>

        </tbody>
    </table>

</div>