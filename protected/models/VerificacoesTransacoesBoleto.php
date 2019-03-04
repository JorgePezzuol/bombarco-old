<?php

Yii::import('application.models._base.BaseVerificacoesTransacoesBoleto');

class VerificacoesTransacoesBoleto extends BaseVerificacoesTransacoesBoleto
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


	public static function verificacaoHorario($transacao) {

		$sql = "SELECT COUNT(*) as verificacoes";
		$sql .= " FROM verificacoes_transacoes_boleto";
		$sql .= " WHERE transacoes_id = ".$transacao->id;
		$sql .= " AND DATE_FORMAT(hora,'%y-%m-%d') = DATE(NOW());";

		$resultado_query = Yii::app()->db->createCommand($sql)->queryAll();

		if($resultado_query[0]["verificacoes"] > 0) {
			return true;
		}

		$v = new VerificacoesTransacoesBoleto();
		$v->transacoes_id = $transacao->id;
		$v->hora = date("Y-m-d H:i:s");
		$v->save();

		return false;

	}
}