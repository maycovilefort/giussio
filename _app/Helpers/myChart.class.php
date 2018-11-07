<?php

class myChart {

    public $AnoAtual;
    public $EntradasAVencer;
    public $EntradasPagas;
    public $ParcelasAVencer;
    public $ParcelasPagas;
    public $arrTotalAVencer;
    public $arrTotalPago;
    public $TotalAVencer;
    public $TotalPago;

    public function setChart() {
//        Pega a Data Atual e Armazena somente o ano na '$this->AnoAtual'
        $Data = getdate();
        $this->AnoAtual = $Data['year'];

//        Insere 0 em todas os indicies da $arrPropostas e $arrContratos
        for ($i = 0, $EntradasAVencer = [], $EntradasPagas = [], $ParcelasAVencer = [], $ParcelasPagas = [], $arrTotalAVencer = [], $arrTotalPago = []; $i < 12; $i++):
            $EntradasAVencer[$i] = 0;
            $EntradasPagas[$i] = 0;
            $ParcelasAVencer[$i] = 0;
            $ParcelasPagas[$i] = 0;
            $arrTotalAVencer[$i] = 0;
            $arrTotalPago[$i] = 0;
        endfor;

        $this->EntradasAVencer = $EntradasAVencer;
        $this->EntradasPagas = $EntradasPagas;
        $this->ParcelasAVencer = $ParcelasAVencer;
        $this->ParcelasPagas = $ParcelasPagas;
        $this->arrTotalAVencer = $arrTotalAVencer;
        $this->arrTotalPago = $arrTotalPago;
    }

    public function setEntradas() {
        //        Faz a leitura no banco de dados 
        $Read = new Read;
        $Read->FullRead("SELECT prop_valor_entrada, Month(prop_venc_entrada) as Mes, Year(prop_venc_entrada) as Ano, prop_status_entrada FROM propostas WHERE Year(prop_venc_entrada) = {$this->AnoAtual}");

        for ($i = 0; $i < $Read->getRowCount(); $i++):
            $Mes = $Read->getResult()[$i]['Mes'];
            $Status = $Read->getResult()[$i]['prop_status_entrada'];
            for ($e = 0; $e < 12; $e++):
                $c = $e + 1;
                switch ($Mes):
                    case $c:
                        if ($Status == 0):
                            $this->EntradasAVencer[$e] += floatval($Read->getResult()[$i]['prop_valor_entrada']);
                            $this->TotalAVencer += floatval($Read->getResult()[$i]['prop_valor_entrada']);
                        else:
                            $this->EntradasPagas[$e] += floatval($Read->getResult()[$i]['prop_valor_entrada']);
                            $this->TotalPago += floatval($Read->getResult()[$i]['prop_valor_entrada']);
                        endif;
                        break;
                endswitch;
            endfor;
        endfor;
    }

    public function setParcelas() {
        //        Faz a leitura no banco de dados 
        $Read = new Read;
        $Read->FullRead("SELECT parc_status, parc_valor, Month(parc_venc) as Mes, Year(parc_venc) as Ano FROM parcelas WHERE Year(parc_venc) = {$this->AnoAtual}");

        for ($i = 0; $i < $Read->getRowCount(); $i++):
            $Mes = $Read->getResult()[$i]['Mes'];
            $Status = $Read->getResult()[$i]['parc_status'];
            for ($e = 0; $e < 12; $e++):
                $c = $e + 1;
                switch ($Mes):
                    case $c:
                        if ($Status == 0):
                            $this->ParcelasAVencer[$e] += floatval($Read->getResult()[$i]['parc_valor']);
                            $this->TotalAVencer += floatval($Read->getResult()[$i]['parc_valor']);
                        else:
                            $this->ParcelasPagas[$e] += floatval($Read->getResult()[$i]['parc_valor']);
                            $this->TotalPago += floatval($Read->getResult()[$i]['parc_valor']);
                        endif;
                        break;
                endswitch;
            endfor;
        endfor;
    }

    public function getAnoAtual() {
        echo $this->AnoAtual;
    }

    public function getStrAVencer() {
        for ($i = 0; $i < 12; $i++):
            $this->arrTotalAVencer[$i] = $this->EntradasAVencer[$i] + $this->ParcelasAVencer[$i];
        endfor;
    }

    public function getStrPago() {
        for ($i = 0; $i < 12; $i++):
            $this->arrTotalPago[$i] = $this->EntradasPagas[$i] + $this->ParcelasPagas[$i];
        endfor;
    }

    public function getChart() {
        $strLabels = '"JAN", "FEV", "MAR", "ABR", "MAI", "JUN", "JUL", "AGO", "SET", "OUT", "NOV", "DEZ"';
        $strMetas = '15000, 15000, 15000, 15000, 15000, 15000, 15000, 15000, 15000, 15000, 15000, 15000';
        $strTotalAVencer = implode(', ', $this->arrTotalAVencer);
        $strTotalPago = implode(', ', $this->arrTotalPago);

        $Cor1 = '191, 4, 17';
        $Cor2 = '254, 238, 0';
        $Cor3 = '0, 144, 69';

        echo "var lineChartData = {" .
        "labels: [$strLabels], " .
        "datasets: [" .
        "{label: 'METAS', " .
        "fillColor: 'rgba($Cor1, 0.3)', " .
        "strokeColor: 'rgba($Cor1,1)', " .
        "pointColor: 'rgba($Cor1, 1)', " .
        "pointStrokeColor: 'rgba($Cor1, 1)', " .
        "pointHighlightFill: 'rgba($Cor1, 1)', " .
        "pointHighlightStroke: 'rgba($Cor1, 1)', " .
        "data: [$strMetas]}, " .
        "{label: 'A VENCER', " .
        "fillColor: 'rgba($Cor2, 0.3)', " .
        "strokeColor: 'rgba($Cor2,1)', " .
        "pointColor: 'rgba($Cor2, 1)', " .
        "pointStrokeColor: 'rgba($Cor2, 1)', " .
        "pointHighlightFill: 'rgba($Cor2, 1)', " .
        "pointHighlightStroke: 'rgba($Cor2, 1)', " .
        "data: [$strTotalAVencer]}, " .
        "{label: 'PAGO', " .
        "fillColor: 'rgba($Cor3, 0.3)', " .
        "strokeColor: 'rgba($Cor3,1)', " .
        "pointColor: 'rgba($Cor3, 1)', " .
        "pointStrokeColor: 'rgba($Cor3, 1)', " .
        "pointHighlightFill: 'rgba($Cor3, 1)', " .
        "pointHighlightStroke: 'rgba($Cor3, 1)', " .
        "data: [$strTotalPago]}, " .
        "] };";
    }

}
