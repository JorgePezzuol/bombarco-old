<?php

Yii::import('application.models._base.BaseEmbarcacaoRecursosAdicionais');

class EmbarcacaoRecursosAdicionais extends BaseEmbarcacaoRecursosAdicionais
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	// método que retorna todos os recursos adicionais de embarcações cadastrados no banco
	public static function listarRecursosAdicionais() {
		$criteria = new CDbCriteria();
	    $criteria->select = 'id, titulo, valor, flag';
	    $criteria->condition = 'status=1';
	    return EmbarcacaoRecursosAdicionais::model()->findAll($criteria);
	}

	// método que obtem o preço do turbinado através do ID
	public static function getPrecoPorId($id) {
		$turbinado = self::model()->find('id=:id', array(':id'=>$id));	
		if($turbinado != null) {
			return (float)$turbinado->valor;
		}
		return null;
	}

	// método que retorna o titulo do turbinado baseado no ID
	public static function getTituloTurbinado($id) {

		$turbinado = self::model()->find('id=:id', array(':id'=>$id));

		if($turbinado != null) {
			return $turbinado->titulo;
		}
		else {
			return "";
		}
	}
}