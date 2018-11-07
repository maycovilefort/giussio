<?php

$imov_id = $Post['imov_id'];
//unset($Post['imov_id']);

$imovOuCond = $Post['imovOuCond'];
//unset($Post['imovOuCond']);

// +--------------------------------------------------------------------------------------------------------+
// | Dados padr�es vindo do formulario                                                                      |
// +--------------------------------------------------------------------------------------------------------+

//DADOS DO BOLETO
$total              = $Post['total'];
//$dataVenc           = $Post['dataVenc'];
$nossoNumero        = $Post['nossoNumero'];
$numeroPedido       = $Post['numeroPedido'];

//DADOS DO CEDENTE
$nomeCedente        = $Post['nomeCedente'];
$cpfCnpjf           = $Post['cpfCnpjf'];
$enderecoCedente    = $Post['enderecoCedente'];
$cidadeUFCedente    = $Post['cidadeCedente'].' / '.$Post['estadoCedente'];
$razaoCedente       = $Post['razaoCedente'];
$identificacao      = "Boleto - Giussio & Giussio - Corretora";

// INFORMACOES PARA O CLIENTE
$demonstrativo1     = $Post['demonstrativo1'];
$demonstrativo2     = $Post['demonstrativo2'];
$demonstrativo3     = $Post['demonstrativo3'];
$instrucoes1        = "- Sr. Caixa, cobrar multa de 2% após o vencimento";
$instrucoes2        = "- Receber até 10 dias após o vencimento";
$instrucoes3        = "- Em caso de dúvidas entre em contato conosco: contato@giussiocorretora.com.br";
$instrucoes4        = "&nbsp; Emitido por ".$razaoCedente." - www.app.giussiocorretora.com.br";

// DADOS DO SACADO
$nomeSacado        = $Post['nomeSacado'];
$enderecoSacado    = $Post['enderecoSacado'];
$cidadeSacado      = $Post['cidadeSacado'];
$estadoSacado      = $Post['estadoSacado'];
$bairroSacado      = $Post['bairroSacado'];
$cepSacado         = $Post['cepSacado'];



// +--------------------------------------------------------------------------------------------------------+
// | Setando os valores em >> $dadosboleto[]                                                                |
// +--------------------------------------------------------------------------------------------------------+

// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = 2.95;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006";
$valor_cobrado = $total; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = $nossoNumero;  // Nosso numero - REGRA: M�ximo de 8 caracteres!
$dadosboleto["numero_documento"] = $numeroPedido;	// Num do pedido ou nosso numero
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $nomeSacado;
$dadosboleto["endereco1"] = $enderecoSacado;
$dadosboleto["endereco2"] = $cidadeSacado.' - '. $estadoSacado .' - '.' CEP: '.$cepSacado;

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = $demonstrativo1;
$dadosboleto["demonstrativo2"] = $demonstrativo2."<br>Taxa bancária - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo3"] = $demonstrativo3;
$dadosboleto["instrucoes1"] = $instrucoes1;
$dadosboleto["instrucoes2"] = $instrucoes2;
$dadosboleto["instrucoes3"] = $instrucoes3;
$dadosboleto["instrucoes4"] = $instrucoes4;

// SEUS DADOS
$dadosboleto["identificacao"] = $identificacao;
$dadosboleto["cpf_cnpj"] = $cpfCnpjf;
$dadosboleto["endereco"] = $enderecoCedente;
$dadosboleto["cidade_uf"] = $cidadeUFCedente;
$dadosboleto["cedente"] = $razaoCedente;

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "10";
$dadosboleto["valor_unitario"] = "10";
$dadosboleto["aceite"] = "N";
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "DM";

?>