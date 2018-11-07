<?php

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

switch ($Action):
    case 'create':

        if ($Post['prop_cpf'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o CPF do Condomínio";

        elseif ($Post['prop_nome'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o nome do Condomínio!";

        elseif ($Post['prop_cep'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o CEP";

        elseif ($Post['prop_num'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o Numero!";

        elseif ($Post['prop_celular'] === "" || $Post['prop_telefone'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o numero de Celular e um numero de Telefone!";

        else:
            $Read->FullRead("SELECT prop_cpf FROM proprietarios WHERE prop_cpf = :prop_cpf", "prop_cpf={$Post['prop_cpf']}");

            if ($Read->getResult()):
                $jSon['error'] = "<b>Oppsss:</b> CNPJ: <b>{$Post['prop_cpf']}</b> já está cadastrado, Por favor informe outro!";
            else:
                $Create->ExeCreate('proprietarios', $Post);
                $jSon['success'] = "Cadastro efetuado com sucesso!";
            endif;

        endif;
        break;
    default:
        $jSon['error'] = "Erro ao Selecionar Ação!";
endswitch;

echo json_encode($jSon);
