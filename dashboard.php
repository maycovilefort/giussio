<?php
session_start();
require ('./_app/Config.inc.php');

$login = new Login(3);

$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);

if (!$login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=restrito');
else:
    $userlogin = $_SESSION['userlogin'];
endif;

if ($logoff):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=logoff');
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
                    <h1>Dashboard</h1>
                </section>

                <!-- Block Resume -->
                <div class="j_blockresume"></div>

                <!-- Main content -->
                <section class="content">

                    <!-- Caixas com os totais -->
                    <div class="col-lg-3 col-md-6 col-sm-6 hidden-lg">
                        <!-- Info Boxes Style 2 -->
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fa fa-home"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text text-center">Imóveis</span>
                                <span class="info-box-number text-center">
                                    <?php
                                    $Read->FullRead("SELECT * FROM imoveis");

                                    echo $Read->getRowCount();
                                    ?>
                                </span>

                                <span class="progress-description text-center">
                                    <a href="#" class="btn btn-sm btn-warning">Detalhado</a>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                        <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="fa fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text text-center">Residentes</span>
                                <span class="info-box-number text-center">
                                    <?php
                                    $Read->FullRead("SELECT * FROM residentes");

                                    echo $Read->getRowCount();
                                    ?>
                                </span>

                                <span class="progress-description text-center">
                                    <a href="#" class="btn btn-sm btn-success">Detalhado</a>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 hidden-lg">
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fa fa-key"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text text-center">Proprietários</span>
                                <span class="info-box-number text-center">
                                    <?php
                                    $Read->FullRead("SELECT * FROM proprietarios");

                                    echo $Read->getRowCount();
                                    ?>
                                </span>

                                <span class="progress-description text-center">
                                    <a href="#" class="btn btn-sm btn-danger">Detalhado</a>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                        <div class="info-box bg-aqua">
                            <span class="info-box-icon"><i class="fa fa-building"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text text-center">Condomínios</span>
                                <span class="info-box-number text-center">
                                    <?php
                                    $Read->FullRead("SELECT * FROM condominios");

                                    echo $Read->getRowCount();
                                    ?>
                                </span>

                                <span class="progress-description text-center">
                                    <a href="#" class="btn btn-sm btn-info">Detalhado</a>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>

                    <!-- Extrato Lançamentos -->
                    <div class="col-lg-9 col-md-12 col-sm-12 hidden-xs">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Lançamentos por Período</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <table class="table table-condensed">
                                    <tbody><tr>
                                            <th>Data</th>
                                            <th>Descrição</th>
                                            <th>Receita</th>
                                            <th>Despesa</th>
                                            <th>Saldo</th>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td>21/01/2016</td>
                                            <td>Agúa e Esgoto</td>
                                            <td><span class="badge bg-blue">+ R$0,00</span></td>
                                            <td><span class="badge bg-red">- R$0,00</span></td>
                                            <td><span class="badge bg-green">- R$0,00</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>

                    <!-- Caixas com os totais -->
                    <div class="col-lg-3 col-md-6 col-sm-6 hidden-md hidden-sm hidden-xs">
                        <!-- Info Boxes Style 2 -->
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fa fa-home"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text text-center">Imóveis</span>
                                <span class="info-box-number text-center">
                                    <?php
                                    $Read->FullRead("SELECT * FROM imoveis");

                                    echo $Read->getRowCount();
                                    ?>
                                </span>

                                <span class="progress-description text-center">
                                    <a href="#" class="btn btn-sm btn-warning">Detalhado</a>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                        <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="fa fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text text-center">Residentes</span>
                                <span class="info-box-number text-center">
                                    <?php
                                    $Read->FullRead("SELECT * FROM residentes");

                                    echo $Read->getRowCount();
                                    ?>
                                </span>

                                <span class="progress-description text-center">
                                    <a href="#" class="btn btn-sm btn-success">Detalhado</a>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 hidden-md hidden-sm hidden-xs">
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fa fa-key"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text text-center">Proprietários</span>
                                <span class="info-box-number text-center">
                                    <?php
                                    $Read->FullRead("SELECT * FROM proprietarios");

                                    echo $Read->getRowCount();
                                    ?>
                                </span>

                                <span class="progress-description text-center">
                                    <a href="#" class="btn btn-sm btn-danger">Detalhado</a>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                        <div class="info-box bg-aqua">
                            <span class="info-box-icon"><i class="fa fa-building"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text text-center">Condomínios</span>
                                <span class="info-box-number text-center">
                                    <?php
                                    $Read->FullRead("SELECT * FROM condominios");

                                    echo $Read->getRowCount();
                                    ?>
                                </span>

                                <span class="progress-description text-center">
                                    <a href="#" class="btn btn-sm btn-info">Detalhado</a>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->



            <!-- Include do MODALS -->
            <?php include_once ('./_app/modals.php'); ?>



            <!-- Include do FOOTER -->
            <?php include_once ('./_app/main_footer.php'); ?>

        </div><!-- ./wrapper -->

        <!-- Include do SCRIPTS -->
        <?php include_once ('./_app/scrips_load.php'); ?>

    </body>
</html>