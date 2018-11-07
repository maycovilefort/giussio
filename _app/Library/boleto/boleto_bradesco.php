<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

//INCLUI OS DADOS PADRÕES
include("_boleto_valores_padroes.php");

// DADOS DA SUA CONTA - Bradesco
$dadosboleto["agencia"] = $Post['agencia']; // Num da agencia, sem digito
$dadosboleto["agencia_dv"] = $Post['agencia_digito']; // Digito do Num da agencia
$dadosboleto["conta"] = $Post['conta']; 	// Num da conta, sem digito
$dadosboleto["conta_dv"] = $Post['conta_digito']; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - Bradesco
$dadosboleto["conta_cedente"] = $Post['conta'];// ContaCedente do Cliente, sem digito (Somente Números)
$dadosboleto["conta_cedente_dv"] = $Post['conta_digito']; // Digito da ContaCedente do Cliente
$dadosboleto["carteira"] = "06";  // Código da Carteira: pode ser 06 ou 03

// NÃO ALTERAR!
include("include/funcoes_bradesco.php");
include("include/layout_bradesco.php");

?>

<script>
    window.print();
</script>