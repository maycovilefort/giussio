<?php
require '../_app/Config.inc.php';
require '../_app/Enuns/TipoLancamento.php';
$Data = filter_input(INPUT_GET, 'Data');

$ArrData = explode(" - ", $Data);

$DataInicial = date("Y-m-d", strtotime(str_replace("/", "-", $ArrData[0])));
$DataFinal = date("Y-m-d", strtotime(str_replace("/", "-", $ArrData[1])));

$Read = new Read;

$Read->FullRead("SELECT lanc_id, lanc_desc, DATE_FORMAT(lanc_data_venc,'%d/%m/%Y') as lanc_data_venc, lanc_valor, lanc_tipo, DATE_FORMAT(lanc_data_pagto,'%d/%m/%Y') as lanc_data_pagto, lanc_id_imov, lanc_id_cond FROM lancamentos WHERE lanc_data_pagto >= '{$DataInicial}' AND lanc_data_pagto <= '{$DataFinal}' ORDER BY lanc_data_pagto ASC");
$saldoAnterior = 0;

if ($Read->getResult()):
    foreach ($Read->getResult() as $Dados):
        extract($Dados);
        if ($lanc_tipo === "Despesa"):
            $saldoAnterior -= $lanc_valor;
        else:
            $saldoAnterior += $lanc_valor;
        endif;
    endforeach;
endif;
?>
<div id="fluxo_caixa">
    <!--Tabela de Clientes -->
    <div class = "box">
        <div class = "box-header">
            <h3 class = "box-title">Extrado de Receitas / Despesas</h3>

            <div class = "box-tools">
                <h5><?= 'Saldo Aterior R$ ' . number_format($saldoAnterior, 2, ',', '.'); ?></h5>
            </div>
        </div>
        <!-- /.box-header -->

        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-striped">
                <tbody>
                    <tr>
                        <th class="text-center hidden">ID</th>
                        <th style="width: 28%">Descrição</th>
                        <th class="text-center" style="width: 12%">Vencimento</th>
                        <th class="text-center" style="width: 12%">Pagto</th>
                        <th class="text-center" style="width: 12%">Despesas</th>
                        <th class="text-center" style="width: 12%">Receitas</th>
                        <th class="text-center" style="width: 12%">Saldo</th>
                    </tr>
                    <?php
                    $Read->FullRead("SELECT lanc_id, lanc_desc, DATE_FORMAT(lanc_data_venc,'%d/%m/%Y') as lanc_data_venc, lanc_valor, lanc_tipo, lanc_data_pagto FROM lancamentos WHERE lanc_data_pagto BETWEEN '{$DataInicial}' AND '{$DataFinal}' ORDER BY lanc_data_pagto ASC");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $Dados):
                            extract($Dados);
                            ?>
                            <tr>
                                <td rel="<?= $lanc_id; ?>" class="text-center hidden"><?= $lanc_id; ?></td>
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
                                        $ReadImov->FullRead("SELECT * FROM imoveis WHERE imov_id = $imovOuCond");

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
                                                    $ReadProp->FullRead("SELECT * FROM proprietarios WHERE prop_id = $idProp");
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
                                <td class="text-center"><?= $lanc_data_venc; ?></td>
                                <td class="text-center"><?= date("d/m/Y", strtotime($lanc_data_pagto)); ?></td>
                                <td class="text-center text-danger text-bold">
                                    <?php
                                    if ($lanc_tipo === "Despesa") {
                                        echo '- R$ ' . number_format($lanc_valor, 2, ',', '.');
                                        $saldoAnterior -= $lanc_valor;
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <td class="text-center text-blue text-bold">
                                    <?php
                                    if ($lanc_tipo === "Receita") {
                                        echo 'R$ ' . number_format($lanc_valor, 2, ',', '.');
                                        $saldoAnterior += $lanc_valor;
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <td class="text-center  text-bold">
                                    <?php
                                    echo 'R$ ' . number_format($saldoAnterior, 2, ',', '.');
                                    ?>
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