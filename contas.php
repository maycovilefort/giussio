<?php
session_start();
require_once ('./_app/Config.inc.php');

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
    <?php require_once ('./_app/head.php'); ?>

    <body class="hold-transition skin-blue-light sidebar-mini">
        <div class="wrapper">

            <!-- Include do MAIN_HEADER -->
            <?php require_once ('./_app/main_header.php'); ?>

            <!-- Include do MAIN_SIDEBAR -->
            <?php require_once ('./_app/main_sidebar.php'); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Contas Bancárias</h1>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <a id="Contas" class="btn btn-app j_Add"><i class="fa fa-edit"></i> Novo</a>
                        </div>
                    </div>

                    <!-- Tabela de Clientes  -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Contas Bancárias Cadastradas</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 300px;">
                                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Pesquisar...">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th style="width: 20%">TITULAR</th>
                                        <th class="text-center" style="width: 15%">CPF</th>
                                        <th style="width: 20%">BANCO</th>
                                        <th class="text-center" style="width: 10%">AGENCIA</th>
                                        <th class="text-center" style="width: 15%">COD. CEDENTE</th>
                                        <th class="text-center" style="width: 15%">CONTA</th>
                                        <th class="text-center" style="width: 10%">AÇÕES</th>
                                    </tr>
                                    <?php
                                    $Atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
                                    $Pager = new Pager('contas.php?atual=', 'Primeira', 'Última', '1');
                                    $Pager->ExePager($Atual, 10);

                                    $Read->ExeRead('contas', 'LIMIT :limit OFFSET :offset', "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

                                    if ($Read->getResult()):
                                        foreach ($Read->getResult() as $Dados):
                                            extract($Dados);
                                            ?>
                                            <tr>
                                                <td class="text-center" rel="<?= $cont_id ?>"><?= $cont_id; ?></td>
                                                <td><?= $cont_titular; ?></td>
                                                <td class="text-center"><?= $cont_cpf; ?></td>                                        
                                                <td><?= $cont_banco; ?></td>
                                                <td class="text-center"><?= $cont_agencia; ?></td>
                                                <td class="text-center"><?= $cont_cod_cedente; ?></td>
                                                <td class="text-center"><?= $cont_conta; ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-default btn-xs center"><span class="fa fa-edit"></span></button>
                                                    <button id="Contas" rel="<?= $cont_id ?>" action="Delete" class="btn btn-default btn-xs center j_del"><span class="fa fa-close"></span></button>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer clearfix">
                            <?php
                            if (!$Read->getRowCount()):
                                $Pager->ReturnPage();
                                echo 'Nenhum registro encontrado!';
                            else:
                                $Pager->ExePaginator('contas');
                                echo $Pager->getPaginator();
                            endif;
                            ?>
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