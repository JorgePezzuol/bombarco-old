<?php

Yii::import('application.models._base.BaseEmbarcacaoModelosEditavel');

class EmbarcacaoModelosEditavel extends BaseEmbarcacaoModelosEditavel
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function beforeValidate() {

		/*
		 * Gerando o SLUG
		 * fazendo validacão no banco pra ver se o slug já existe
		 */		
		$this->slug = parent::slugifing($this->titulo, $this);

		return parent::beforeValidate();
	}
}