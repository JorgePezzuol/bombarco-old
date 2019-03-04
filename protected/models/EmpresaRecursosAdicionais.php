<?php

Yii::import('application.models._base.BaseEmpresaRecursosAdicionais');

class EmpresaRecursosAdicionais extends BaseEmpresaRecursosAdicionais
{

	// Recursos adicionais de empresas/estaleiros
	public static $recursos_by_slug = array('destaque_busca'=>1, 'banner_topo'=>2, 'telefone'=>3, 'fotos'=>4, 'video'=>5, 'noticias_relacionadas'=>6, 'descricao'=>7);
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	// método que retorna todas os recursos adicionais cadastrados no banco
	public static function listarRecursosAdicionais() {
			$criteria = new CDbCriteria();
	        $criteria->select = 'id, titulo, valor, flag';
	        $criteria->condition = 'status=1';
	        return self::model()->findAll($criteria);
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