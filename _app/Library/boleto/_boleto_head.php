<style>
    * {
        font-family: Arial;
        font-size: 12px;
        margin: 0;
        padding: 0;
    }
    #head {
        font-family: Arial;
    }
    #logo{
        width: 100px;
    }


</style>

<?php
//require '../../../_app/Enuns/TipoLancamento.php';

$Read = new Read;

$IouC = $dadosboleto["nome_coluna"];
$imov_id =  $dadosboleto["imov_id"];
$saldoBoleto = 0;

?>
<div id="head" style="width:666px" ;>

    <h2 style="text-align: center" ;>Despesas</h2>

    <table width=666 cellspacing=1 cellpadding=1 border=0>

        <tbody>
        <tr>
            <td style="font-weight: bold; text-align: left">Despesas</td>
            <td style="font-weight: bold; text-align: right">Valor</td>

        </tr>

        <?php
        //TODO: verificar com o Mayco quais dados apresentar na lista e argumentos AND lanc_data_pagto = '' AND lanc_boleto_num = ''
        $Read->FullRead("SELECT lanc_id, lanc_desc, DATE_FORMAT(lanc_data_venc,'%d/%m/%Y') as lanc_data_venc, lanc_valor, lanc_tipo, DATE_FORMAT(lanc_data_pagto,'%d/%m/%Y') as lanc_data_pagto FROM lancamentos WHERE {$IouC} = {$imov_id} AND lanc_tipo = 'Despesa' ORDER BY lanc_data_venc ASC");

        if ($Read->getResult()):
        foreach ($Read->getResult() as $Dados):
        extract($Dados);
        ?>
        <tr>

            <td style="text-align: left"><?= $lanc_desc; ?></td>

            <td style="text-align: right">
                <?php
                if ($lanc_tipo === "Despesa") {
                    echo 'R$ ' . number_format($lanc_valor, 2, ',', '.');
                    $saldoBoleto += $lanc_valor;
                } else {
                    echo '-';
                }
                ?>
            </td>
            <?php
            endforeach;
            endif;
            ?>
        </tr>
        <!--<td class="text-center text-blue text-bold"> <?/*= 'R$ ' . number_format($saldoBoleto, 2, ',', '.'); */?>  </td>-->
        </tbody>
    </table>
</div>

<br><table cellspacing=0 cellpadding=0 width=666 border=0><TBODY><TR><TD class=ct width=666><img height=1 src=imagens/6.png width=665 border=0></TD></TR><TR><TD class=ct width=666><div align=right><b class=cp></b></div></TD></tr></tbody></table><table width=666 cellspacing=5 cellpadding=0 border=0><tr><td width=41></TD></tr></table>
<div id="logo">
    <img src="../../../img/logo_system_bw.png" width="100">
</div>
<br><table cellspacing=0 cellpadding=0 width=666 border=0><TBODY><TR><TD class=ct width=666><img height=1 src=imagens/6.png width=665 border=0></TD></TR><TR><TD class=ct width=666><div align=right><b class=cp></b></div></TD></tr></tbody></table><table width=666 cellspacing=5 cellpadding=0 border=0><tr><td width=41></TD></tr></table>
