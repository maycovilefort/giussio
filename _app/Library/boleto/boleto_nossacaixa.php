<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

//INCLUI OS DADOS PADRÕES
include("_boleto_valores_padroes.php");

$dadosboleto["inicio_nosso_numero"] = "99";
// DADOS PERSONALIZADOS - CEF
$dadosboleto["agencia"] = $Post['agencia']; // Num da agencia, sem digito
$dadosboleto["conta_cedente"] = $Post['conta']; // ContaCedente do Cliente, sem digito (Somente 6 digitos)
$dadosboleto["conta_cedente_dv"] = $Post['conta_digito']; // Digito da ContaCedente do Cliente
$dadosboleto["carteira"] = "5";  // Código da Carteira -> 5-Cobrança Direta ou 1-Cobrança Simples
$dadosboleto["modalidade_conta"] = "04";  // modalidade da conta 02 posições

// NÃO ALTERAR!
include("include/funcoes_nossacaixa.php"); 
include("include/layout_nossacaixa.php");
?>

<script>
    window.print();
</script>