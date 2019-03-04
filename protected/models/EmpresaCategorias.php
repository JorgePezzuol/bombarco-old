<?php

Yii::import('application.models._base.BaseEmpresaCategorias');

class EmpresaCategorias extends BaseEmpresaCategorias
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function scopes() {
		return array(
			'sitemap'=>array('select'=>'slug', 'condition'=>'status = 1'),
		);
	}

	public function beforeValidate() {

		/*
		 * Gerando o SLUG
		 * fazendo validacão no banco pra ver se o slug já existe
		 */		
		$this->slug = parent::slugifing($this->titulo, $this);

		return parent::beforeValidate();
	}

	public function beforeSave() {

		if(self::model()->exists('titulo=:titulo', array(':titulo'=>$this->titulo))) {
			$this->addError('titulo', 'Categoria já existe!');
			return false;
		}
	
		return parent::beforeSave();
	}

	/**
	 * Drop Down de Categorias
	 * @param  string $selected [ID de categoria selecionada]
	 * @return [type]           [description]
	 */
	public static function dropDown_($selected = '', $html_options = array()) {

		$with = array('empresases');
		$empresas = self::model()->with($with)->findAll('empresases.status = :status and t.status = 1', array(':status'=>Empresas::ACTIVE));
		$listData = CHtml::listData($empresas, 'id', 'titulo');

		if (count($listData) > 1) {
			$listData = array('0'=>'Todas as categorias') + $listData;	
		}

		$html_options['empty'] = array('-1'=>'Categorias');
		//$html_options['id'] = 'select-listagem1';
                $html_options['class'] = 'select-anuncio-pad';
                $html_options['style'] = 'width: 220px';

		echo CHtml::dropDownList('categoria', $selected, $listData, $html_options);
	} 
        
        /**
	 * Drop Down de Categorias
	 * @param  string $selected [ID de categoria selecionada]
	 * @return [type]           [description]
	 */
	public static function dropDown($selected = '', $html_options = array()) {

		$with = array('empresases');
		$empresas = self::model()->with($with)->findAll('empresases.status = :status and t.status = 1', array(':status'=>Empresas::ACTIVE));
		$listData = CHtml::listData($empresas, 'id', 'titulo');

		if (count($listData) > 1) {
			$listData = array('0'=>'Todas as categorias') + $listData;	
		}

		$html_options['empty'] = array('-1'=>'Categorias');
		$html_options['id'] = 'select-listagem1';

		echo CHtml::dropDownList('categoria', $selected, $listData, $html_options);
	} 
}