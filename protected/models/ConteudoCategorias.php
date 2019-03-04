<?php

Yii::import('application.models._base.BaseConteudoCategorias');

class ConteudoCategorias extends BaseConteudoCategorias
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function scopes() {
		return array(
			'sitemap'=>array('select'=>'slug', 'condition'=>'macro = "B"'),
		);
	}

	public static function representingColumn() {
		return 'slug';
	}

	public function beforeValidate() {

		/*
		 * Gerando o SLUG
		 * fazendo validacão no banco pra ver se o slug já existe
		 */		
		$this->slug = parent::slugifing($this->titulo, $this);

		return parent::beforeValidate();
	}

	/**
	 * Drop down de categorias de conteudos
	 * @param  string $selected [description]
	 * @return [type]           [description]
	 */
	public static function dropDown($macro = 'N', $selected = '', $html_options = array()) {

		$listData = CHtml::listData(self::model()->findAllByAttributes(array('macro'=>$macro), array('order'=>'titulo ASC')), 'id', 'titulo');

		$html_options['empty'] = array('-1'=>'Categorias');
		$html_options['id'] = 'select-listagem4';
		$html_options["class"] = "select-search search-home";

		echo CHtml::dropDownList('categoria', $selected, $listData, $html_options);

	}

}