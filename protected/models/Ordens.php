<?php

Yii::import('application.models._base.BaseOrdens');

class Ordens extends BaseOrdens
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

		// retorna o texto relacioanda ao número do status do ordem de pedido
	public static function getTextoStatus($status) {

		$arrayStatus = array();
		$arrayStatus[0] = "Escondida";
		$arrayStatus[1] = "Pendente";
		$arrayStatus[2] = "Pago";

		if(array_key_exists($status, $arrayStatus)) {
			return $arrayStatus[$status];
		}

		else {
			return "";
		}
	}

	// passar todas as ordens e pagamento e verificar se elas sao soh turbinadas ou ñ
	public static function isTurbinada($ordens) {

		$flg_turbinada = true;

		foreach($ordens as $ordem) {

			if($ordem->ordemTipos->alias != "adicional_embarcacao") {
				$flg_turbinada = false;
				break;
			}
		}

		return $flg_turbinada;
	}
}