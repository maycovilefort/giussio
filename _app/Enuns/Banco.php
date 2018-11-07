<?php

/**
 * Class controle para os Banco
 */
class Banco
{
    //descrição dos bancos
    const BancoDoBrasil = 'Banco Do Brasil';
    const Bradesco = 'Bradesco';
    const Itau = 'Itau';
    const Santander = 'Santander';
    const Caixa = "Caixa";
    const HSBC = "HSBC";

    //array com os codigos do banco
    private static $codigo = array(
        self::BancoDoBrasil => '246',
        self::Bradesco => '237',
        self::Itau => '341',
        self::Santander => '33',
        self::Caixa => '104',
        self::HSBC => '399',
    );

    //array com as paginas dos boletos
    private static $pagina = array(
        self::BancoDoBrasil => 'bb',
        self::Bradesco => 'bradesco',
        self::Itau => 'itau',
        self::Santander => 'santander_banespa',
        self::Caixa => 'nossacaixa',
        self::HSBC => 'hsbc',
    );

    //retorna o codigo do banco
    public static function getCodigo($bancoEnum)
    {
        return self::$codigo[$bancoEnum];
    }

    //retorna a pagina do banco
    public static function getPagina($bancoEnum)
    {
        return self::$pagina[$bancoEnum];
    }
}
/**
echo 'Descricao >>> ',Banco::Itau;
echo '<br>';
echo 'Pagina >>> ',Banco::getPagina(Banco::Itau);
echo '<br>';
echo 'Codigo >>>', Banco::getCodigo(Banco::Itau);
 */



/*
<option value="Banco ABC Brasil S.A.(246)">Banco ABC Brasil S.A.(246)</option>
<option value="Banco ABN AMRO S.A.(75)">Banco ABN AMRO S.A.(75)</option>
<option value="Banco Alfa S.A.(25)">Banco Alfa S.A.(25)</option>
<option value="Banco Alvorada S.A.(641)">Banco Alvorada S.A.(641)</option>
<option value="Banco Andbank (Brasil) S.A.(65)">Banco Andbank (Brasil) S.A.(65)</option>
<option value="Banco BANDEPE S.A.(24)">Banco BANDEPE S.A.(24)</option>
<option value="Banco Barclays S.A.(740)">Banco Barclays S.A.(740)</option>
<option value="Banco BBM S.A.(107)">Banco BBM S.A.(107)</option>
<option value="Banco BM&FBOVESPA de Serviços de Liquidação e Custódia S.A(96)">Banco BM&FBOVESPA de Serviços de Liquidação e Custódia S.A(96)</option>
<option value="Banco BMG S.A.(318)">Banco BMG S.A.(318)</option>
<option value="Banco BNP Paribas Brasil S.A.(752)">Banco BNP Paribas Brasil S.A.(752)</option>
<option value="Banco Boavista Interatlântico S.A.(248)">Banco Boavista Interatlântico S.A.(248)</option>
<option value="Banco Bonsucesso Consignado S.A.()">Banco Bonsucesso Consignado S.A.()</option>
<option value="Banco Bonsucesso S.A.(218)">Banco Bonsucesso S.A.(218)</option>
<option value="Banco Bradescard S.A.(63)">Banco Bradescard S.A.(63)</option>
<option value="Banco Bradesco BBI S.A.(36)">Banco Bradesco BBI S.A.(36)</option>
<option value="Banco Bradesco Cartões S.A.(204)">Banco Bradesco Cartões S.A.(204)</option>
<option value="Banco Bradesco Financiamentos S.A.(394)">Banco Bradesco Financiamentos S.A.(394)</option>
<option value="Banco Bradesco S.A.(237)">Banco Bradesco S.A.(237)</option>
<option value="Banco BTG Pactual S.A.(208)">Banco BTG Pactual S.A.(208)</option>
<option value="Banco Cacique S.A.(263)">Banco Cacique S.A.(263)</option>
<option value="Banco Caixa Geral - Brasil S.A.(473)">Banco Caixa Geral - Brasil S.A.(473)</option>
<option value="Banco Cargill S.A.(40)">Banco Cargill S.A.(40)</option>
<option value="Banco Caterpillar S.A.()">Banco Caterpillar S.A.()</option>
<option value="Banco CBSS S.A.()">Banco CBSS S.A.()</option>
<option value="Banco Cetelem S.A.(739)">Banco Cetelem S.A.(739)</option>
<option value="Banco Cifra S.A.(233)">Banco Cifra S.A.(233)</option>
<option value="Banco Citibank S.A.(745)">Banco Citibank S.A.(745)</option>
<option value="Banco CNH Industrial Capital S.A.(0)">Banco CNH Industrial Capital S.A.(0)</option>
<option value="Banco Confidence de Câmbio S.A.(95)">Banco Confidence de Câmbio S.A.(95)</option>
<option value="Banco Cooperativo do Brasil S.A. - BANCOOB(756)">Banco Cooperativo do Brasil S.A. - BANCOOB(756)</option>
<option value="Banco Cooperativo Sicredi S.A.(748)">Banco Cooperativo Sicredi S.A.(748)</option>
<option value="Banco Credit Agricole Brasil S.A.(222)">Banco Credit Agricole Brasil S.A.(222)</option>
<option value="Banco Credit Suisse (Brasil) S.A.(505)">Banco Credit Suisse (Brasil) S.A.(505)</option>
<option value="Banco CSF S.A.()">Banco CSF S.A.()</option>
<option value="Banco da Amazônia S.A.(3)">Banco da Amazônia S.A.(3)</option>
<option value="Banco da China Brasil S.A.(83)">Banco da China Brasil S.A.(83)</option>
<option value="Banco Daycoval S.A.(707)">Banco Daycoval S.A.(707)</option>
<option value="Banco de Lage Landen Brasil S.A.(0)">Banco de Lage Landen Brasil S.A.(0)</option>
<option value="Banco de Tokyo-Mitsubishi UFJ Brasil S.A.(456)">Banco de Tokyo-Mitsubishi UFJ Brasil S.A.(456)</option>
<option value="Banco do Brasil S.A.(1)">Banco do Brasil S.A.(1)</option>
<option value="Banco do Estado de Sergipe S.A.(47)">Banco do Estado de Sergipe S.A.(47)</option>
<option value="Banco do Estado do Pará S.A.(37)">Banco do Estado do Pará S.A.(37)</option>
<option value="Banco do Estado do Rio Grande do Sul S.A.(41)">Banco do Estado do Rio Grande do Sul S.A.(41)</option>
<option value="Banco do Nordeste do Brasil S.A.(4)">Banco do Nordeste do Brasil S.A.(4)</option>
<option value="Banco Fator S.A.(265)">Banco Fator S.A.(265)</option>
<option value="Banco Fibra S.A.(224)">Banco Fibra S.A.(224)</option>
<option value="Banco Ficsa S.A.(626)">Banco Ficsa S.A.(626)</option>
<option value="Banco Fidis S.A.()">Banco Fidis S.A.()</option>
<option value="Banco Ford S.A.(0)">Banco Ford S.A.(0)</option>
<option value="Banco GMAC S.A.(0)">Banco GMAC S.A.(0)</option>
<option value="Banco Guanabara S.A.(612)">Banco Guanabara S.A.(612)</option>
<option value="Banco Honda S.A.(0)">Banco Honda S.A.(0)</option>
<option value="Banco IBM S.A.(0)">Banco IBM S.A.(0)</option>
<option value="Banco INBURSA de Investimentos S.A.(12)">Banco INBURSA de Investimentos S.A.(12)</option>
<option value="Banco Industrial do Brasil S.A.(604)">Banco Industrial do Brasil S.A.(604)</option>
<option value="Banco Indusval S.A.(653)">Banco Indusval S.A.(653)</option>
<option value="Banco Investcred Unibanco S.A.(249)">Banco Investcred Unibanco S.A.(249)</option>
<option value="Banco Itaú BBA S.A.(184)">Banco Itaú BBA S.A.(184)</option>
<option value="Banco Itaú BMG Consignado S.A.(29)">Banco Itaú BMG Consignado S.A.(29)</option>
<option value="Banco Itaú Veículos S.A.(0)">Banco Itaú Veículos S.A.(0)</option>
<option value="Banco ItaúBank S.A(479)">Banco ItaúBank S.A(479)</option>
<option value="Banco Itaucard S.A.()">Banco Itaucard S.A.()</option>
<option value="Banco J. P. Morgan S.A.(376)">Banco J. P. Morgan S.A.(376)</option>
<option value="Banco J. Safra S.A.(74)">Banco J. Safra S.A.(74)</option>
<option value="Banco John Deere S.A.(217)">Banco John Deere S.A.(217)</option>
<option value="Banco Luso Brasileiro S.A.(600)">Banco Luso Brasileiro S.A.(600)</option>
<option value="Banco Mercantil do Brasil S.A.(389)">Banco Mercantil do Brasil S.A.(389)</option>
<option value="Banco Mizuho do Brasil S.A.(370)">Banco Mizuho do Brasil S.A.(370)</option>
<option value="Banco Modal S.A.(746)">Banco Modal S.A.(746)</option>
<option value="Banco Original S.A.(212)">Banco Original S.A.(212)</option>
<option value="Banco PAN S.A.(623)">Banco PAN S.A.(623)</option>
<option value="Banco Paulista S.A.(611)">Banco Paulista S.A.(611)</option>
<option value="Banco Petra S.A.(94)">Banco Petra S.A.(94)</option>
<option value="Banco Pine S.A.(643)">Banco Pine S.A.(643)</option>
<option value="Banco PSA Finance Brasil S.A.(0)">Banco PSA Finance Brasil S.A.(0)</option>
<option value="Banco Rabobank International Brasil S.A.(747)">Banco Rabobank International Brasil S.A.(747)</option>
<option value="Banco Rendimento S.A.(633)">Banco Rendimento S.A.(633)</option>
<option value="Banco Rodobens S.A.(120)">Banco Rodobens S.A.(120)</option>
<option value="Banco Safra S.A.(422)">Banco Safra S.A.(422)</option>
<option value="Banco Santander (Brasil) S.A.(33)">Banco Santander (Brasil) S.A.(33)</option>
<option value="Banco Société Générale Brasil S.A.(366)">Banco Société Générale Brasil S.A.(366)</option>
<option value="Banco Sumitomo Mitsui Brasileiro S.A.(464)">Banco Sumitomo Mitsui Brasileiro S.A.(464)</option>
<option value="Banco Topázio S.A.(82)">Banco Topázio S.A.(82)</option>
<option value="Banco Toyota do Brasil S.A.(0)">Banco Toyota do Brasil S.A.(0)</option>
<option value="Banco Triângulo S.A.(634)">Banco Triângulo S.A.(634)</option>
<option value="Banco Volkswagen S.A.(0)">Banco Volkswagen S.A.(0)</option>
<option value="Banco Volvo (Brasil) S.A.(0)">Banco Volvo (Brasil) S.A.(0)</option>
<option value="Banco Votorantim S.A.(655)">Banco Votorantim S.A.(655)</option>
<option value="Banco VR S.A.(610)">Banco VR S.A.(610)</option>
<option value="Banco Western Union do Brasil S.A.(119)">Banco Western Union do Brasil S.A.(119)</option>
<option value="Banco Yamaha Motor S.A.()">Banco Yamaha Motor S.A.()</option>
<option value="BANESTES S.A. Banco do Estado do Espírito Santo(21)">BANESTES S.A. Banco do Estado do Espírito Santo(21)</option>
<option value="Banif-Banco Internacional do Funchal (Brasil)S.A.(719)">Banif-Banco Internacional do Funchal (Brasil)S.A.(719)</option>
<option value="Bank of America Merrill Lynch Banco Múltiplo S.A.(755)">Bank of America Merrill Lynch Banco Múltiplo S.A.(755)</option>
<option value="BBN Banco Brasileiro de Negócios S.A.(81)">BBN Banco Brasileiro de Negócios S.A.(81)</option>
<option value="BCV - Banco de Crédito e Varejo S.A.(250)">BCV - Banco de Crédito e Varejo S.A.(250)</option>
<option value="BEXS Banco de Câmbio S.A.()">BEXS Banco de Câmbio S.A.()</option>
<option value="BNY Mellon Banco S.A.(17)">BNY Mellon Banco S.A.(17)</option>
<option value="BPN Brasil Banco Múltiplo S.A.(69)">BPN Brasil Banco Múltiplo S.A.(69)</option>
<option value="Brasil Plural S.A. - Banco Múltiplo(125)">Brasil Plural S.A. - Banco Múltiplo(125)</option>
<option value="BRB - Banco de Brasília S.A.(70)">BRB - Banco de Brasília S.A.(70)</option>
<option value="Caixa Econômica Federal(104)">Caixa Econômica Federal(104)</option>
<option value="China Construction Bank (Brasil) Banco Múltiplo S.A.(320)">China Construction Bank (Brasil) Banco Múltiplo S.A.(320)</option>
<option value="Citibank N.A.(477)">Citibank N.A.(477)</option>
<option value="Deutsche Bank S.A. - Banco Alemão(487)">Deutsche Bank S.A. - Banco Alemão(487)</option>
<option value="Goldman Sachs do Brasil Banco Múltiplo S.A.(64)">Goldman Sachs do Brasil Banco Múltiplo S.A.(64)</option>
<option value="Haitong Banco de Investimento do Brasil S.A.(78)">Haitong Banco de Investimento do Brasil S.A.(78)</option>
<option value="Hipercard Banco Múltiplo S.A.(62)">Hipercard Banco Múltiplo S.A.(62)</option>
<option value="HSBC Bank Brasil S.A. - Banco Múltiplo(399)">HSBC Bank Brasil S.A. - Banco Múltiplo(399)</option>
<option value="ING Bank N.V.(492)">ING Bank N.V.(492)</option>
<option value="Itaú Unibanco Holding S.A.(652)">Itaú Unibanco Holding S.A.(652)</option>
<option value="Itaú Unibanco S.A.(341)">Itaú Unibanco S.A.(341)</option>
<option value="JPMorgan Chase Bank, National Association(488)">JPMorgan Chase Bank, National Association(488)</option>
<option value="MS Bank S.A. Banco de Câmbio(128)">MS Bank S.A. Banco de Câmbio(128)</option>
<option value="Paraná Banco S.A.(254)">Paraná Banco S.A.(254)</option>
<option value="Scotiabank Brasil S.A. Banco Múltiplo(751)">Scotiabank Brasil S.A. Banco Múltiplo(751)</option>
<option value="Standard Chartered Bank (Brasil) S/A–Bco Invest.(118)">Standard Chartered Bank (Brasil) S/A–Bco Invest.(118)</option>
<option value="UBS Brasil Banco de Investimento S.A.(129)">UBS Brasil Banco de Investimento S.A.(129)</option>
 */

?>



