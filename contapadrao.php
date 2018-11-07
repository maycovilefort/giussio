<?php
session_start();
require ('./_app/Config.inc.php');

$login = new Login(3);
$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);

if (!$login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: login.php?exe=restrito');
else:
    $userlogin = $_SESSION['userlogin'];
endif;

if ($logoff):
    unset($_SESSION['userlogin']);
    header('Location: login.php?exe=logoff');
endif;

$Read = new Read;
?>
<!DOCTYPE html>
<html lang="pt-br">

    <!-- Include do HEAD -->
    <?php include_once ('./_app/head.php'); ?>

    <body class="hold-transition skin-blue-light sidebar-mini">
        <div class="wrapper">

            <!-- Include do MAIN_HEADER -->
            <?php require './_app/main_header.php'; ?>

            <!-- Include do MAIN_SIDEBAR -->
            <?php require './_app/main_sidebar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Conta Padrão</h1>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <a id="ContaPadrao" class="btn btn-app j_btnAdd"><i class="fa fa-edit"></i> Novo</a>
                        </div>
                    </div>

                    <!-- Include do MODALS -->
                    <?php include_once ('./_app/modals.php'); ?>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Include do FOOTER -->
            <?php include_once ('./_app/main_footer.php'); ?>

        </div><!-- ./wrapper -->

        <!-- Include do SCRIPTS -->
        <?php include_once ('./_app/scrips_load.php'); ?>

    </body>
</html>