<?php
session_start();
require ('./_app/Config.inc.php');
unset($_SESSION['userlogin']);
?>
<!DOCTYPE html>
<html lang = "pt-br">
    <?php require_once ('./_app/head.php') ?>
    <body class="bg_login">
        <div class = "bg_login"></div>
        <div class="login-box">
            <div class="login-logo">
                <a href="index.php"><img src="img/logo_system.png" width="250" /></a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <?php
                $login = new Login(3);

                if ($login->CheckLogin()):
                    header('Location: dashboard.php');
                endif;

                $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if (!empty($dataLogin['AdminLogin'])):

                    $login->ExeLogin($dataLogin);
                    if (!$login->getResult()):
                        WSErro($login->getError()[0], $login->getError()[1]);
                    else:
                        header('Location: dashboard.php');
                    endif;
                endif;

                $get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
                if (!empty($get)):
                    if ($get == 'restrito'):
                        WSErro('<b>Oppsss:</b> Acesso negado. Efetue login para acessar o painel!', WS_ALERT);
                    elseif ($get == 'logoff'):
                        WSErro('<b>OK:</b> Sua sessão foi finalizada. Volte sempre!', WS_ACCEPT);
                    endif;
                endif;
                ?>

                <form name="AdminLoginForm" action="" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" name="user_cpf" class="form-control" placeholder="Login" />
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" name="user_pass" class="form-control" placeholder="Senha" />
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    <input type="submit" name="AdminLogin" class="btn btn-primary btn-block btn-flat" value="Acessar" />

                </form>
                <!--
                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
                    <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
                </div> /.social-auth-links 
                -->
<!--                <p>
                    <br>
                    <a href="#">Esqueci minha senha!</a><br>
                    <a href="register.html" class="text-center">Cadastrar novo Usuário</a> 
                </p>-->
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <?php require_once ('./_app/scrips_load.php') ?> 
    </body>
</html>