<?php

Yii::import('application.models._base.BaseAcessorioTipos');

class AcessorioTipos extends BaseAcessorioTipos
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function beforeValidate() {

		if($this->isNewRecord) {
			if(!$this->embarcacao_macros_id) {
				$this->addError('embarcacao_macros_id', 'Selecione uma categoria!');
			}

			if(!$this->titulo) {
				$this->addError('titulo', 'Insira o tipo do acessório!');
			}
		}

		return parent::beforeValidate();
	}

	public function beforeSave() {

		if(self::model()->exists('titulo=:titulo', array(':titulo'=>$this->titulo))) {
			$this->addError('titulo', 'Tipo de acessório já existe!');
			return false;
		}
	
		return parent::beforeSave();
	}
}