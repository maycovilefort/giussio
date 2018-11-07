<?php

// CONFIGRAÇÕES DO BANCO ####################
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '');
define('DBSA', 'giussio_bd');

// DEFINE SERVIDOR DE E-MAIL ################
define('MAILUSER', 'contato@giussiocorretora.com.br');
define('MAILPASS', 'senhadoemail');
define('MAILPORT', 'portadeenvio');
define('MAILHOST', 'servidordeenvio');

// DEFINE IDENTIDADE DO SITE ################
define('SITENAME', 'Cidade Online');
define('SITEDESC', 'Este site foi desenvolvido no curso de PHP Orientado a Objetos da UPINSIDE TREINAMENTOS. O mesmo utiliza a arquitetura semântica do HTML5 e foi criado com as últimas técnologias disponíveis!');

// DEFINE A BASE DO SITE ####################
define('HOME', 'http://localhost/giussio/');
define('THEME', 'giussiocorretos');

define('INCLUDE_PATH', HOME . '/themes/' . THEME);
define('REQUIRE_PATH', 'themes' . DIRECTORY_SEPARATOR . THEME);

// AUTO LOAD DE CLASSES ####################
function __autoload($Class) {

    $cDir = ['Conn', 'Helpers', 'Models'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php') && !is_dir(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php')):
            include_once (__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php');
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
        die;
    endif;
}

// TRATAMENTO DE ERROS #####################
//CSS constantes :: Mensagens de Erro
define('WS_ACCEPT', 'alert-success');
define('WS_INFOR', 'alert-info');
define('WS_ALERT', 'alert-warning');
define('WS_ERROR', 'alert-danger');

//WSErro :: Exibe erros lançados :: Front
function WSErro($ErrMsg, $ErrNo, $ErrDie = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
//    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";
    echo "<div class=\"alert {$CssClass}\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>{$ErrMsg}</div>";

    if ($ErrDie):
        die;
    endif;
}

//PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');