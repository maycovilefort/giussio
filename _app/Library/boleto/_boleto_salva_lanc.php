<?php

require '../../../_app/Enuns/TipoImovel.php';
require '../../../_app/Enuns/TipoLancamento.php';
require '../../../_app/Config.inc.php';
// +----------------------------------------------------------------------+
// | GRAVANDO O LANCAMENTO                                                |
// +----------------------------------------------------------------------+
$tipoLancamento = TipoLancamento::RECEITA;
$nomeColuna = "";
$Create = new Create;

if ($imovOuCond === TipoImovel::IMOVEL) {
    $nomeColuna = "lanc_id_imov";
} else{
    $nomeColuna = "lanc_id_cond";
}

$dadosboleto["nome_coluna"] = $nomeColuna;
$dadosboleto["imov_id"] = $imov_id;

$total += $taxa_boleto;

$dadosSalvar = array(
    "lanc_data_lanc" => date("Y-m-d"),
    "lanc_tipo" => $tipoLancamento,
    "lanc_desc"=> "Boleto manual teste",
    "lanc_data_venc"=> date("Y-m-d", time() + ($dias_de_prazo_para_pagamento * 86400)),
    "lanc_valor"=> $total,
    "lanc_boleto_emissao" => date("Y-m-d"),
    $nomeColuna => $imov_id,
    "lanc_boleto_num" => monta_linha_digitavel($linha));

$Create->FullCreate('lancamentos', $dadosSalvar);