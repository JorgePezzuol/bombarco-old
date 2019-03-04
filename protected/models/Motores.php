<?php

Yii::import('application.models._base.BaseMotores');

class Motores extends BaseMotores
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function attributeLabels() {

		$attributeLabels = parent::attributeLabels();
		$attributeLabels['motor_modelos_id'] = Yii::t('app', 'Modelos de Motores');

		return $attributeLabels;
	}

}