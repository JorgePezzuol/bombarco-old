<?php

Yii::import('application.models._base.BaseOrdemTipos');

class OrdemTipos extends BaseOrdemTipos
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function beforeSave() {

		if(self::model()->exists('titulo=:titulo', array(':titulo'=>$this->titulo))) {
			$this->addError('titulo', 'Tipo já existe!');
			return false;
		}
	
		return parent::beforeSave();
	}
}