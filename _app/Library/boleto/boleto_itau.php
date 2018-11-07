<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

//INCLUI OS DADOS PADRÕES
include("_boleto_valores_padroes.php");

// DADOS DA SUA CONTA - ITAÚ
$dadosboleto["agencia"] = $Post['agencia'];// Num da agencia, sem digito
$dadosboleto["conta"] = $Post['conta'];	// Num da conta, sem digito
$dadosboleto["conta_dv"] = $Post['conta_digito']; 	// Digito do Num da conta
// DADOS PERSONALIZADOS - ITAÚ
$dadosboleto["carteira"] = "175";  // Código da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

// NÃO ALTERAR!
include("include/funcoes_itau.php"); 
include("include/layout_itau.php");

?>

<script>
    window.print();
</script>
