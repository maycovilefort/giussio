<?php

class Parcelamento {

    var $QtdParcelas;
    var $Investimento;
    var $Entrada;
    var $DataPrimeiraParc;

    function setParcelamento($QtdParcelas, $Investimento, $Entrada, $DataPrimeiraParc) {
        $this->QtdParcelas = $QtdParcelas;
        $this->Investimento = $Investimento;
        $this->Entrada = $Entrada;
        $this->DataPrimeiraParc = $DataPrimeiraParc;
    }

    function getParcelas() {
        if ($this->DataPrimeiraParc !== "") {
            $this->DataPrimeiraParc = explode("-", $this->DataPrimeiraParc);
            $Dia = $this->DataPrimeiraParc[2];
            $Mes = $this->DataPrimeiraParc[1];
            $Ano = $this->DataPrimeiraParc[0];

            $ValorParc = number_format(($this->Investimento - $this->Entrada) / $this->QtdParcelas, 2, ",", ".");
        } else {
            $Dia = date("d");
            $Mes = date("m");
            $Ano = date("Y");
        }
        echo ("<div class='row j_parcelas'>");
        for ($x = 1; $x <= $this->QtdParcelas; $x++) {
            $VencParc = date("d/m/Y", strtotime("+" . $x . " month", mktime(0, 0, 0, $Mes, $Dia, $Ano)));
            echo ("<div class='form-group col-md-4'><label>Parcela: </label><input type='text' name='parc_desc_{$x}' value='{$x}/{$this->QtdParcelas}' class='form-control text-center' readonly /></div>" .
            "<div class='form-group col-md-4'><label>Vencimento: </label><input type='text' name='parc_venc_{$x}' value='{$VencParc}' class='form-control' readonly /></div>" .
            "<div class='form-group col-md-4'><label>Valor: </label><input type='text' name='parc_valor_{$x}' value='{$ValorParc}' class='form-control' readonly /></div>" .
            "<input rel='noclear' type='hidden' name='parc_qtd_{$x}' value='{$this->QtdParcelas}' />");
        }
        echo ("</div>");
    }

}
