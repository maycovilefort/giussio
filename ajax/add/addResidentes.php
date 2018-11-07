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

        if ($Post['resi_cpf'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o CPF do Condomínio";

        elseif ($Post['resi_nome'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o nome do Condomínio!";

        elseif ($Post['resi_cep'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o CEP";

        elseif ($Post['resi_num'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o Numero!";

        elseif ($Post['resi_celular'] === "" || $Post['resi_telefone'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o numero de Celular e um numero de Telefone!";

        else:
            $Read->FullRead("SELECT resi_cpf FROM residentes WHERE resi_cpf = :resi_cpf", "resi_cpf={$Post['resi_cpf']}");

            if ($Read->getResult()):
                $jSon['error'] = "<b>Oppsss:</b> CNPJ: <b>{$Post['resi_cpf']}</b> já está cadastrado, Por favor informe outro!";
            else:
                $Create->ExeCreate('residentes', $Post);
                $jSon['success'] = "Cadastro efetuado com sucesso!";
            endif;

        endif;
        break;
    default:
        $jSon['error'] = "Erro ao Selecionar Ação!";
endswitch;

echo json_encode($jSon);
