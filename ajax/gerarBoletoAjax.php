<?php
require '../_app/Config.inc.php';
require '../_app/Enuns/Banco.php';
require '../_app/Enuns/TipoImovel.php';

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

$params = explode("/", $_POST['params']);
$imov_id = $params[0];
$IouC = $params[1];
$imovOuCond = "";

if($IouC === "I"){
    $IouC = "lanc_id_imov";
    $imovOuCond = TipoImovel::IMOVEL;
}else if($IouC === "C"){
    $IouC = "lanc_id_cond";
    $imovOuCond = TipoImovel::CONDOMINIO;
}

//TODO: verificar dados
// +----------------------------------------------------------------------+
// | DADOS DA EMPRESA                                                     |
// +----------------------------------------------------------------------+
$enderecoCedente = 'Rua Américo Brasiliense, 1490';
$cidadeCedente = 'São Paulo';
$estadoCedente = 'SP';
$razaoCedente = 'Giussio & Giussio - Corretora';

$nossoNumero = '12345678';
$numeroPedido = '987654321';
$demonstrativo1 = 'Demostrativo 01';
$demonstrativo2 = 'Demostrativo 02';
$demonstrativo3 = 'Demostrativo 03';

// +----------------------------------------------------------------------+
// | TOTAL DOS LANÇAMENTOS PARA O IMOVEL EM QUESTAO                       |
// +----------------------------------------------------------------------+
$ReadLanc = new Read;
$temLancamento = false;

$ReadLanc->FullRead("SELECT lanc_valor FROM lancamentos WHERE {$IouC} = {$imov_id} AND lanc_tipo = 'Despesa'");
$lancTotal =  "";

if ($ReadLanc->getResult()):
    $temLancamento = true;
    foreach ($ReadLanc->getResult() as $DadosImov):
        extract($DadosImov);
        $lancTotal += $lanc_valor;
    endforeach;
endif;

// +----------------------------------------------------------------------+
// | DADOS DO IMÓVEL OU CONDOMINIO                                        |
// +----------------------------------------------------------------------+
$propImovCond = '';
$numeroImovCond = '';
$enderecoImovCond = '';
$numeroImovCond = '';
$cidadeImovCond = '';
$estadoImovCon = '';
$bairroImovCon = '';
$cepImovCon = '';
$idContaImovCon = '';

$ReadImov = new Read;
$ReadImov->FullRead("SELECT * FROM imoveis WHERE imov_id = ${imov_id}");

if ($ReadImov->getResult()) {

    foreach ($ReadImov->getResult() as $DadosImov):

        if ($imovOuCond === TipoImovel::CONDOMINIO) {

            $idMovCond = $DadosImov['imov_id_cond'];

            $ReadCond = new Read;
            $ReadCond->FullRead("SELECT * FROM condominios WHERE cond_id = ${idMovCond}");
            if ($ReadCond->getResult()) {

                foreach ($ReadCond->getResult() as $DadosCond):
                    extract($DadosCond);

                    $numeroImovCond = $DadosCond['cond_num'];
                    $enderecoImovCond = $DadosCond['cond_endereco'] . ', ' . $numeroImovCond;
                    $cidadeImovCond = $DadosCond['cond_cidade'];
                    $estadoImovCon = $DadosCond['cond_uf'];
                    $bairroImovCon = $DadosCond['cond_bairro'];
                    $cepImovCon = $DadosCond['cond_cep'];
                    $idContaImovCon = $DadosCond['cond_id_cont'];
                    $propImovCond = $DadosCond['cond_resp_nome'];

                endforeach;
            }
        } else {

            $idProp = $DadosImov['imov_id_prop'];

            $ReadProp = new Read;
            $ReadProp->FullRead("SELECT * FROM proprietarios WHERE prop_id = ${idProp}");
            if ($ReadProp->getResult()) {

                foreach ($ReadProp->getResult() as $DadosProp):
                    extract($DadosProp);
                    $propImovCond = $DadosProp['prop_nome'];
                endforeach;
            }

            $numeroImovCond = $DadosImov['imov_num'];
            $enderecoImovCond = $DadosImov['imov_endereco'] . ', ' . $numeroImovCond;
            $cidadeImovCond = $DadosImov['imov_cidade'];
            $estadoImovCon = $DadosImov['imov_uf'];
            $bairroImovCon = $DadosImov['imov_bairro'];
            $cepImovCon = $DadosImov['imov_cep'];
            $idContaImovCon = $DadosImov['imov_id_cont'];

        }

    endforeach;
}

// +----------------------------------------------------------------------+
// | DADOS DA CONTA                                                       |
// +----------------------------------------------------------------------+
if($idContaImovCon === "0" || $idContaImovCon === ""){
    $idContaImovCon = "6";//TODO: conta padrão ???
}

$dadosConta = "";
$donoConta = "";
$cpfConta = "";

$ReadConta = new Read;
$ReadConta->FullRead("SELECT * FROM contas WHERE cont_id = {$idContaImovCon}");

if ($ReadConta->getResult()) {

    foreach ($ReadConta->getResult() as $DadosImov):
        extract($DadosImov);
    endforeach;

    $codBanco = preg_replace("/[^0-9]/", "", $cont_banco);
    $qualBoletoPhp = "";

     //TRATAMENTO PARA AGENCIA, CONTA E DIGITOS
    if ($codBanco === Banco::getCodigo(Banco::BancoDoBrasil)) {//DADOS AGENCIA E CONTA BB
        $qualBoletoPhp = Banco::getPagina(Banco::BancoDoBrasil);

        $dadosConta = "<input type='hidden' name='agencia' value='{$cont_agencia}' />
                       <input type='hidden' name='conta' value='{$cont_conta}' />";

    } else if ($codBanco === Banco::getCodigo(Banco::Itau)) {//DADOS AGENCIA E CONTA ITAU
        $qualBoletoPhp = Banco::getPagina(Banco::Itau);

        $dadosConta = "<input type='hidden' name='agencia' value='{$cont_agencia}' />
                       <input type='hidden' name='conta' value='{$cont_conta}' />
                       <input type='hidden' name='conta_digito' value='{$cont_conta_digito}' />";

    } else if ($codBanco === Banco::getCodigo(Banco::Bradesco)) {//DADOS AGENCIA E CONTA BRADESCO
        $qualBoletoPhp = Banco::getPagina(Banco::Bradesco);

        $dadosConta = "<input type='hidden' name='agencia' value='{$cont_agencia}' />
                       <input type='hidden' name='agencia_digito' value='{$cont_agencia_digito}' />
                       <input type='hidden' name='conta' value='{$cont_conta}' />
                       <input type='hidden' name='conta_digito' value='{$cont_conta_digito}' />";

    } else if ($codBanco === Banco::getCodigo(Banco::Santander)) {//DADOS AGENCIA E CONTA SANTANDER
        $qualBoletoPhp = Banco::getPagina(Banco::Santander);

        $dadosConta = "<input type='hidden' name='codigo_cliente' value='{$cont_conta}' />
                       <input type='hidden' name='ponto_venda' value='{$cont_agencia}' />
                       <input type='hidden' name='carteira' value='102' />
                       <input type='hidden' name='carteira_descricao' value='COBRANÇA SIMPLES - CSR' />";

    } else if ($codBanco === Banco::getCodigo(Banco::Caixa)){//DADOS AGENCIA E CONTA CAIXA
        $qualBoletoPhp = Banco::getPagina(Banco::Caixa);

        $dadosConta = "<input type='hidden' name='agencia' value='{$cont_agencia}' />
                       <input type='hidden' name='conta' value='{$cont_conta}' />
                       <input type='hidden' name='conta_digito' value='{$cont_conta_digito}' />
                       <input type='hidden' name='carteira' value= '5' />
                       <input type='hidden' name='modalidade_conta' value='04' />";

    } else if ($codBanco === Banco::getCodigo(Banco::HSBC)){//DADOS AGENCIA E CONTA HSBC
        $qualBoletoPhp = Banco::getPagina(Banco::HSBC);

        $dadosConta = "<input type='hidden' name='codigo_cedente' value='{$cont_conta}' />
                       <input type='hidden' name='carteira' value= 'CNR' />";
    }

    $donoConta = $DadosImov['cont_titular'];
    $cpfConta = preg_replace("/[^0-9]/", "", $cont_cpf);
}

?>

<!-- +----------------------------------------------------------------------+
     | MONTANDO O FORM HIDDEN                                               |
     +---------------------------------------------------------------------->
<?php
if($temLancamento) {
    ?>
    <form method="post" action="_app/Library/boleto/boleto_<?= $qualBoletoPhp . '.php' ?>" target="_blank">

        <input type='hidden' name='imov_id' value='<?= $imov_id; ?>'/>
        <input type='hidden' name='imovOuCond' value='<?= $imovOuCond; ?>'/>

        <!--DADOS DA CONTA-->
        <?= $dadosConta; ?>

        <!--INFORMACOES DO BOLETO-->
        <input type='hidden' name='total' value='<?= $lancTotal; ?>'/>
        <!--    <input type='hidden' name='dataVenc' value='21/11/2011'/>-->
        <input type='hidden' name='nossoNumero' value='<?= $nossoNumero;?>'/>
        <input type='hidden' name='numeroPedido' value='<?= $numeroPedido;?>'/>
        <input type='hidden' name='demonstrativo1' value='<?= $demonstrativo1;?> '/>
        <input type='hidden' name='demonstrativo2' value='<?= $demonstrativo2;?>'/>
        <input type='hidden' name='demonstrativo3' value='<?= $demonstrativo3;?>'/>

        <!--DONO DO IMOVEL-->
        <input type='hidden' name='nomeSacado' value='<?= $propImovCond;?>'/>
        <input type='hidden' name='enderecoSacado' value='<?= $enderecoImovCond;?>'/>
        <input type='hidden' name='cidadeSacado' value='<?= $cidadeImovCond;?>'/>
        <input type='hidden' name='estadoSacado' value='<?= $estadoImovCon;?>'/>
        <input type='hidden' name='bairroSacado' value='<?= $bairroImovCon;?>'/>
        <input type='hidden' name='cepSacado' value='<?= $cepImovCon;?>'/>

        <!--DONO DA CONTA-->
        <input type='hidden' name='nomeCedente' value='<?= $donoConta;?>'/>
        <input type='hidden' name='cpfCnpjf' value='<?= $cpfConta;?>'/>

        <input type='hidden' name='enderecoCedente' value='<?= $enderecoCedente;?>'/>
        <input type='hidden' name='cidadeCedente' value='<?= $cidadeCedente;?>'/>
        <input type='hidden' name='estadoCedente' value='<?= $estadoCedente;?>'/>
        <input type='hidden' name='razaoCedente' value='<?= $razaoCedente;?>'/>

        <input type='hidden' name='params' value='<?= $params; ?>'/>

        <div class="clearfix"></div>

        <div class="row">
            <div class="form-group col-md-6">
                <br>
                <br>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
            <div class="form-group col-md-6 text-right">
                <br>
                <br>
                <button type="submit" class="btn btn-info">Gerar Boleto</button>
            </div>

        </div>

    </form>

<?php
}else {
?>
    <form>
        <div class="clearfix"></div>

        <div class="row">
            <div class="form-group col-md-6">
                <br>
                <br>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>

        </div>
    </form>
<?php
}
?>