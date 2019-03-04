<?php

Yii::import('application.models._base.BaseTabelaEmbarcacoes');

class TabelaEmbarcacoes extends BaseTabelaEmbarcacoes
{

	const LIMIT_SEARCH = 12;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function rules() {
		$rules = parent::rules();

		$rules[] = array('valor', 'length', 'max'=>200);
		$rules[] = array('ano', 'length', 'max'=>4);

		return $rules;
	}

	public function attributeLabels() {

		$attributeLabels = parent::attributeLabels();
		$attributeLabels['embarcacao_modelos_id'] = 'Modelo';

		return $attributeLabels;
	}


	public function beforeValidate() {

		//$this->valor = Utils::formataValor($this->valor);

		return parent::beforeValidate();
	}


	/**
	 * DropDown de Anos
	 * @param  [type] $model [description]
	 * @return [type]        [description]
	 */
	public static function dropDownYear($model) {

		$data = CHtml::listData($model,'ano','ano');

		natsort($data);

		$html_options['id'] = 'select-tabela3';
		$html_options['empty'] = array('-1'=>'Ano');

		return CHtml::dropDownList('ano', '', $data, $html_options);

	}

}