<?php

Yii::import('application.models._base.BaseComparador');

class Comparador extends BaseComparador
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/* lista os 4 ultimos barcos em que o usuario clicou em Comparar */
	public static function listarBarcos() {

		$criteria_barcos_comparados = new CDbCriteria();
		$criteria_barcos_comparados->join = 'INNER JOIN comparador ON comparador.embarcacoes_id = t.id';
		$criteria_barcos_comparados->condition = 'comparador.usuarios_id =:usuarios_id AND comparador.status =:status AND sessaotoken =:sessaotoken';
		$criteria_barcos_comparados->order = 'dataregistro desc';
		$criteria_barcos_comparados->limit = 4;
		$criteria_barcos_comparados->params = array(':usuarios_id'=>Yii::app()->user->id, ':status'=>1, ':sessaotoken'=>Yii::app()->session->sessionID);
		return Embarcacoes::model()->findAll($criteria_barcos_comparados);

	}

	/* lista os 4 ultimos barcos em que o usuario clicou em Comparar */
	public static function ultimoBarcoComparado() {

		$criteria_barcos_comparados = new CDbCriteria();
		$criteria_barcos_comparados->join = 'INNER JOIN comparador ON comparador.embarcacoes_id = t.id';
		$criteria_barcos_comparados->condition = 'comparador.usuarios_id =:usuarios_id AND comparador.status =:status AND sessaotoken =:sessaotoken';
		$criteria_barcos_comparados->order = 'dataregistro desc';
		$criteria_barcos_comparados->limit = 1;
		$criteria_barcos_comparados->params = array(':usuarios_id'=>Yii::app()->user->id, ':status'=>1, ':sessaotoken'=>Yii::app()->session->sessionID);
		return Embarcacoes::model()->find($criteria_barcos_comparados);

	}
}