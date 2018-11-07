<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

$Action = $Post['action'];
$jSon = array();
unset($Post['action']);
unset($Post['qual_imov']);

if ($Action):
    require_once '../../_app/Config.inc.php';
    $Read = new Read;
    $Create = new Create;
endif;

switch ($Action):
    case 'create':

        if ($Post['lanc_data_lanc'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe a data de Lançamento!";

        elseif ($Post['lanc_tipo'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o tipo do Lançamento!";

        elseif ($Post['lanc_desc'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe a descrição do Lançamento!";

        elseif ($Post['lanc_data_venc'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe a data de vencimento do Lançamento!";

        elseif ($Post['lanc_valor'] === ""):
            $jSon['error'] = "<b>Oppsss:</b> Informe o valor do do Lançamento!";

        elseif ($Post['lanc_id_imov'] !== "" || $Post['lanc_id_cond'] !== ""):
            $Create->ExeCreate('lancamentos', $Post);
            $jSon['success'] = "Cadastro efetuado com sucesso!";

        else:
            $jSon['error'] = "<b>Oppsss:</b> Deu Ruim!";

        endif;
        break;

    default:
        $jSon['error'] = "Erro ao Selecionar Ação!";
endswitch;

echo json_encode($jSon);
