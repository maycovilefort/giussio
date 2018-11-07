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
                    <h1>Cobrança</h1>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <a id="Cobranca" class="btn btn-app j_manual"><i class="fa fa-barcode"></i> Manual</a>
                            <a id="Cobranca" class="btn btn-app j_automatica"><i class="fa fa-hourglass"></i> Automática</a>
                        </div>
                    </div>
                    
                    <!-- Boleto - Selecionar e Gerar (Manual)-->

                    <!-- Boleto - Selecionar e Gerar (Automatica)-->

                    <!-- Filtro de Periodo -->
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <h4 class="text-center">Selecionar Periodo</h4>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input id="datapicker_fluxo" type="text" data-range="true" data-multiple-dates-separator=" - " data-language="pt" class="datepicker-here form-control pull-right" value="<?php echo date('01/m/Y') . " - " . date('t/m/Y'); ?>"/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-info btn-flat j_datapicker_fluxo" type="button">Filtrar</button>
                                        <img class="form_load" style="display: none; padding-left: 10px;" src="img/load.gif" />
                                    </span>
                                </div><!-- /.input group -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div id="fluxo_caixa"></div>
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
        <script>
            window.onload = function () {
                var Data = $('#datapicker_fluxo').val();
                $.ajax({
                    url: 'ajax/CobrancasAjax.php',
                    data: {Data: Data},
                    type: 'GET',
                    dataType: 'html',
                    beforeSend: function () {
                        $('.form_load').fadeIn();
                    },
                    success: function (resposta) {
                        $(resposta).replaceAll('#fluxo_caixa');
                        $('.form_load').fadeOut();
                    }
                });
            }
        </script>
    </body>
</html>