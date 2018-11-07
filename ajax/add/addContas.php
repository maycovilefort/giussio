<?php

require '../../_app/Enuns/Banco.php';

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

$Action = $Post['action'];
$jSon = array();
unset($Post['action']);

if ($Action):
    require_once '../../_app/Config.inc.php';
    $Read = new Read;
    $Create = new Create;
    $Update = new Update;
endif;

$temErro = false;
$codBanco = preg_replace("/[^0-9]/", "", $Post['cont_banco']);

switch ($Action):
    case 'create':

        if ($Post['cont_banco'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o Banco";
            $temErro = true;

        elseif ($Post['cont_banco'] !== ""):

            //TRATAMENTO PARA AGENCIA, CONTA E DIGITOS
            if ($codBanco === Banco::getCodigo(Banco::BancoDoBrasil)) ://DADOS AGENCIA E CONTA BB

                if ($Post['cont_agencia'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero da Agencia!";
                    $temErro = true;

                elseif ($Post['cont_conta'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero da Conta!";
                    $temErro = true;

                endif;

            elseif ($codBanco === Banco::getCodigo(Banco::Itau)) ://DADOS AGENCIA E CONTA ITAU

                if ($Post['cont_agencia'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero da Agencia!";
                    $temErro = true;

                elseif ($Post['cont_conta'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero da Conta";
                    $temErro = true;

                elseif ($Post['cont_conta_digito'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero do digito da Conta";
                    $temErro = true;

                endif;

            elseif ($codBanco === Banco::getCodigo(Banco::Bradesco)) ://DADOS AGENCIA E CONTA BRADESCO

                if ($Post['cont_agencia'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero da Agencia!";
                    $temErro = true;

                elseif ($Post['cont_agencia_digito'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero do digito da Agencia!";
                    $temErro = true;

                elseif ($Post['cont_conta'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero da Conta";
                    $temErro = true;

                elseif ($Post['cont_conta_digito'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero do digito da Conta";
                    $temErro = true;

                endif;

            elseif ($codBanco === Banco::getCodigo(Banco::Santander)) ://DADOS AGENCIA E CONTA SANTANDER

                if ($Post['cont_agencia'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero da Agencia!";
                    $temErro = true;

                elseif ($Post['cont_conta'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero da Conta";
                    $temErro = true;

                endif;

            elseif ($codBanco === Banco::getCodigo(Banco::Caixa)) ://DADOS AGENCIA E CONTA CAIXA

                if ($Post['cont_agencia'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero da Agencia!";
                    $temErro = true;

                elseif ($Post['cont_conta'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero da Conta";
                    $temErro = true;

                elseif ($Post['cont_conta_digito'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero do digito da Conta";
                    $temErro = true;

                endif;

            elseif ($codBanco === Banco::getCodigo(Banco::HSBC)) ://DADOS AGENCIA E CONTA HSBC
                if ($Post['cont_agencia'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero da Agencia!";
                    $temErro = true;

                elseif ($Post['cont_conta'] === ""):
                    $jSon['error'] = "<b>Oppsss:</b> Informe o numero da Conta";
                    $temErro = true;

                endif;
            endif;

        endif;

        if ($Post['cont_titular'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o nome do Titular da Conta!";
            $temErro = true;

        elseif ($Post['cont_cpf'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o CPF do Titular da Conta!";
            $temErro = true;

        endif;

        if (!$temErro):
            $Create->ExeCreate('contas', $Post);
            $jSon['success'] = "Cadastro efetuado com sucesso!";
        endif;

        break;
    default:
        $jSon['error'] = "Erro ao Selecionar Ação!";
endswitch;

echo json_encode($jSon);
