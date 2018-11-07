<?php
$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

require_once('../../_app/Config.inc.php');
$Read = new Read;
?>

<!-- INICIO - Form Clientes -->
<form name="<?= $Post['table']; ?>" class="j_delete" action="" method="POST">
    <div class="alert-box"></div>
    <input class="noclear" type="hidden" name="action" value="<?= $Post['action']; ?>" />
    <input class="noclear" type="hidden" name="table" value="<?= $Post['table']; ?>" />
    <input class="noclear" type="hidden" name="id" value="<?= $Post['id']; ?>" />

    <div class="col-md-12">
        <p>Para confirmar a exclusão clique em excluir!</p>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <br>
            <br>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
        <div class="form-group col-md-6 text-right">
            <br>
            <br>
            <button name="<?= $Post['table']; ?>" rel="<?= $Post['id']; ?>" type="submit" class="btn btn-info">Excluir</button>
        </div>
    </div>
</form>
<!-- FIM - FormDelete -->