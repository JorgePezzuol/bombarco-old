<?php

Yii::import('application.models._base.BaseBombarcoshop');

class Bombarcoshop extends BaseBombarcoshop
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function beforeSave() {

		if($this->find("slug=:slug", array(":slug"=>$this->slug)) != null) {
			return false;
		}
		return true;
	}

	public static function validarValor($id_produto, $valor) {

		$bbshopprod = Bombarcoshop::model()->findByPk($id_produto);

		if($bbshopprod != null) {

			$bbshopdesconto = BombarcoshopDescontos::model()->find("id_produto=:id_produto", array(":id_produto"=>$id_produto));

			if($bbshopdesconto != null) {
				$valor_desconto = ($bbshopdesconto->porcentagem_desconto / 100) * $bbshopprod->valor;;
			} 


			if( ($valor != $bbshopprod->valor) && ($valor != $valor_desconto) ) {
				return false;
			}

			return true;
		}

		return false;
	}

	public static function validarValor2($id_produto, $valor) {

		$bbshopprod = Bombarcoshop::model()->findByPk($id_produto);

		if($bbshopprod != null) {

			if($valor != $bbshopprod->valor) {
				return false;
			}

			return true;
		}

		return false;
	}

	
}