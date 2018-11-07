<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

$Action = $Post['action'];
$jSon = array();
unset($Post['action']);

$temConta = $Post['possui_conta'];
unset($Post['possui_conta']);

if($temConta === "sim") {
    $Post['cond_id_cont'] = $Post['cont_id'];
    unset($Post['cont_id']);
}

if ($Action):
    require_once '../../_app/Config.inc.php';
    $Read = new Read;
    $Create = new Create;
    $Update = new Update;
endif;

switch ($Action):
    case 'create':

        if ($temConta === "sim"):
            if($Post['cond_id_cont'] === "" || $Post['cond_id_cont'] === "0"):
                $jSon['error'] = "<b>Oppsss:</b> Informe a conta!";
            endif;
        endif;

        if ($Post['cond_cnpj'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o CNPJ do Condomínio";

        elseif ($Post['cond_nome'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o nome do Condomínio!";

        elseif ($Post['cond_cep'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o CEP";

        elseif ($Post['cond_num'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o Numero!";

        elseif ($Post['cond_telefone'] === "" || $Post['cond_telefone'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o numero de Celular e um numero de Telefone!";
        
        elseif ($Post['cond_resp_celular'] === "" || $Post['cond_resp_telefone'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o numero de Celular e um numero de Telefone!";

        else:
            $Read->FullRead("SELECT cond_cnpj FROM condominios WHERE cond_cnpj = :cond_cnpj", "cond_cnpj={$Post['cond_cnpj']}");

            if ($Read->getResult()):
                $jSon['error'] = "<b>Oppsss:</b> CNPJ: <b>{$Post['cond_cnpj']}</b> já está cadastrado, Por favor informe outro!";
            else:
                $Create->ExeCreate('condominios', $Post);
                $jSon['success'] = "Cadastro efetuado com sucesso!";
            endif;

        endif;
        break;
    default:
        $jSon['error'] = "Erro ao Selecionar Ação!";
endswitch;

echo json_encode($jSon);
