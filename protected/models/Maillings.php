<?php

Yii::import('application.models._base.BaseMaillings');

class Maillings extends BaseMaillings
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function rules() {
		
		$rules = parent::rules();
		$rules[] = array('email', 'email');
		return $rules;
	}

	

}