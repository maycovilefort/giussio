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

        $Create->ExeCreate('imoveis', $Post);
        $jSon['success'] = "Cadastro efetuado com sucesso!";
        break;

    default:
        $jSon['error'] = "Erro ao Selecionar Ação!";
endswitch;

echo json_encode($jSon);
