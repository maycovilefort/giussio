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
                    <h1>Proprietários e Beneficiários</h1>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <a id="Proprietarios" class="btn btn-app j_Add"><i class="fa fa-edit"></i> Cadastrar</a>
                        </div>
                    </div>
                    
                    <!-- Tabela de PROPRIETÁRIOS  -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Fiadores Cadastrados</h3>

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
                                        <th>PROPRIETÁRIO</th>
                                        <th class="text-center">CPF</th>
                                        <th class="text-center">CELULAR</th>
                                        <th class="text-center">TELEFONE</th>
                                        <th class="text-center hidden-xs">COMERCIAL</th>
                                        <th class="text-center hidden-sm hidden-xs">E-MAIL</th>
                                        <th class="text-center">AÇÕES</th>
                                    </tr>

                                    <?php
                                    $Atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
                                    $Pager = new Pager('proprietarios.php?atual=', 'Primeira', 'Última', '1');
                                    $Pager->ExePager($Atual, 10);

                                    $Read->FullRead('SELECT * FROM proprietarios LIMIT :limit OFFSET :offset', "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

                                    if ($Read->getResult()):
                                        foreach ($Read->getResult() as $Dados):
                                            extract($Dados);
                                            ?>
                                            <tr>
                                                <td rel="<?= $prop_id ?>" class="text-center"><?= $prop_id; ?></td>
                                                <td><?= $prop_nome; ?></td>
                                                <td class="text-center"><?= $prop_cpf; ?></td>
                                                <th class="text-center"><?= $prop_celular; ?></th>
                                                <th class="text-center"><?= $prop_telefone; ?></th>
                                                <th class="text-center hidden-xs"><?= $prop_comercial; ?></th>
                                                <th class="text-center hidden-sm hidden-xs"><?= $prop_email; ?></th>
                                                <td class="text-center">
                                                    <button class="btn btn-default btn-xs center"><span class="fa fa-edit"></span></button>
                                                    <button id="Proprietarios" rel="<?= $prop_id ?>" action="Delete" class="btn btn-default btn-xs center j_del"><span class="fa fa-close"></span></button>
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
                                $Pager->ExePaginator('proprietarios');
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