<?php

Yii::import('application.models._base.BaseContrato');

class Contrato extends BaseContrato
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


	// comeca no E100
	public static function calcularNumContrato() {

		$total = (int)count(Contrato::model()->findAll());
		$total += 100;

		return "E".$total;
	}


	public static function dataExtenso($numMes) {

		$mes = array();
    	$mes["1"] = "Janeiro";
    	$mes["01"] = "Janeiro";
    	$mes["2"] = "Fevereiro";
    	$mes["02"] = "Fevereiro";
    	$mes["3"] = "Março";
    	$mes["03"] = "Março";
    	$mes["4"] = "Abril";
    	$mes["04"] = "Abril";
    	$mes["5"] = "Maio";
    	$mes["05"] = "Maio";
    	$mes["6"] = "Junho";
    	$mes["06"] = "Junho";
    	$mes["7"] = "Julho";
    	$mes["07"] = "Julho";
    	$mes["8"] = "Agosto";
    	$mes["08"] = "Agosto";
    	$mes["9"] = "Setembro";
    	$mes["09"] = "Setembro";
    	$mes["10"] = "Outubro";
    	$mes["11"] = "Novembro";
    	$mes["12"] = "Dezembro";

    	return $mes[$numMes];

	}

}