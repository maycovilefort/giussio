<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

//dados do boleto
include("_boleto_valores_padroes.php");

// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS PERSONALIZADOS - HSBC
$dadosboleto["codigo_cedente"] = $Post['codigo_cedente']; // Código do Cedente (Somente 7 digitos)
$dadosboleto["carteira"] = "CNR";  // Código da Carteira

// NÃO ALTERAR!
include("include/funcoes_hsbc.php"); 
include("include/layout_hsbc.php");
?>

<script>
    window.print();
</script>