<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

$Table = ($Post['table']);
$ID = ($Post['id']);
$Action = ($Post['action']);
$jSon = array();
unset($Post['table']);
unset($Post['id']);
unset($Post['action']);

if ($Action):
    require_once '../../_app/Config.inc.php';
    $Read = new Read;
    $Update = new Update;
endif;

switch ($Action):

    case 'Update':


        if ($ID === ''):
            echo "Erro Informe o ID!";
        else:
            $Read->FullRead("SELECT * FROM lancamentos WHERE lanc_id = {$ID}");
            foreach ($Read->getResult() as $Dados):
                extract($Dados);
            endforeach;

            if ($Read->getResult() && $lanc_data_pagto === NULL):
                $Update->ExeUpdate($Table, $Post, "WHERE lanc_id = :id", "id={$ID}");
                echo "BAIXA EFETUADA com sucesso!";
            else:
                $Post['lanc_data_pagto'] = NULL;
                $Update->ExeUpdate($Table, $Post, "WHERE lanc_id = :id", "id={$ID}");
                echo "BAIXA REMOVIDA com sucesso!";
            endif;
        endif;
        break;

    default:
        echo "Erro ao Selecionar Ação!";
endswitch;
