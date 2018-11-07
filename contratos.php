<?php
session_start();
require_once ('./_app/Config.inc.php');

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
                    <h1>Contratos</h1>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <a id="Contratos" class="btn btn-app j_Add"><i class="fa fa-edit"></i> Cadastrar</a>
                        </div>
                    </div>

                    <!-- Tabela de Clientes  -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Contratos Cadastrados</h3>

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
                                        <th class="text-center" hidden>ID</th>
                                        <th>IMÓVEL</th>
                                        <th class="text-center">DATA INICIAL</th>
                                        <th class="text-center">DATA FINAL</th>
                                        <th class="text-center">RESIDENTE</th>
                                        <th class="text-center">PROPRIETÁRIO</th>   
                                        <th class="text-center">AÇÕES</th>
                                    </tr>

                                    <?php
                                    $Atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
                                    $Pager = new Pager('contratos.php?atual=', 'Primeira', 'Última', '1');
                                    $Pager->ExePager($Atual, 10);

                                    $Read->FullRead('SELECT * FROM contratos '
                                            . 'INNER JOIN imoveis ON contratos.contratos_id_imov = imoveis.imov_id '
                                            . 'INNER JOIN residentes ON contratos.contratos_id_resi = residentes.resi_id '
                                            . 'INNER JOIN proprietarios ON imoveis.imov_id_prop = proprietarios.prop_id '
                                            . 'LIMIT :limit OFFSET :offset', "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

                                    if ($Read->getResult()):
                                        foreach ($Read->getResult() as $Dados):
                                            extract($Dados);
                                            ?>
                                            <tr>
                                                <td rel="<?= $contratos_id ?>" class="text-center" hidden><?= $contratos_id; ?></td>
                                                <td><?= "{$imov_endereco}, {$imov_num}, {$imov_comp},<br> {$imov_bairro}, {$imov_cidade} - {$imov_uf} - {$imov_cep}"; ?></td>
                                                <td class="text-center"><?= $contratos_data_inicial; ?></td>
                                                <td class="text-center"><?= $contratos_data_final; ?></td>
                                                <td class="text-center"><?= $resi_nome; ?></td>
                                                <td class="text-center"><?= $prop_nome; ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-default btn-xs center"><span class="fa fa-edit"></span></button>
                                                    <button id="Contratos" rel="<?= $contratos_id ?>" action="Delete" class="btn btn-default btn-xs center j_del"><span class="fa fa-close"></span></button>
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
                                $Pager->ExePaginator('contratos');
                                echo $Pager->getPaginator();
                            endif;
                            ?>
                        </div>
                    </div>
                    <!-- /.box-body -->


                    <!-- Include do MODALS -->
                    <?php require_once ('./_app/modals.php'); ?>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Include do FOOTER -->
            <?php require_once ('./_app/main_footer.php'); ?>

        </div><!-- ./wrapper -->

        <!-- Include do SCRIPTS -->
        <?php require_once ('./_app/scrips_load.php'); ?>

    </body>
</html>