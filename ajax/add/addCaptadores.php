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
endif;

switch ($Action):
    case 'create':

        if ($Post['capt_cpf'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o CPF do fiador";

        elseif ($Post['capt_nome'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o nome do Captador!";

        elseif ($Post['capt_cep'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o CEP";

        elseif ($Post['capt_num'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o Numero!";

        elseif ($Post['capt_celular'] === "" || $Post['capt_telefone'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o numero de Celular e um numero de Telefone!";

        else:
            $Read->FullRead("SELECT capt_cpf FROM captadores WHERE capt_cpf = :capt_cpf", "capt_cpf={$Post['capt_cpf']}");

            if ($Read->getResult()):
                $jSon['error'] = "<b>Oppsss:</b> CPF: <b>{$Post['capt_cpf']}</b> já está cadastrado, Por favor informe outro!";
            else:
                $Create->ExeCreate('captadores', $Post);
                $jSon['success'] = "Cadastro efetuado com sucesso!";
            endif;

        endif;
        break;

    default:
        $jSon['error'] = "Erro ao Selecionar Ação!";
endswitch;

echo json_encode($jSon);
