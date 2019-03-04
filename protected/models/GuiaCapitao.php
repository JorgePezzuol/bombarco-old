<?php

Yii::import('application.models._base.BaseGuiaCapitao');

class GuiaCapitao extends BaseGuiaCapitao
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


	public function rules() {
		
		$rules = parent::rules();
		$rules[] = array('email', 'email');
		return $rules;
	}


	public function beforeSave() {

		if($this->nome == "" || $this->email == "" || $this->empresa == "") {
			return false;
		}


		return true;
	}
}