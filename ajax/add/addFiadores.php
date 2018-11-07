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

        if ($Post['fiad_cpf'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o CPF do fiador";
        else:
            $Read->FullRead("SELECT fiad_cpf FROM fiadores WHERE fiad_cpf = :fiad_cpf", "fiad_cpf={$Post['fiad_cpf']}");
            if ($Read->getResult()):
                $jSon['error'] = "<b>Oppsss:</b> CPF: <b>{$Post['fiad_cpf']}</b> já está cadastrado, Por favor informe outro!";
            else:
                $Create->ExeCreate('fiadores', $Post);
                $jSon['success'] = "Cadastro efetuado com sucesso!";
            endif;
        endif;
        break;
    default:
        $jSon['error'] = "Erro ao Selecionar Ação!";
endswitch;

echo json_encode($jSon);
