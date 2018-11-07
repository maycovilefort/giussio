<?php
require '../_app/Config.inc.php';
require '../_app/Enuns/TipoLancamento.php';
$Data = filter_input(INPUT_GET, 'Data');

$ArrData = explode(" - ", $Data);

$DataInicial = date("Y-m-d", strtotime(str_replace("/", "-", $ArrData[0])));
$DataFinal = date("Y-m-d", strtotime(str_replace("/", "-", $ArrData[1])));

$Read = new Read;
?>
<div id="result_cobranca">
    <!--Tabela de Clientes -->
    <div class = "box">
        <div class = "box-header">
            <h3 class = "box-title">Extrado de Cobranças</h3>
            <!-- /.box-header -->

            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <tbody>
                    <tr>
                        <th class="text-center hidden">ID</th>
                        <th style="width: 26%">Num. Boleto</th>
                        <th style="width: 18%">Descrição</th>
                        <th class="text-center" style="width: 14%">Vencimento</th>
                        <th class="text-center" style="width: 14%">Pagto</th>
                        <th class="text-center" style="width: 14%">Valor</th>
                        <th class="text-center" style="width: 14%">Ação</th>

                    </tr>
                    <?php
                    $Read->FullRead("SELECT lanc_id, lanc_desc, lanc_boleto_num, lanc_data_venc, lanc_valor, lanc_tipo, DATE_FORMAT(lanc_data_pagto,'%d/%m/%Y') as lanc_data_pagto, lanc_id_imov, lanc_id_cond FROM lancamentos WHERE lanc_boleto_num <> '' AND lanc_data_venc BETWEEN '{$DataInicial}' AND '{$DataFinal}' AND (lanc_data_pagto IS NULL OR lanc_data_pagto = '') ORDER BY lanc_data_venc ASC");

                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $Dados):
                            extract($Dados);
                            ?>
                            <tr>
                                <td rel="<?= $lanc_id; ?>" class="text-center hidden"><?= $lanc_id; ?></td>
                                <td><?= $lanc_boleto_num; ?></td>
                                <td>
                                    <?php

                                    $imovOuCond = "";
                                    if ($lanc_tipo === TipoLancamento::DESPESA) {
                                        echo $lanc_desc;
                                    } else {

                                        if ($lanc_id_cond !== "" && $lanc_id_cond !== NULL) {
                                            $imovOuCond = $lanc_id_cond;

                                        } else {
                                            $imovOuCond = $lanc_id_imov;
                                        }

                                        $ReadImov = new Read;
                                        $ReadImov->FullRead("SELECT * FROM imoveis WHERE imov_id = ${imovOuCond}");

                                        if ($ReadImov->getResult()) {

                                            foreach ($ReadImov->getResult() as $DadosImov):
                                                extract($DadosImov);

                                                if ($imov_tipo === "Adm. Condom" || $imov_tipo === "Adm. Condomínio") {

                                                    $ReadCond = new Read;
                                                    $ReadCond->FullRead("SELECT * FROM condominios WHERE cond_id = ${imov_id_cond}");
                                                    if ($ReadCond->getResult()) {

                                                        foreach ($ReadCond->getResult() as $DadosCond):
                                                            extract($DadosCond);
                                                            echo $DadosCond['cond_resp_nome'];

                                                        endforeach;
                                                    }
                                                } else {

                                                    $idProp = $DadosImov['imov_id_prop'];

                                                    $ReadProp = new Read;
                                                    $ReadProp->FullRead("SELECT * FROM proprietarios WHERE prop_id = ${idProp}");
                                                    if ($ReadProp->getResult()) {

                                                        foreach ($ReadProp->getResult() as $DadosProp):
                                                            extract($DadosProp);
                                                            echo $DadosProp['prop_nome'];
                                                        endforeach;
                                                    }
                                                }

                                            endforeach;
                                        }
                                    }
                                    ?>
                                </td>
                                <td class="text-center"><?= date("d/m/Y", strtotime($lanc_data_venc));; ?></td>
                                <td class="text-center">
                                <?php
                                    if ($lanc_data_pagto === NUll) {
                                        echo 'Em Aberto';
                                    } else {
                                        echo 'Pago';
                                    }
                                    ?>
                                </td>
                                <td class="text-center text-blue text-bold">
                                    <?= 'R$ ' . number_format($lanc_valor, 2, ',', '.'); ?>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-default btn-xs center"><span class="fa fa-edit"></span></button>
                                    <button id="lancamentos" rel="<?= $lanc_id ?>" action="Update" class="btn btn-default btn-xs center j_baixar"><span class="fa fa-check"></span></button>
                                    <button id="lancamentos" rel="<?= $lanc_id ?>" action="Delete" class="btn btn-default btn-xs center j_del"><span class="fa fa-close"></span></button>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>