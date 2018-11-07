<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

//dados do boleto
include("_boleto_valores_padroes.php");

// DADOS PERSONALIZADOS - SANTANDER BANESPA
$dadosboleto["codigo_cliente"] = $Post['codigo_cliente']; // C�digo do Cliente (PSK) (Somente 7 digitos)
$dadosboleto["ponto_venda"] = $Post['ponto_venda'];; // Ponto de Venda = Agencia
$dadosboleto["carteira"] = "102";  // Cobran�a Simples - SEM Registro
$dadosboleto["carteira_descricao"] = "COBRAN�A SIMPLES - CSR";  // Descri��o da Carteira

// N�O ALTERAR!
include("include/funcoes_santander_banespa.php"); 
include("include/layout_santander_banespa.php");

?>

<script>
    window.print();
</script>