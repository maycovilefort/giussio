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
    $Delete = new Delete();
endif;

switch ($Action):

    case 'Delete':
        if ($Post['id'] === ''):
            $jSon['error'] = "Erro ao Excluir!";
        else:
            $Delete->ExeDelete($Post['table'], "WHERE prop_id = :id", "id={$Post['id']}");
            $jSon['success'] = "Exclusão efetuada com sucesso!";
        endif;
        break;

    default:
        $jSon['error'] = "Erro ao Selecionar Ação!";
endswitch;

echo json_encode($jSon);
